<?php
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $user=$_SESSION['user'];
?>

<!DOCTYPE html>
<html>
    <head>
        <title>SalesMate Homepage</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <script src="https://use.fontawesome.com/0c7a3095b5.js"></script>
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
.charts{
    display:flex;
    flex-direction:row;
}
ul.subMenus{
    background: #011037;
  display: none;
}
.col50{
    width: 50%;
}
.dashboard_sidebar{
    background:blue;
}
.dashboard_content_main{
    
   background:#fff;
    
    height:100%;
    padding-left:20px;
    border:1px solid #011037;
}
.alignRight{
    text-align:right;
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
    .reportTypeContainer{
        display:flex;
        justify-content:center;
        padding:10px 31px;
    }
    .reportType{
        border:1px solid #c2c6c2;
        padding:10px 24px;
        border-radius:4px;
        background:#fff;
        font-size:14px;
        margin-left:21px;
        width:100%;
    }
    .reportExportBtn{
        padding:4px 15px;
        display:inline-block;
        text-decoration:none;
        text-transform:uppercase;
        background: #011037;
        color:white;
        margin-right:13px;
        font-size:11px;
        border:1px solid transparent
    }
    .reportExportBtn:hover{
         border:1px solid #011037;
         background:#fff;
         color:#011037;
    }
    .reportType p{
        font-size:20px;
        font weight:200;
        margin-bottom:10px;
    }
    .reportType:hover{
        background:#8a86a8;
        color:#fff;
    }
        </style>
    </head>
    <body>
        <div id="dashboardMainContainer">
           <?php include('partials/app-sidebar.php')?>
</div>
            <div class="dashboard_content_container" id="dashboard_content_container">
                <?php include('partials/app-topnav.php')?>
               <div id="reportsContainer">
                <div class="reportTypeContainer">
               <div class="reportType">
                <p>Export Products</p>
                <div class="alignRight">
                    <a href="database/report_csv.php?report=product" class="reportExportBtn">Excel</a>
                    <a href="database/report_pdf.php?report=product" class="reportExportBtn">PDF</a>
               </div>
               </div>
               <div class="reportType">
                <p>Export Suppliers</p>
                <div class="alignRight">
                    <a href="database/report_csv.php?report=supplier" class="reportExportBtn">Excel</a>
                    <a href="database/report_pdf.php?report=supplier" class="reportExportBtn">PDF</a>
               </div>
             </div>
             </div>
             <div class="reportTypeContainer">
               <div class="reportType">
                <p>Export Deliveries</p>
                <div class="alignRight">
                    <a href="database/report_csv.php?report=delivery" class="reportExportBtn">Excel</a>
                    <a href="database/report_pdf.php?report=delivery" class="reportExportBtn">PDF</a>
               </div>
               </div>
               <div class="reportType">
                <p>Export Purchase Orders</p>
                <div class="alignRight">
                    <a href="database/report_csv.php?report=purchase_orders" class="reportExportBtn">Excel</a>
                    <a href="database/report_pdf.php?report=purchase_orders" class="reportExportBtn">PDF</a>
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
</body>
</html>