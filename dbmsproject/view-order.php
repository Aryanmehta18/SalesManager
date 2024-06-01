<?php
    session_start();
     $users = "users";
    if(!isset($_SESSION['user'])) header('location: login.php');
    $show_table='suppliers';
    $user=$_SESSION['user'];
    $suppliers=include('database/show.php');
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Purchase Orders SMS</title>
<link rel="stylesheet" type="text/css" href="http://localhost/dbmsproject/css/login.css">

        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/css/bootstrap-dialog.min.css" integrity="sha512-PvZCtvQ6xGBLWHcXnyHD67NTP+a+bNrToMsIdX/NUqhw+npjLDhlMZ/PhSHZN4s9NdmuumcxKHQqbHlGVqc8ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />       
         <style>
            form::after {
                content: '';
                clear: both;
                display: block;
            }

            form.appForm {
                width: 50%;
                margin: 0 auto;
                padding: 10px;
                border: 1px solid #cecfd0;
                border-radius: 5px; /* Adjust the value as needed */
                background:#f4f6f9;
            }

            .appFormInput {
                width: 100%;
                height: 33px;
                border: 1px solid #d6d7da;
                border-radius: 5px;
            }

            .appFormInputContainer {
                margin-bottom: 15px; /* Adjust as needed */
            }

            div#userAddFormContainer {
                padding-top: 100px;
            }
            form label{
                font-weight:bold;
                text-transform:uppercase;
            }

            button.appBtn {
                background: #011037;
                border: 1px solid #f685a1;
                color: #fff;
                padding: 10px;
                margin-top: 20px;
                float: right;
            }
              p.responseMessage {
        font-size: 18px;
        text-align: center;
        margin-top: 33px;
        padding: 20px;
    }
    ul.dashboard_menu_lists li.liMainMenu a{
    text-decoration: none;
    color: #fff;
   padding:0px 15px;
    display: block;
    font-size: 14px;
    padding-bottom:15px;
    padding-right:0px;
}

ul.dashboard_menu_lists li.liMainMenu{
padding: 15px 0px;

text-transform: uppercase;
}
i.mainMenuIconArrow{
    float:right;
    font-size:19px !important;
    margin-top:7px;

}
.poList{
    margin-bottom:25px;
    padding:15px;
    border-bottom:solid 1px #d1d1d1;
    border-radius:5px;
    background:#fbfbfb;
}
.poList p{
    font-weight:bold;
    text-transform:uppercase;
    color:#011037;
    font-size:16px;
}
.poList table td, .poList table th{
    border:none;
    border-bottom:1px dotted green;
}
.poList table td{
    padding:13px 14px;
    font-size:13px;
}
.poList table th{
    padding:15px 10px;
}
.poList table{
    border:none;
}
.poOrderUpdateBtnContainer{
    margin-top:20px;
    margin-left:1000px;
}
.updatePoBtn{
    color:#011037;
    background:#fff;
    border:1px solid #011037;
}
.updatePoBtn:hover{
    color:#fff;
    background:#011037;
  
}
.po-badge{
    padding:4px 6px;
    border:1px solid green;
 }
