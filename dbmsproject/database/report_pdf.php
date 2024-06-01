<?php
require('fpdf.php');

class PDF extends FPDF
{
    function __construct()
    {
        parent::__construct('L');
    }

    // Colored table
    function FancyTable($headers, $data, $row_height = 30)
    {
        // Colors, line width and bold font
        $this->SetFillColor(255, 0, 0);
        $this->SetTextColor(255);
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');
        
        // Header
        foreach ($headers as $header_key => $header_data) {
            $this->Cell($header_data['width'], 7, $header_key, 1, 0, 'C', true);
        }
        $this->Ln();
        
        // Color and font restoration
        $this->SetTextColor(0);
        $this->SetFont('');

        $header_keys = array_keys($headers);
        foreach ($data as $row) {
            foreach ($header_keys as $header_key) {
                $content = $row[$header_key]['content'];
                $width = $headers[$header_key]['width'];
                $align = $row[$header_key]['align'];
                if ($header_key == 'image') {
                    if (is_null($content) || $content == "") {
                        $this->Cell($width, $row_height, 'No Image', 'LRBT', 0, $align);
                    } else {
                        $this->Cell($width, $row_height, $this->Image('../uploads/products/' . $content, $this->GetX(), $this->GetY(), 30, 25), 'LRBT', 0, $align);
                    }
                } else {
                    $this->Cell($width, $row_height, $content, 'LRBT', 0, $align);
                }
            }
            $this->Ln();
        }
        
        // Closing line
        $this->Cell(array_sum(array_column($headers, 'width')), 0, '', 'T');
    }
}

$type = $_GET['report'];
$report_headers = [
    'product' => 'Product Reports',
    'supplier'=>'Supplier Reports',
    'delivery'=>'Delivery Reports',
    'purchase_orders'=>'Purchase Order Reports'
];

include('connection.php');

