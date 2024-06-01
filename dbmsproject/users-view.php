<?php
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $show_table='users';
    $user=$_SESSION['user'];
    $users=include('database/show-users.php');
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SalesMate Homepage</title>
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
                   <h1 class="section_header"><i class="fa fa-list"></i> List Of Users</h1>
                   <div class="section_content">
                    <div class="users">
                       
                        <table>
                            <thead>
                                <tr>
                                <th>#</th>
                                <th>First Name</th>
                                 <th>Last Name</th>
                                  <th>Email</th>
                                   <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php foreach($users as $index=>$user){
                                ?> 
                                   <tr>
                                    <td><?=$index+1?></td>
                                    <td class="firstName"><?=$user['first_name']?></td>
                                   <td class="lastName"><?=$user['last_name']?></td>
                                    <td class="email"><?=$user['email']?></td>
                                    <td><?=date('M d,Y @ h:i:s A',strtotime($user['created_at']))?></td>
                                     <td><?=date('M d,Y @ h:i:s A',strtotime($user['updated_at']))?></td>
                                     <td>
                                        <a href="" class="updateUser" data-userid="<?=$user['id']?>"><i class="fa fa-pencil"></i>Edit</a>
                                        <a href="" class="deleteUser" data-userid="<?=$user['id']?>" data-fname="<?=$user['first_name']?>" data-lname="<?=$user['last_name']?>"><i class="fa fa-trash"></i>Delete</a>
                                     </td>
                            </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                            <p class="userCount"><?= count($users) ?> Users </p>
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
            <script>

           function script() {
    this.initialize = function () {
        this.registerEvents();
    };
    this.registerEvents = function () {
        document.addEventListener('click', function (e) {
            targetElement = e.target;
            classList = e.target.classList;

            if (classList.contains('deleteUser')) {
                e.preventDefault();
                userId = targetElement.dataset.userid;
                fname=targetElement.dataset.fname;
                lname=targetElement.dataset.lname;
                fullName=fname+' '+lname;
                BootstrapDialog.confirm({
                     title:'Delete User',
                    type:BootstrapDialog.TYPE_DANGER,
                    message:'Are You Sure To Delete <strong> '+fullName+'</strong>?',
                    callback:function(isDelete){
                        $.ajax({
                       
                        method:'POST',
                        data:{
                            id:userId,
                            table:'users',
                           
                        },
                        url:'database/delete.php',
                        dataType:'json',
                    success: function(data) {
    var message = data.success ? fullName + ' successfully deleted!' : 'Error Processing Your Request!';

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
            if(classList.contains('updateUser')){
                e.preventDefault();
                firstName=targetElement.closest('tr').querySelector('td.firstName').innerHTML;
                lastName=targetElement.closest('tr').querySelector('td.lastName').innerHTML;
                email=targetElement.closest('tr').querySelector('td.email').innerHTML;
                userId = targetElement.dataset.userid;
BootstrapDialog.confirm({
    title: 'Update ' + firstName + ' ' + lastName,
    message: '<form>\
       <div class="form-group">\
       <label for="firstName">First Name:</label>\
       <input type="text" class="form-control" id="firstName" value="' + firstName + '">\
       </div>\
       <div class="form-group">\
       <label for="lastName">Last Name:</label>\
       <input type="text" class="form-control" id="lastName" value="' + lastName + '">\
       </div>\
       <div class="form-group">\
       <label for="email">Email address:</label>\
       <input type="email" class="form-control" id="emailUpdate" value="' + email + '">\
       </div>\
       </form>',
    callback: function (isUpdate) {
        if (isUpdate) {
            $.ajax({
                method: 'POST',
                data: {
                    user_id: userId,
                    f_name: document.getElementById('firstName').value,
                    l_name: document.getElementById('lastName').value,
                    email: document.getElementById('emailUpdate').value,
                },
                url: 'database/update-user.php',
                dataType: 'json',
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
    }
});




              
            }
        });
    };
}
var script = new script;
script.initialize();


                </script>
    </body>
</html>
