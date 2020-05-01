<form action="uploadcsv.php" method="post" enctype="multipart/form-data">
<input type="file" name="csv" value="" />
<input type="submit" name="submit" value="Save" /></form>

<?php

if(isset($_POST['submit'])) 
{ 

$csv = array();

// check there are no errors
if($_FILES['csv']['error'] == 0){
    $name = $_FILES['csv']['name'];
    //$ext = strtolower(end(explode('.', $_FILES['csv']['name'])));
    $type = $_FILES['csv']['type'];
    $tmpName = $_FILES['csv']['tmp_name'];

    // check the file is a csv
    //if($ext === 'csv'){
        if(($handle = fopen($tmpName, 'r')) !== FALSE) {
            // necessary if a large csv file
            set_time_limit(0);

            $row = 0;

            while(($data = fgetcsv($handle, 0, ',')) !== FALSE) {
                // number of fields in the csv
                $col_count = count($data);
                

                // get the values from the csv
                $csv[$row]['id'] = $data[0];
                $csv[$row]['col2'] = $data[1];
                $csv[$row]['col3'] = $data[2];
                $csv[$row]['artist'] = $data[3];
                $csv[$row]['title'] = $data[4];

                // inc the row
                $row++;
            }
            fclose($handle);

            echo 'Number of records found: '.$col_count;

            foreach($csv as $row){
                echo $row['id'].'<br>';
                echo $row['artist'].'<br>';
                echo $row['title'].'<br>';
            }
            
        }
    //}
}
}

?>