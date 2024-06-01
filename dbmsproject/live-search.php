<!DOCTYPE html>
<html>
<head>
</head>
<body>
     <input type="text" id="searchInput" placeholder="Enter Search Item..">
     <div id="searchResult"></div>
     <!-- Include jQuery from CDN -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

     <script>
        var typingTimer;
        var doneTypingInterval=1000;
       document.addEventListener('keyup',function(ev){
       let el=ev.target;
       if(el.id === 'searchInput'){
        let searchTerm=el.value;
        clearTimeout(typingTimer);
        typingTimer=setTimeout(function(){
            searchDb(searchTerm);
        }, doneTypingInterval);
       }
       }); 
       function searchDb(searchTerm) {
    $.ajax({
        type: 'GET',
        data: { search_term: searchTerm },
        url: 'database/live-search.php',
        success: function(response) {
            let searchResult = document.getElementById('searchResult');
            if (Object.keys(response.data).length === 0) {
                searchResult.innerHTML = 'No Data Found';
            } else {
                let html = '';
                for (const [tbl, tblRows] of Object.entries(response.data)) {
                    tblRows.forEach((row) => {
                        let text = '';
                        let url = '';
                        if (tbl === 'users') {
                            text = row.first_name + ' ' + row.last_name;
                            url = 'users-view.php';
                        }
                        if (tbl === 'suppliers') {
                            text = row.supplier_name;
                            url = 'supplier-view.php';
                        }
                        if (tbl === 'products') {
                            text = row.product_name;
                            url = 'product-view.php';
                        }
                        html += '<a href="' + url + '">' + text + '</a> <br/>';
                    });
                }
                searchResult.innerHTML = html; // Assign HTML content after the loop
            }
        },
        dataType: 'json'
    });
}
</script>
</body>
</html>
