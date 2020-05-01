<html>
    <head>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    	

    	<title>mAirlist search</title>
	</head>
	
    <body>
		<br />
		
        <input type="text" id="search" />
		<input type="button" id="getData" value="Search"/>

		<div id='results'></div>	
		<br />

		<script>
			$(document).ready(function(){
    				$('#getData').on('click',function(){
					var search = $('#search').val();
					
					$.ajax({
						url: "request.php",
						type: "GET",
						data:{search:search},
						dataType:"JSON",						
						success:function(res) {
							
							var data_table = '';
							$.each(res, function(i, item){
								
								data_table += "<tr><td>"+item.Artist+"</td>";
								data_table += "<td>"+item.Title+"</td>";
								data_table += "<td><p class='test'>"+item.DatabaseID+"</p></td></tr>";
							});	
						$('#results').append(data_table);
						}
						   			
					});
					
				});
				$('#results').on('click', 'p.test',function(){
						
					var id = $(this).text();
						$.ajax({
						url: "api.php"+"/setrequest/"+id,
						type: "GET",	
						dataType: 'text',				
						success:function() {
							alert('request added');
						}
					});
					});							

			});			
			
			

  	   	</script>
        
</html>