$(document).ready(function(){

    $('#search').keyup(function(e){
           if(e.keyCode == 13)
    {
        $('#getData').click();
    }
    });

        $('#getData').on('click',function(){
        var search = $('#search').val();
        
        $.ajax({
            url: "api.php"+"/search/"+search,
            type: "GET",						
            dataType:"JSON"
        }).done(function(res) {
                
                $('#results').html("");
                var data_table = '';
                data_table += "<table>";
                $.each(res, function(i, item){
                    
                    data_table += "<tr class='request' id="+item.databaseID+"><td>"+item.artist+"</td>";
                    data_table += "<td>"+item.title+"</td></tr>";								
                });	
                data_table += "</table>";
            $('#results').append(data_table);
            });			   			
        
        
    });
    $('#results').on('click', 'tr.request',function(){
                        
        var id = $(this).attr('id');

            $.ajax({

            url: "api.php"+"/setrequest/"+id,
            type: "GET",	
            dataType: 'text',			
            statusCode: {
                409: function() {
                    alert("You have reached the maximum number of requests");
                }
            }						
        }).done(function() {
                alert('Request successfully added');						
            });	
        });		
        
        $('#menu').on('click', '.home',function(){
            $('#searchbox').show();		   			
            $('#results').html("");            
        });

        $('#menu').on('click', '.requests',function(){
            $('#searchbox').hide();		   			
            $('#results').html("");            
        });

});			