.po-badge-PENDING{
    background:#ff7c76;
    border-color:#556455;
}
.po-badge-complete{
    background:#b5ebb5;
    border-color:green;
}
ul.dashboard_menu_lists li.liMainMenu a i {
   
  font-size: 25px;
  width: 30px;
}
.subMenuLink{
padding-Left:25px !important;
padding-top:10px !important;
padding-bottom:10px!important;
text-transform:none;
font-size:15px !important;
}
a.subMenuLink i{
    font-size:16px !important;
    width: 16px !important;
   
}
ul.subMenus{
    background: #011037;
  display: none;
}
.subMenuActive{
    font-weight:bold;
    border-top:2px solid white;
    border-bottom:2px solid white;
    background:'#011037';
}
.alignLeft{
    text-align:left;
}
.dashboard_content_main{
    background:#fff;
    min-height:800px;
    height:100%;
    padding-left:20px;
    border:1px solid #011037;
}
.appSelect{
    display:block;
    width:100%;
    height:100px;
    border-color:#d2d2d2;

}
.products{
    display:block;
    width: 100px;
    height:100px;
    border-color:#d2d2d2;

}
.appDeliveryHistory{
    border:1px solid #FF5722;
    background:none;
   
}
.appDeliveryHistory:hover{
    border:1px solid #FF5722;
    background:#FF5722;
    color:#FFF;
}
.deliveryHistoryTable th{
   font-size:14px;
   padding:10px 20px;
}
    
    p.responseMessage__success {
        background: rgba(0, 128, 0, 0.1);
        font-size: 18px;
        text-align: center;
        margin-top: 33px;
        padding: 20px;
    }
    
    p.responseMessage__error {
         background: rgba(0, 128, 0, 0.1);
        font-size: 18px;
        text-align: center;
        margin-top: 33px;
        padding: 20px;
    }
    
        </style>
    </head>
    <body>
        <div id="dashboardMainContainer">
            <?php include('partials/app-sidebar.php')?>

        
               
            </div>
            <div class="dashboard_content_container" id="dashboard_content_container">
                  <?php include('partials/app-topnav.php')?>
                <div class="dashboard_content">
                    <div class="dashboard_content_main">
               <div class="row">
        
                            </div>
               
                <div class="column column-12">
                   <h1 class="section_header"><i class="fa fa-list"></i> List Of Orders</h1>
                   <div class="section_content">
                    <div class="poListContainers">
                        <?php
                        $stmt=$conn->prepare("SELECT order_product.id,order_product.product,products.product_name,order_product.quantity_ordered,users.first_name,order_product.batch,users.last_name,suppliers.supplier_name,order_product.status,order_product.created_at,order_product.quantity_received FROM order_product,suppliers,products,users WHERE order_product.supplier=suppliers.id AND order_product.product=products.id AND order_product.created_by=users.id ORDER BY order_product.created_at DESC");
                        $stmt->execute();
                        $purchase_orders=$stmt->fetchAll(PDO::FETCH_ASSOC);
                        $data=[];
                        foreach($purchase_orders as $purchase_order){
                            $data[$purchase_order['batch']][]=$purchase_order;
                        }
                    ?>
                    <?php
                       foreach($data as $batch_id => $batch_pos){
                    ?>
                     <div class="poList" id="container-<?= $batch_id ?>">
                        <p>Batch #:<?=$batch_id?></p>
                        <table>
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Product</th>
                                <th>Quantity Ordered</th>
                                <th>Quantity Received</th> 
                                <th>Supplier</th>
                                <th>Status</th>
                                <th>Ordered By</th>
                                <th>Created Date</th>
                                <th>Delivery History</th>
                                
                              </tr>  
                        </thead>
                        <tbody>
                        <?php foreach($batch_pos as $index => $batch_po): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td class="po_product alignLeft"><?= $batch_po['product_name'] ?></td>
                                <td class="po_qty_ordered"><?= $batch_po['quantity_ordered'] ?></td>
                                <td class="po_qty_received"><?= $batch_po['quantity_received'] ?></td>
                                <td class="po_qty_supplier alignLeft"><?= $batch_po['supplier_name'] ?></td>
                                <td class="po_qty_status"><span class="po-badge po-badge-<?= $batch_po['status']?>"><?= $batch_po['status'] ?></td>
                                <td><?= $batch_po['first_name'] . ' ' . $batch_po['last_name'] ?></td>
                                <td>
                                    <?= $batch_po['created_at'] ?>
                                    <input type="hidden" class="po_qty_row_id" value="<?= $batch_po['id'] ?>">
                                    <input type="hidden" class="po_qty_productid" value="<?= $batch_po['product'] ?>">
                                </td>
                                <td>
                                 <button class="appbtn appDeliveryHistory" data-id="<?= $batch_po['id']?>">Show Delivery History</button> 
                             </td>
                            </tr>
                        <?php endforeach; ?>  
                    </tbody>

                     </table>
                     <div class="poOrderUpdateBtnContainer alignRight">
                <button class="appbtn updatePoBtn" data-id="<?=$batch_id?>">Update</button>
                </div>
                     
               </div>
               <?php } ?>
                                   
                   </div>
                    
                            </div>
                   </div>
               </div>
                
                </div>
                           
                </div>
                </div>
            </div>
                    <script>
    const toogleBtn = document.getElementById('toogleBtn');
    const dashboard_sidebar = document.getElementById('dashboard_sidebar');
    const dashboard_content_container = document.querySelector('.dashboard_content_container');
    const dashboard_logo = document.querySelector('.dashboard_logo');
    const dashboard_icons = document.querySelector('.dashboard_icons');

    let isSidebarExpanded = true; // Initially set to true

    toogleBtn.addEventListener('click', (event) => {
        event.preventDefault();
        if (isSidebarExpanded) {
            // Minimize the sidebar
            dashboard_sidebar.style.width = '15%';
            dashboard_content_container.style.width = '95%';
            dashboard_logo.style.fontSize = '30px'; // Optionally reduce logo size
        } else {
            // Expand the sidebar
            dashboard_sidebar.style.width = '25%'; // Adjust the width as needed
            dashboard_content_container.style.width = '85%';
            dashboard_logo.style.fontSize = '60px'; // Reset logo size
        }
        // Toggle the state
        isSidebarExpanded = !isSidebarExpanded;
    });
