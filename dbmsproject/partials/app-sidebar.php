<?php
    $user=$_SESSION['user'];
?>
<style>
  #dashboard_sidebar.dashboard_sidebar{
    width: 25%;
    background: #323232;
    height: 170vh;
}
div.dashboard_sidebar_user span{
    top: 10%;
    font-size: 18px;
    text-transform: uppercase;
    color:#fff ;
    margin-bottom: -100px;
   display: inline-block;
}
ul.dashboard_menu_lists li:hover{
    background: #011037;
    color: #fff;
    transition: 0.3s all;
}
    </style>
<div class="dashboard_sidebar" id="dashboard_sidebar">
    <h3 class="dashboard_logo">SMS</h3>
    <div class="dashboard_sidebar_user">
        <img src="images/userimg.jpg" alt="User image. "/>
        <span><?= $user['first_name'].' '.$user['last_name']?></span>
    </div>
    <div class="dashboard_sidebar_menus">
        <ul class="dashboard_menu_lists">
            <li class="liMainMenu">
                <a href="./dashboard.php" ><i class="fa fa-dashboard"></i>Dashboard</a>
            </li>
              <li class="liMainMenu">
                <a href="./report.php" ><i class="fa fa-file"></i>Reports</a>
            </li>
            <li class="liMainMenu">
                 <a href="javascript:void(0);"class="showHideSubMenu">
                <i class="fa fa-tag showHideSubMenu"></i>
                <span class="showHideSubMenu">Product Management </span>
                <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu"></i>
                </a>
                <ul class="subMenus"> <!-- Corrected opening tag from <u1> to <ul> -->
                    <li> <a class="subMenuLink" href="./product-view.php"> <i class="fa fa-circle-o"></i> View Product</a></li>
                    <li> <a class="subMenuLink" href="./product-add.php"> <i class="fa fa-circle-o"></i> Add Product</a></li>
                   
                </ul>
                   
            </li>
              <li class="liMainMenu">
                  <a href="javascript:void(0);"class="showHideSubMenu">
                <i class="fa fa-shopping-cart showHideSubMenu"></i>
                <span class="showHideSubMenu">Purchase Order </span>
                <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu"></i>
                </a>
                <ul class="subMenus"> <!-- Corrected opening tag from <u1> to <ul> -->
                    <li> <a class="subMenuLink" href="./product-order.php"> <i class="fa fa-circle-o"></i> Create Order</a></li>
                    <li> <a class="subMenuLink" href="./view-order.php"> <i class="fa fa-circle-o"></i> View Order</a></li>
                </ul>
                   
            </li>
             <li class="liMainMenu">
                  <a href="javascript:void(0);"class="showHideSubMenu">
                <i class="fa fa-truck showHideSubMenu"></i>
                <span class="showHideSubMenu">Supplier Management </span>
                <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu"></i>
                </a>
                <ul class="subMenus"> <!-- Corrected opening tag from <u1> to <ul> -->
                    <li> <a class="subMenuLink" href="./supplier-view.php"> <i class="fa fa-circle-o"></i> View Supplier</a></li>
                    <li> <a class="subMenuLink" href="./supplier-add.php"> <i class="fa fa-circle-o"></i> Add Supplier</a></li>
                </ul>
                   
            </li>
            <li class="liMainMenu showHideSubMenu" class="showHideSubMenu">
                <a href="javascript:void(0);"class="showHideSubMenu">
                <i class="fa fa-user-plus showHideSubMenu"></i>
                <span class="showHideSubMenu">User Management </span>
                <i class="fa fa-angle-left mainMenuIconArrow showHideSubMenu"></i>
                </a>
                <ul class="subMenus"> <!-- Corrected opening tag from <u1> to <ul> -->
                    <li> <a class="subMenuLink" href="./users-view.php"> <i class="fa fa-circle-o"></i> View Users</a></li>
                    <li> <a class="subMenuLink" href="./users-add.php"> <i class="fa fa-circle-o"></i> Add Users</a></li>
                </ul>
            </li>
        </ul>
    </div>

