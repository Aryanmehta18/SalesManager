<?php
    session_start();
    
    if(!isset($_SESSION['user'])) header('location: login.php');
    $user=$_SESSION['user'];
    include('database/po_status_pie_graph.php');
    include('database/supplier_product_bar_graph.php');
    include('database/delivery_history.php');
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
    <!-- Your HTML content -->
    <div id="dashboardMainContainer">
        <?php include('partials/app-sidebar.php')?>
    </div>
    <div class="dashboard_content_container">
        <?php include('partials/app-topnav.php')?>
        
        <div class="dashboard_content">
            <div class="dashboard_content_main">
                <div class="charts">
                    <div class="col50">
                        <figure class="highcharts-figure">
                            <div id="container"></div>
                            <p class="highcharts-description">
                                Pie chart where the individual slices can be clicked to expose more detailed data.
                            </p>
                        </figure>
                    </div>
                    <div class="col50">
                        <figure class="highcharts-figure">
                            <div id="containerBarChart"></div>
                            <p class="highcharts-description">
                                Pie chart where the individual slices can be clicked to expose more detailed data.
                            </p>
                        </figure>
                    </div>
                </div>
                <div id="deliveryHistory"></div>
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
<<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    // Data from PHP
    let graphData = <?= json_encode($results) ?>;
   // Create the chart
    Highcharts.chart('container', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Purchase Order By Status',
            align: 'left'
        },
       tooltip:{
        pointFormatter: function () {
            var point = this,
                series = point.series;
            return `<b> ${point.name}</b>: <b>${point.y}</b>`
        }

       },
        plotOptions: {
            pie: {
                dataLabels: {
                    enabled:true,
                 format:`<b>{point.name}</b>:{point.y}`
                   
                }
            }
        },
        series: [{
            name: 'Status',
            colorByPoint: true,
            data: graphData
        }]
    });


    var barGraphData=<?= json_encode($bar_chart_data)?>;
    var barGraphCategories=<?= json_encode($categories)?>;
    Highcharts.chart('containerBarChart', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Product Count Assigned To Supplier',
},
    xAxis: {
        categories: barGraphCategories,
        crosshair: true,

    },
    yAxis: {
        min: 0,
        title: {
            text: 'Product Count'
        }
    },
    tooltip: {
        valueSuffix: ' (1000 MT)',
        pointFormatter: function () {
    var point = this,
        series = point.series;
    return `<b> ${point.category}</b>: <b>${point.y}</b>`
}
    },
    plotOptions: {
        column: {
            pointPadding: 0.2,
            borderWidth: 0
        }
    },
    series: [
        {
            name: 'Suppliers',
            data: barGraphData
        }
        
    ]
});
var lineCategories= <?= json_encode($line_categories)?>;
var lineData= <?=json_encode($line_data) ?>;
Highcharts.chart('deliveryHistory', {

  title: {
    text: 'Delivery History Per Day',
    align: 'left'
  },



  yAxis: {
    title: {
      text: 'Product Delivered'
    }
  },

  xAxis: {

     categories:lineCategories
        
     
    
  },

  legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
  },

  plotOptions: {
    series: {
      label: {
        connectorAllowed: false
      },
 
    }
  },

  series: [{
    name: 'Product Delivered',
    data: lineData
  }],

  responsive: {
    rules: [{
      condition: {
        maxWidth: 500
      },
      chartOptions: {
        legend: {
          layout: 'horizontal',
          align: 'center',
          verticalAlign: 'bottom'
        }
      }
    }]
  }

});
</script>





      
    </body>
</html>