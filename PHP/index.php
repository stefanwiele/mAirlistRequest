<?php
if (isset($_POST['order_id']) && $_POST['order_id']!="") {
 $order_id = $_POST['order_id'];
 $url = "http://localhost:9300/searchdatabase";
 
 $client = curl_init($url);
 $username = 'test';
 $password = 'secret';

 $data = array("search" => $order_id); 
 $dataCore = array("song" => $data);                                                                   
 $data_string = json_encode($dataCore);       

 curl_setopt($client,CURLOPT_USERPWD, $username . ":" . $password);
 curl_setopt($client,CURLOPT_CUSTOMREQUEST, "POST");
 curl_setopt($client, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
 curl_setopt($client, CURLOPT_POSTFIELDS, $data_string);
 curl_setopt($client,CURLOPT_RETURNTRANSFER, true);

 $response = curl_exec($client);

 $result = json_decode($response);

 echo '<table>';
 foreach ($result as $song) {
	echo '<tr><td>';
	echo $song->Artist.'</td><td>';
	echo $song->Title.'</td><td>';
	echo '<a href="request.php?id='.$song->DatabaseID.'">Request Song</a></td></tr>';
}
 echo '</table>';


}

?>
<form action="" method="POST">
<label>Search mAirlist Database:</label><br />
<input type="text" name="order_id" placeholder="Search" required/>
<br /><br />
<button type="submit" name="submit">Submit</button>
</form>