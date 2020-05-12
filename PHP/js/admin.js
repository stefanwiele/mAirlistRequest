$(document).ready(function(){

    $('#menu').on('click', '.requests',function(){		   			
        $('#about').hide();
        $.ajax({
            url: "../api.php"+"/getallrequests/",
            type: "GET",						
            dataType:"JSON"
        }).done(function(res) {
                
                $('#results').html("");
                var data_table = '';
                data_table += "<table><tr><th>Database ID</th><th>IP Address</th><th>Actions</th></tr>";
                $.each(res, function(i, item){
                    
                    data_table += "<tr class='request'><td>"+item.databaseID+"</td>";
                    data_table += "<td>"+item.ipaddress+"</td>";								
                    data_table += "<td><button>Remove</button> <button>Make Next</button> <button>Block IP</button></td></tr>";	
                });	
                data_table += "</table>";
            $('#results').append(data_table);
            });	
        });

            $('#results').on('click', 'tr.request',function(){		   			
                alert('todo');
            });

            $('#menu').on('click', '.home',function(){		   			
                $('#results').html("");
                $('#about').hide();
            });

            $('#menu').on('click', '.about',function(){		   			
                $('#results').html("");
                $('#about').show();
            });
           
           
           

});
