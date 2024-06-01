<?php
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $show_table='products';
    $products=include('database/show.php');
    $products=json_encode($products);
    
   
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Order Product SMS</title>
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
    background:#011037;
}
.productTextAreaInput{
    width:100%;
    height:75px;
    border-radius:5px;
    border-color:#d7d7d7;
}
.appSelect{
    display:block;
    width:100%;
    height:100px;
    border-color:#d2d2d2;

}
.shift-right {
    margin-left: 30px; /* Adjust this value to shift more or less */
}
.alignRight{
    text-align:right;
}
#orderProductLists{
    margin-top:20px;
}
#orderProductLists.row{
    margin:none !important;
}
.productNameSelect{
    font-size:15px;
    border:none;
    background:#fafafa;
    padding:3px 17px;
    border:1px solid #b0b0b0;
    border-radius:2px;
}
.marginTop20{
    margin-top:20px;
}
h1.section_header{
   
    font-size: 22px;
    color: #0c0238;
    border-bottom: 1px solid #0d012e;
    padding-bottom: 11px;
    padding: 10px;
    border-left: 4px solid #08004d;
    margin-bottom:15px;
    margin-left: 17px;
}
.suppliersRows .supplierName{
    margin-left:12px;
    font-size:15px;
    font-weight:bold;
    color:#a1a1a1;
    text-transform:uppercase;
}
.dashboard_content_main{
    background:#fff;
    min height:800px;
    height:100%;
    border:1px solid #cdcdcd;
    padding-left:20px;
    padding-bottom:25px;
}
.supplierRows .row{
    padding:8px 0px;
}
.orderProductBtn{
    height:33px;
    border:none;
    background:#011037;
    padding:2px 10px;
    border-radius:4px;
    color:#fff;
    font-size:16px;
}
.appbtn{
    border:none;
    padding:4px 8px;
    background:#ff5858;
    border-radius:2px;
}
.removeOrderBtn{
background:#ff5858;
color:#fff;
float:right;
}
 .orderProductRow{
    padding:6px;
    border-bottom:2px solid #e0e0e0;
    padding-bottom:25px;
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
                    <div class="column column-12">
                        <h1 class="section_header"><i class="fa fa-plus"></i> Order Product</h1>
                        <div class="shift-right">
                            <form action="database/save-order.php" method="POST" id="orderForm">
                                <div class="alignRight">
                                    <button type="button" class="orderProductBtn" id="orderProductBtn">Add New Product</button>
                                </div>
                                <div id="orderProductLists">
                                    <p style="color:#9f9f9f;">No Product Selected</p>
                                    <div class="orderProductRow">
                                        <div class="suppliersRows">
                                            <!-- Existing product input fields -->
                                        </div>
                                    </div>
                                </div>
                                <div class="alignRight marginTop20">
                                    <button type="submit" class="orderProductBtn">Submit Order</button>
                                </div>
                            </form>
                        </div>
                        <?php 
                            if(isset($_SESSION['response'])){ 
                                $response_message=$_SESSION['response']['message'];
                                $is_success=$_SESSION['response']['success'];
                                ?>
                                   <div class="responseMessage">
                                    <p class="<?=$is_success ? 'responseMessage__success':'responseMessage__error' ?>">
                                    <?=$response_message ?>
                                    </p>
                                   </div>
                            <?php unset($_SESSION['response']); }?>
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

<script>
  var products = <?=($products) ?>;
  var counter=0;
  function script(){
    var vm=this;
      let productOptions = '<div>\
    <label for="product_name">Product Name</label>\
    <select name="products[]" class="productNameSelect" id="product_name">\
    <option value="">Select Product</option>\
    INSERTPRODUCTHERE\
    </select>\
    <button class="appbtn removeOrderBtn">Remove</button>\
    </div>';


    this.initialize = function(){
      this.registerEvents();
      this.renderProductOptions();
    },
    this.renderProductOptions=function(){
  
      let optionHtml='';
      products.forEach((product) =>{
        optionHtml +='<option value="'+product.id+'">'+product.product_name+'</option>';
      })
      productOptions=productOptions.replace('INSERTPRODUCTHERE',optionHtml);
    },
    
    this.registerEvents = function(){
      document.addEventListener('click', function(e) {
    targetElement = e.target;
    classList = targetElement.classList;

    if (targetElement.id === 'orderProductBtn') {
        let orderProductListsContainer = document.getElementById('orderProductLists');
        orderProductListsContainer.innerHTML += '<div class="orderProductRow">' +
            productOptions +
            '<div class="suppliersRows" id="supplierRows_' + counter + '" data-counter="' + counter + '">' +
            '</div>' +
            '</div>';
        counter++; // Increment the counter for each new row
    }

    if (targetElement.classList.contains('removeOrderBtn')) {
        let orderRow = targetElement.closest('div.orderProductRow');
        orderRow.remove();
    }
});

      document.addEventListener('change', function(e){
        targetElement = e.target;
         classList = targetElement.classList;

        if(classList.contains('productNameSelect')){
            let pid=targetElement.value;
            // clickedEl.closest('li').querySelector('.subMenus');
            let counterId=targetElement.closest('div.orderProductRow').querySelector('.suppliersRows').dataset.counter;

           

             $.get('database/get-product-supplier.php',{id:pid},function(suppliers){
                    vm.renderSupplierRows(suppliers,counterId);
             },'json');
         }
      });
    },
    this.renderSupplierRows=function(suppliers,counterId){
     let supplierRows='';
     suppliers.forEach((supplier)=>{
        supplierRows+= '<div class="row">\
                <div style="width:50%;">\
                <p class="supplierName">'+supplier.supplier_name+'</p>\
                </div>\
                <div style="width:50%;">\
                <label for="quantity">Quantity:</label>\
                <input type="number" class="appFormInput orderProductQty" id="quantity" placeholder="Enter Quantity" name="quantity['+counterId+']['+supplier.id+']"/>\
                </div>\
                </div>';
     });   

     let supplierRowContainer=document.getElementById('supplierRows_'+ counterId);
     supplierRowContainer.innerHTML=supplierRows;
     
    
    }
  }

  // Define productOptions outside the script function


  (new script()).initialize();
</script>




<script src="js/jquery/jquery-3.5.1.min.js"></script>
            <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.35.4/js/bootstrap-dialog.js" integrity="sha512-AZ+KX5NScHcQKWBfRXlCtb+ckjKYLO1i10faHLPXtGacz34rhXU8KM4t77XXG/Oy9961AeLqB/5o0KTJfy2WiA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    </body>
</html>
