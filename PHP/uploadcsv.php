<form action="uploadcsv.php" method="post" enctype="multipart/form-data">
1. Export CSV from mAirlist Database Window.<br>2. Select the file.<br>3. Enter secret from settings file and press Update Database.<br>
<table>
<tr><td><input type="file" name="csv" value="" /><br></td></tr>
<tr><td>Secret:<input type="password" name="secret" /><br></td></tr>
<tr><td><input type="submit" name="submit" value="Update Database" /></form></td</tr>
</table>

<?php


//get settings
include('./inc/settings.inc.php');

ini_set('auto_detect_line_endings',TRUE);

function import_csv_to_sqlite ($filename, $dbname){
	
		echo 'Open csv'.'<br>';
		$csv = parse_my_csv($filename);
		$db = new SQLite3($dbname);

		$i = count($csv)-1;

		echo 'Deleting table and vacuum <br>';
		$db->exec('DELETE FROM music');		
		$db->exec('VACUUM');		

		echo 'Creating Query'.'<br>';
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

		echo 'Executing Query'.'<br>';
		$db->exec($query);


		$db->close();
    	unset($db);


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

    
    // check there are no errors
    	if($_FILES['csv']['error'] == 0){
        
        	$name = $_FILES['csv']['tmp_name'];              
			$dbname = 'mAirlistRequest.db';
		
			import_csv_to_sqlite($name,$dbname);
		}
		else {echo 'CSV has errors'; exit;}

}

?>