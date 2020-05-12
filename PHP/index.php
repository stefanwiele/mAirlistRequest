<html>
    <head>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<link rel="stylesheet" type="text/css" href="./css/default.css">

		<script>
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
						dataType:"JSON",						
						success:function(res) {
							
							$('#results').html("");
							var data_table = '';
							data_table += "<table>";
							$.each(res, function(i, item){
								
								data_table += "<tr class='request' id="+item.databaseID+"><td>"+item.artist+"</td>";
								data_table += "<td>"+item.title+"</td></tr>";								
							});	
							data_table += "</table>";
						$('#results').append(data_table);
						}
						   			
					});
					
				});
				$('#results').on('click', 'tr.request',function(){
						
					//var id = $(this).text();
					var id = $(this).attr('id');

						$.ajax({
						url: "api.php"+"/setrequest/"+id,
						type: "GET",	
						dataType: 'text',				
						success:function() {
							alert('Request successfully added');						
						}					

					});
					});							

			});			
			
			

  	   	</script>

    	<title>mAirlistRequest - Home</title>
	</head>
	
    <body>			
		<br />
		
			<div id='searchbox'>
			    <label for "search">Search for your request:</label>
        		<input type="text" id="search" />
				<input type="button" id="getData" class="button" value="Search"/>
			</div>
	
		

		<div id='results' class='results'></div>				
		
		
        
</html>