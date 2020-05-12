

<html>
	<head>
		<title>mAirlistRequest - Update Database from CSV</title>
		<link rel="stylesheet" type="text/css" href="./css/default.css">
	</head>
<body>
<form action="uploadcsv.php" method="post" enctype="multipart/form-data">

<div id='uploadcsv'>
<center>
<label>Step 1: Export CSV from mAirlist Database Window. And select the file using this button -><input type="file" name="csv" value="" /></label><br><br>
<label>Step 2: Enter secret from settings file here -><input type="password" name="secret" /></label><br><br>
<label>Step 3: Press Update Database -><input type="submit" name="submit" value="Update Database" /></label></form>
</center>
</div>

<?php


//get settings
include('./inc/settings.inc.php');

ini_set('auto_detect_line_endings',TRUE);

function import_csv_to_sqlite ($filename, $dbname){
	
		echo '<tr><td>Open csv...</td></tr>';
		$csv = parse_my_csv($filename);
		$db = new SQLite3($dbname);

		$i = count($csv)-1;

		echo '<tr><td>Deleting table and vacuum...</td></tr>';
		$db->exec('DELETE FROM music');		
		$db->exec('VACUUM');		

		echo '<tr><td>Creating Query...</td></tr>';
		$query = 'INSERT into music (databaseID, artist, title, folder) VALUES ';

		
		while ($i > 0) {
						
			$databaseid = $csv[$i][0];			
			$artist = SQLite3::escapeString($csv[$i][4]);
			$title = SQLite3::escapeString($csv[$i][3]);
		

			if ($i <> 1) {
				$query = $query .= "('".$databaseid."','".$artist."','".$title."','0'),";
			}
			else{
				$query = $query .= "('".$databaseid."','".$artist."','".$title."','0');";
			}

			
		
			$i--;			
		}

		echo '<tr><td>Executing Query...</td></tr>';
		$db->exec($query);


		$db->close();
		unset($db);
		
		echo '<tr><td>Done...</td></tr>';


}


function parse_my_csv($filename) { 
    $lines = file($filename);
    $data = array();
    for($i=0;$i<count($lines);$i++) { 
       array_push($data, str_getcsv($lines[$i]));
    }
 return $data;
}

if(isset($_POST['submit'])) 
{ 

	if (isset($_POST["secret"])) {

		
		if ($_POST["secret"] <> $uploadCsvSecret){
			echo 'access denied';
			exit;
		}
	}

    $csv = array();

	echo '<table>';
    
    // check there are no errors
    	if($_FILES['csv']['error'] == 0){
        
        	$name = $_FILES['csv']['tmp_name'];              
			$dbname = 'mAirlistRequest.db';
		
			import_csv_to_sqlite($name,$dbname);
		}
		else {echo 'CSV has errors'; exit;}

		echo '</table>';

}

?>
</body>
</html>