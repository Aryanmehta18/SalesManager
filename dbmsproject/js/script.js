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
document.addEventListener('click',function(e){
    console.log(e);
});

  document.addEventListener('click', function (e) {
    let clickedEl = e.target;
    if (clickedEl.classList.contains('showHideSubMenu')) {
        alert('main menu');
    }
});
console.log("JavaScript is running!");
console.log(document.querySelectorAll('.liMainMenu_link'));