// Column headings
if ($type == 'product') {
    $header = [
        'id' => ['width' => 15],
        'image' => ['width' => 70],
        'product_name' => ['width' => 35],
        'stock' => ['width' => 15],
        'created_by' => ['width' => 45],
        'created_at' => ['width' => 45],
        'updated_at' => ['width' => 45]
    ];

    $stmt = $conn->prepare("SELECT *, products.id as pid FROM products INNER JOIN users ON products.created_by=users.id ORDER BY products.created_at DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $products = $stmt->fetchAll();

    $data = [];
    foreach ($products as $product) {
        $product['created_by'] = $product['first_name'] . ' ' . $product['last_name'];
        unset($product['first_name'], $product['last_name'], $product['password'], $product['email']);
        
        array_walk($product, function (&$str) {
            $str = preg_replace("/\t/", "\\t", $str);
            $str = preg_replace("/\r?\n/", "\\n", $str);
            if (strstr($str, '"')) {
                $str = '"' . str_replace('"', '""', $str) . '"';
            }
        });
        
        $data[] = [
            'id' => ['content' => $product['pid'], 'align' => 'C'],
            'image' => ['content' => $product['img'], 'align' => 'C'],
            'product_name' => ['content' => $product['product_name'], 'align' => 'C'],
            'stock' => ['content' => $product['stock'], 'align' => 'C'],
            'created_by' => ['content' => $product['created_by'], 'align' => 'L'],
            'created_at' => ['content' => date('M d, Y h:i:s A', strtotime($product['created_at'])), 'align' => 'L'],
            'updated_at' => ['content' => date('M d, Y h:i:s A', strtotime($product['updated_at'])), 'align' => 'C']
        ];
    }
}

if($type === 'supplier'){
    $stmt = $conn->prepare("
        SELECT 
            suppliers.id as sid, 
            suppliers.created_at as 'created_at', 
            users.first_name, 
            users.last_name, 
            suppliers.supplier_location, 
            suppliers.email, 
            suppliers.created_by  
        FROM suppliers 
        INNER JOIN users ON suppliers.created_by = users.id 
        ORDER BY suppliers.created_at DESC
    ");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $suppliers = $stmt->fetchAll();
    $header = [
        'supplier_id' => ['width' => 30],
        'created_at' => ['width' => 45],
        'supplier_location' => ['width' => 45],
        'email' => ['width' => 45],
        'created_by' => ['width' => 45]
    ];

    $data = [];
    foreach($suppliers as $supplier){
        $supplier['created_by'] = $supplier['first_name'] . ' ' . $supplier['last_name'];
        $data[] = [
            'supplier_id' => ['content' => $supplier['sid'], 'align' => 'C'],
            'created_at' => ['content' => $supplier['created_at'], 'align' => 'C'],
            'supplier_location' => ['content' => $supplier['supplier_location'], 'align' => 'C'],
            'email' => ['content' => $supplier['email'], 'align' => 'C'],
            'created_by' => ['content' => $supplier['created_by'], 'align' => 'L']
        ];
        $row_height=10;
    }
}


if($type === 'delivery'){
$stmt = $conn->prepare("
        SELECT 
            date_received,qty_received,first_name,last_name,products.product_name,supplier_name,batch
        FROM order_product_history,order_product,users,suppliers,products
        WHERE 
           order_product_history.order_product_id=order_product.id
        AND
           order_product.created_by=users.id
        AND
           order_product.created_by=users.id
        AND
           order_product.product=products.id
        ORDER BY order_product.batch DESC
    ");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $header = [
        'date_received' => ['width' => 45],
        'qty_received' => ['width' => 25],
        'product_name' => ['width' => 35],
        'supplier_name' => ['width' => 40],
        'batch' => ['width' => 25],
        'created_by' => ['width' => 35]
    ];
   
    $deliveries = $stmt->fetchAll(); // Fetch all the order products
   

    
    

        foreach($deliveries as $delivery){
            $delivery['created_by'] = $delivery['first_name'] . ' ' . $delivery['last_name'];
             $data[] = [
            'date_received' => ['content' => $delivery['date_received'], 'align' => 'C'],
            'qty_received' => ['content' => $delivery['qty_received'], 'align' => 'C'],
            'product_name' => ['content' => $delivery['product_name'], 'align' => 'C'],
            'supplier_name' => ['content' => $delivery['supplier_name'], 'align' => 'C'],
            'batch' => ['content' => $delivery['batch'], 'align' => 'C'],
            'created_by' => ['content' => $delivery['created_by'], 'align' => 'C'],
        ];
        $row_height=12;
        }
       
    }

    if($type === 'purchase_orders'){
      $stmt = $conn->prepare("
        SELECT 
            products.product_name,
            order_product.id, 
            order_product.quantity_ordered, 
            order_product.quantity_received, 
            order_product.quantity_remaining, 
            order_product.status, 
            order_product.batch, 
            order_product.created_at, 
            users.first_name, 
            users.last_name, 
            suppliers.supplier_name, 
            order_product.created_at as 'order product created at'
        FROM order_product
        INNER JOIN users ON order_product.created_by = users.id
        INNER JOIN suppliers ON order_product.supplier = suppliers.id
        INNER JOIN products ON order_product.product=products.id
        ORDER BY order_product.batch DESC
    ");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    

    $order_products = $stmt->fetchAll(); // Fetch all the order products
    $header = [
        'id' => ['width' => 20],
        'quantity_ordered' => ['width' => 30],
        'quantity_received' => ['width' => 35],
        'quantity_remaining' => ['width' => 40],
        'status' => ['width' => 25],
        'batch' => ['width' => 25],
        'supplier_name' => ['width' => 35],
        'created_at' => ['width' => 45],
        'created_by' => ['width' => 40]
    ];

        foreach($order_products as $order_product){
            $order_product['created_by'] = $order_product['first_name'] . ' ' . $order_product['last_name'];
            $data[] = [
            'id' => ['content' => $order_product['id'], 'align' => 'C'],
            'quantity_ordered' => ['content' => $order_product['quantity_ordered'], 'align' => 'C'],
            'quantity_received' => ['content' => $order_product['quantity_received'], 'align' => 'C'],
            'quantity_remaining' => ['content' => $order_product['quantity_remaining'], 'align' => 'C'],
            'status' => ['content' => $order_product['status'], 'align' => 'C'],
            'batch' => ['content' => $order_product['batch'], 'align' => 'C'],
            'supplier_name' => ['content' => $order_product['supplier_name'], 'align' => 'C'],
            'created_at' => ['content' => $order_product['created_at'], 'align' => 'C'],
            'created_by' => ['content' => $order_product['created_by'], 'align' => 'C'],
        ];
        $row_height=15;
            
    }

    }
$pdf = new PDF();
$pdf->SetFont('Arial', '', 20);
$pdf->AddPage();
$pdf->Cell(80);
$pdf->Cell(50, 10, $report_headers[$type], 0, 0, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Ln();
$pdf->Ln();

$pdf->FancyTable($header, $data, isset($row_height) ? $row_height : 30);
$pdf->Output();
?>