document.addEventListener('DOMContentLoaded', function () {
    let pathArray = window.location.pathname.split('/');
    let curFile = pathArray[pathArray.length - 1];
    let curNav = document.querySelector('a[href="./' + curFile + '"]');
    curNav.classList.add('subMenuActive');
    let mainNav = curNav.closest('li.liMainMenu');
    mainNav.style.background = '#011037';
    let subMenu = curNav.closest('.subMenus');
    let mainMenuIcon = mainNav.querySelector('.mainMenuIconArrow');

    showHideSubMenu(subMenu, mainMenuIcon); // Call showHideSubMenu here
});

document.addEventListener('click', function (e) {
    let clickedEl = e.target;
    if (clickedEl.classList.contains('showHideSubMenu')) {
        let subMenu = clickedEl.closest('li').querySelector('.subMenus');
        let mainMenuIcon = clickedEl.closest('li').querySelector('.mainMenuIconArrow');
        let subMenus = document.querySelectorAll('.subMenus');
        subMenus.forEach((sub) => {
            if (subMenu !== sub) sub.style.display = 'none';
        });
        showHideSubMenu(subMenu, mainMenuIcon); // Call showHideSubMenu here
    }
});

function showHideSubMenu(subMenu, mainMenuIcon) {
    if (subMenu != null) {
        if (subMenu.style.display === 'block') {
            subMenu.style.display = 'none';
            mainMenuIcon.classList.remove('fa-angle-down');
            mainMenuIcon.classList.add('fa-angle-left');
        } else {
            subMenu.style.display = 'block';
            mainMenuIcon.classList.remove('fa-angle-left');
            mainMenuIcon.classList.add('fa-angle-down');
        }
    }
}




   
    
</script>

<script src="js/jquery/jquery-3.5.1.min.js"></script>
            <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.js" integrity="sha512-AZ+KX5NScHcQKWBfRXlCtb+ckjKYLO1i10faHLPXtGacz34rhXU8KM4t77XXG/Oy9961AeLqB/5o0KTJfy2WiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <?php
    $show_table='products';
    $products = include('database/show.php');
    $products_arr=[];

    foreach ($products as $product) {
    $products_arr[$product['id']]= $product['product_name'];
  }
     $products_arr=json_encode($products_arr);
