<?php
$hostname = "127.0.0.1";
$username = "root";
$password = "";
$connection = mysql_connect($hostname, $username, $password) or die("Could not open connection to database");
$db = mysql_select_db("calvin_db"); // Selecting Database.


$json1=array();
$results = array();

$type = @$_GET['type'];
//mysql_select_db("calvin_db",$connection) or die("Could not select database");
if($type == "submit"){
	$name = $_POST['user_name'];
	$comments = $_POST['comment_info'];
	$result = mysql_query("INSERT INTO cm (user_name, cm_info) VALUES ('$name','$comments')") or die("Cannot connect the database");
	//echo 'submit';
	$json['result'] = true;
	
	echo json_encode($json);
}else{
	//echo 'read';
	
	$show_result = mysql_query("select * from cm ORDER BY timestamp ASC");//find the comment and order by timestamp
		
		
		
	//$rows = array();
	while($row = mysql_fetch_array($show_result)){


		$tempObj = array();
		$tempObj['name'] = $row['user_name'];
		$tempObj['comments'] = $row['cm_info'];
		$tempObj['time'] = $row['timestamp'];
		
		$json[] = $tempObj;
	}	
	echo json_encode($json);
}

?>