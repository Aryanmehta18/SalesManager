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
