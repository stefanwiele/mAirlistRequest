<html>
    <head>
    	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    	

    	<title>mAirlist search</title>
	</head>
	
    <body>
		<br />
		
        <input type="text" id="search" />
		<input type="button" id="getData" value="Search"/>

		<table id="dataTable">
			<tr>
				<th>Artist</th>
				<th>Title</th>
			</tr>		
		</table>
		<br />



		<script>

			$(document).ready(function(){
    				$('#getData').on('click',function(){
					var search = $('#search').val();
					$('#dataTable').removeData();
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
								data_table += "<td><a href='"+item.DatabaseID+"'>Request</a></td></tr>";
							});	
						$('#dataTable').append(data_table);
						}
						   			
					});
					
				});			
			});

  	   	</script>
        
</html>