?>
          <script>
        function script() {
            var vm=this;
    this.initialize = function () {
        this.registerEvents();
    };
    this.registerEvents = function () {
        document.addEventListener('click', function (e) {
           
            targetElement = e.target;
            classList = targetElement.classList;

            if (classList.contains('updatePoBtn')) {
                e.preventDefault();
                batchNumber=targetElement.dataset.id
                batchNumberContainer='container-'+batchNumber;
               

                productList=document.querySelectorAll('#' + batchNumberContainer + ' .po_product');
                qtyOrderedList=document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_ordered');
                qtyReceivedList=document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_received');
                supplierList=document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_supplier');
                statusList=document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_status');
                rowIds=document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_row_id');
                pIds=document.querySelectorAll('#' + batchNumberContainer + ' .po_qty_productid');

               
                poListsArr=[];
                for(i=0;i<productList.length;i++){
                    poListsArr.push({
                        name:productList[i].innerText,
                        qtyOrdered:qtyOrderedList[i].innerText,
                        qtyReceived:qtyReceivedList[i].innerText,
                        supplier:supplierList[i].innerText,
                        status:statusList[i].innerText,
                        id:rowIds[i].value,
                        pid:pIds[i].value
                });
                }
               var poListHtml = '<table id="formTable_'+ batchNumber +'">\
                    <thead>\
                      <tr>\
                        <th>Product Name</th>\
                        <th>Quantity Ordered</th>\
                        <th>Quantity Received</th>\
                        <th>Quantity Delivered</th>\
                        <th>Supplier</th>\
                        <th>Status</th>\
                      </tr>\
                    </thead>\
                    <tbody>';

                        
              poListsArr.forEach((poList)=>{
           poListHtml +='<tr>\
                        <td class="po_product">'+ poList.name+'</td>\
                                <td class="po_qty_ordered">'+ poList.qtyOrdered+'</td>\
                                <td class="po_qty_received">'+ poList.qtyReceived+'</td>\
                                <td class="po_qty_delivered"><input type="number" value="0"/></td>\
                                <td class="po_qty_supplier">'+ poList.supplier+'</td>\
                                <td>\
                                <select class="po_qty_status">\
                                   <option value="pending" '+(poList.status=='pending'?'selected':'')+'>pending</option>\
                                   <option value="complete" '+(poList.status=='company'?'selected':'')+'>complete</option>\
                                </select>\
                                    <input type="hidden" class="po_qty_row_id" value="'+poList.id+'">\
                                     <input type="hidden" class="po_qty_pid" value="'+poList.pid+'">\
                                 </td>\
                            </tr>\
                            ';
                           
                            });
                            poListHtml+='</tbody></table>'
                     
              
             

                pName=targetElement.dataset.name;
                BootstrapDialog.confirm({
                    type:BootstrapDialog.TYPE_PRIMARY,
                    title:'Update Purchase Order: Batch #: <strong>'+ batchNumber +'</strong>',
                    message:poListHtml,
                    callback:function(toAdd){
                        if(toAdd){
                           formTableContainer='formTable_'+batchNumber;
                            qtyReceivedList=document.querySelectorAll('#' + formTableContainer + ' .po_qty_received');
                            qtyDeliveredList=document.querySelectorAll('#' + formTableContainer + ' .po_qty_delivered input');
                            statusList=document.querySelectorAll('#' + formTableContainer + ' .po_qty_status');
                            rowIds=document.querySelectorAll('#' + formTableContainer + ' .po_qty_row_id');
                            qtyOrdered=document.querySelectorAll('#' + formTableContainer + ' .po_qty_ordered');
                            pids=document.querySelectorAll('#' + formTableContainer + ' .po_qty_pid');
               
                            poListsArrForm=[];
                            for(i=0;i<qtyDeliveredList.length;i++){
                                poListsArrForm.push({
                                    qtyReceived:qtyReceivedList[i].innerText,
                                    qtyDelivered:qtyDeliveredList[i].value,
                                    status:statusList[i].value,
                                    id:rowIds[i].value,
                                    qtyOrdered:qtyOrdered[i].innerText,
                                    pid:pids[i].value
                            });
                            }
                            

                            
                        $.ajax({
                        method:'POST',
                        data:{
                            payload:poListsArrForm
                        },
                        url:'database/update-order.php',
                        dataType:'json',
                                    success: function(data) {
                 message = data.message;
              BootstrapDialog.alert({
               type: data.success ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER,
            message: message,
        callback: function() {
            if (data.success) location.reload();
        }
    });
} 
                    
                        
                    });
                }
                    }
                })
           
            }
            if(classList.contains('appDeliveryHistory')){
                let id=targetElement.dataset.id;
                $.get('database/view-delivery-history.php',{id:id},function(data){
                 if(data.length){
                   rows='';
                   
                    data.forEach((row,id)=>{
                        receivedDate=new Date(row['date_received']);
                        rows += '\
                                <tr>\
                                    <td>'+(id+1)+'</td>\
                                    <td>'+receivedDate.toUTCString()+' '+receivedDate.getUTCHours()+':'+receivedDate.getUTCMinutes()+'</td>\
                                    <td>'+row['qty_received']+'</td>\
                                </tr>\
                                ';
                            });
                    deliveryHistoryHtml = '<table class="deliveryHistoryTable">\
                                            <thead>\
                                                <tr>\
                                                    <th>#</th>\
                                                    <th>Date Received</th>\
                                                    <th>Quantity Received</th>\
                                                </tr>\
                                            </thead>\
                                            <tbody>\
                                             '+rows+'\
                                                </tbody>\
                                        </table>';

                    
                        
                    BootstrapDialog.show({
                      title:'<strong>Delivery History</strong>',
                      type:BootstrapDialog.TYPE_PRIMARY,
                      message:deliveryHistoryHtml
                    });

                 } else{
                    BootstrapDialog.alert({
                        title:'<strong>No Delivery History</strong>',
                     type:BootstrapDialog.TYPE_INFO,
                     message:'No Delivery History Found on Selected Product'
                    });
                 }
                 console.log(data);
                },'json');
      }
      
        });

    
    };
    
    
}

var script = new script;
script.initialize();
           


                </script>
    </body>
</html>
