<form action="uploadcsv.php" method="post" enctype="multipart/form-data">
<input type="file" name="csv" value="" />
<input type="submit" name="submit" value="Save" /></form>

<?php

ini_set('auto_detect_line_endings',TRUE);

function import_csv_to_sqlite ($filename, $dbname){
	
		echo 'Open csv'.'<br>';
		$csv = parse_my_csv($filename);
		$db = new SQLite3($dbname);

		$i = count($csv)-1;

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