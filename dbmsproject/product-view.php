<?php
    session_start();
     $users = "users";
    if(!isset($_SESSION['user'])) header('location: login.php');
    $show_table='products';
    $user=$_SESSION['user'];
    $products=include('database/show.php');
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Products SMS</title>
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
.dashboard_content_main{
    background:#fff;
    min-height:800px;
    height:100%;
    padding-left:20px;
    border:1px solid #011037;
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
                   <h1 class="section_header"><i class="fa fa-list"></i> List Of Products</h1>
                   <div class="section_content">
                    <div class="users">
                       
                        <table>
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                 <th>Stock</th>
                                 <th width="10%">Description</th>
                                 <th>Suppliers</th>
                                  <th>Created By</th>
                                   <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($products as $index=>$product){
                                ?> 
                                   <tr>
                                    <td><?=$index+1?></td>
                                   <td class="firstName">
    <img src="uploads/products/<?= $product['img']?>" alt="" style="max-width: 300px; max-height: 100px;" />
</td>

                                   <td class="lastName"><?=$product['product_name']?></td>
                                   <td class="lastName"><?=number_format($product['stock'])?></td>
                                    <td class="email"><?=$product['description']?></td>
                                      <td class="email">
                                       <?php
                                           $supplier_list='-';
                                           $pid=$product['id'];
                                           $stmt=$conn->prepare("SELECT supplier_name FROM suppliers,productsuppliers WHERE productsuppliers.product=$pid AND productsuppliers.supplier=suppliers.id");
                                           $stmt->execute();
                                           $row=$stmt->fetchAll(PDO::FETCH_ASSOC);
                                           if($row){

                                           $supplier_arr=array_column($row,'supplier_name');
                                           $supplier_list='<li>' . implode("</li><li>",$supplier_arr);
                                           }
                                           echo $supplier_list;
                                           
                                           
                                       ?>
                                    </td>
                                     <td>
                                        <?php
                                            $uid = $product['created_by'];
                                            $stmt = $conn->prepare("SELECT * FROM users WHERE id = :uid");
                                            $stmt->bindParam(':uid', $uid);
                                            $stmt->execute();
                                            $row = $stmt->fetch(PDO::FETCH_ASSOC);
                                            $created_by_name = $row['first_name'] . ' ' . $row['last_name'];
                                            echo $created_by_name;
                                        ?>
                                    </td>

                                    <td><?=date('M d,Y @ h:i:s A',strtotime($product['created_at']))?></td>
                                     <td><?=date('M d,Y @ h:i:s A',strtotime($product['updated_at']))?></td>
                                     <td>
                                        <a href="" class="updateProduct" data-pid="<?=$product['id']?>" ><i class="fa fa-pencil"></i>Edit</a>
                                        <a href="" class="deleteProduct" data-name="<?=$product['product_name']?>"data-pid="<?=$product['id']?>" ><i class="fa fa-trash"></i>Delete</a>
                                     </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                            <p class="userCount"><?= count($products) ?> Products </p>
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

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.js" integrity="sha512-AZ+KX5NScHcQKWBfRXlCtb+ckjKYLO1i10faHLPXtGacz34rhXU8KM4t77XXG/Oy9961AeLqB/5o0KTJfy2WiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <?php
    $show_table='suppliers';
    $suppliers = include('database/show.php');
    $supplier_arr=[];

    foreach ($suppliers as $supplier) {
    $supplier_arr[$supplier['id']]= $supplier['supplier_name'];
  }
     $supplier_arr=json_encode($supplier_arr);
?>
            <script>
       var suppliersList=<?=$supplier_arr ?>;

       
        
           function script() {
            var vm=this;
    this.initialize = function () {
        this.registerEvents();
    };
    this.registerEvents = function () {
        document.addEventListener('click', function (e) {
           
            targetElement = e.target;
            classList = targetElement.classList;

            if (classList.contains('deleteProduct')) {
                e.preventDefault();
                pId=targetElement.dataset.pid;
                pName=targetElement.dataset.name;
                BootstrapDialog.confirm({
                    type:BootstrapDialog.TYPE_DANGER,
                    title:'Delete Product',
                    message:'Are You Sure To Delete <strong> '+pName+'</strong>?',
                    callback:function(isDelete){
                        $.ajax({
                        method:'POST',
                        data:{
                            id:pId,
                            table:'products'
                        },
                        url:'database/delete.php',
                        dataType:'json',
                                    success: function(data) {
                 var message = data.success ? pName + ' successfully deleted!' : 'Error Processing Your Request!';

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
                })
           
            }
            if(classList.contains('updateProduct')){
                e.preventDefault();
                pId=targetElement.dataset.pid;
                vm.showEditDialog(pId);
      }
      
        });

      document.addEventListener('submit',function(e){
        e.preventDefault();
        targetElement=e.target;
        if(targetElement.id == 'editProductForm'){
            vm.saveUpdatedData(targetElement);
        }
      })
    };
    this.saveUpdatedData=function(form){
        $.ajax({
                method: 'POST',
                data: new FormData(form),
                url: 'database/update-product.php',
                processData:false,
                contentType:false,
                dataType:'json',
                success: function (data) {
                    if (data.success) {
                      BootstrapDialog.alert({
                        type:BootstrapDialog.TYPE_SUCCESS,
                        message:data.message,
                        callback:function(){
                            location.reload();
                        }
                      });
                    } else {
                        BootstrapDialog.alert({
                        type:BootstrapDialog.TYPE_DANGER,
                        message:data.message,
                        
                      });
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
    }
    this.showEditDialog=function(id){
         $.get('database/get-product.php',{id:id},function(productDetails){
        let curSuppliers=productDetails['suppliers'];
        let supplierOption='';
        for(const [supId,supName] of Object.entries(suppliersList)){
            selected=curSuppliers.indexOf(supId)>-1 ? 'selected' : '';
            supplierOption+="<option "+selected+" value='"+ supId +"'>"+ supName+"</option>";
        }
        console.log(supplierOption);

     
     BootstrapDialog.confirm({
    title: 'Update <strong>' + productDetails.product_name + '</strong>',
   message: ' <form action="database/add.php" method="POST" enctype="multipart/form-data" id="editProductForm">\
        <div class="appFormInputContainer">\
            <label for="product_name">Product Name</label>\
            <input type="text" class="appFormInput" id="product_name" placeholder="Enter Product Name" name="product_name"/>\
        </div>\
         <div class="appFormInputContainer">\
         <label for="description">Suppliers</label>\
         <select name="suppliers[]" id="suppliers" multiple="" class="appSelect">\
            <option value="">Select Supplier</option>\
            '+supplierOption+'\
           </select>\
                            </div>\
        <div class="appFormInputContainer">\
            <label for="description">Description</label>\
            <textarea class="appFormInput productTextAreaInput" placeholder="Enter Product Description" id="description" name="description"></textarea>\
        </div>\
        <div class="appFormInputContainer">\
            <label for="product_name">Product Image</label>\
            <input type="file" name="img"/>\
        </div>\
        <input type="hidden" name="pid" value="' + productDetails.id + '"/>\
        <input type="submit" value="submit" id="editProductSubmitBtn" class="hidden"/>\
        </form>\
        ',
        



    callback: function (isUpdate) {
        if (isUpdate) {
            document.getElementById('editProductSubmitBtn').click();
        }
    }
});

        },'json');
    


    };
}

var script = new script;
script.initialize();
           


                </script>
    </body>
</html>
