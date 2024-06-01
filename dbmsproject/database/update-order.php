<?php

    $purchase_orders = $_POST['payload'];
    include('connection.php');

   try{
    foreach($purchase_orders as $po){
    $delivered=(int) $po['qtyDelivered'];
    if($delivered>0){
    $cur_qty_received=(int) $po['qtyReceived'];
    $status=$po['status'];
    $row_id=$po['id'];
    $qty_ordered=(int) $po['qtyOrdered'];
    $product_id=(int) $po['pid'];
    $updated_qty_received=$cur_qty_received+$delivered;
    $qty_remaining=(int)$qty_ordered-$updated_qty_received;
    $sql = "UPDATE order_product 
                SET 
                 quantity_received=?,status=?,quantity_remaining=?
                WHERE id=?";
                        
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([$updated_qty_received,$status,$qty_remaining,$row_id]);
    $delivery_history=[
                  'order_product_id'=>$row_id,
                   'qty_received'=>$delivered,
                   'date_received'=>date('Y-m-d H:i:s'),
                   'date_updated'=>date('Y-m-d H:i:s'),

               ];

                $sql = "INSERT INTO order_product_history(order_product_id,qty_received,date_received,date_updated) VALUES (:order_product_id,:qty_received,:date_received,:date_updated)";

              
                $stmt=$conn->prepare($sql);
                $stmt->execute($delivery_history);
                $stmt=$conn->prepare("SELECT products.stock FROM products WHERE id=$product_id");
                $stmt->execute();
                $product=$stmt->fetch();
                $cur_stock=(int) $product['stock'];
                $updated_stock=$cur_stock+$delivered;
                $sql = "UPDATE products 
                SET 
                 stock=?
                WHERE id=?";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$updated_stock,$product_id]);
               
                
    }
  
    }
     $response = [
        'success' => True,
        'message' => "Order Successfully Updated"
    ];
    }
    catch (Exception $e) {
    $response = [
        'success' => false,
        'message' => "Error processing your request"
    ];
}
echo json_encode($response);

?>