<?php session_start();
include("includes/config.php");
include("includes/database.php");

if(isset($_POST['mode']) && !empty($_POST['mode'])){
	$mode=$_POST['mode'];
	switch ($mode) {
		
		case 'check':

			$fbid = $database->escape_value($_POST['fbid']);
			$SQL_check = "SELECT fbid FROM tbl_usermaster WHERE fbid='{$fbid}';";
			$result_set_check = $database->query($SQL_check);
			$row_count = $database->affected_rows();
			if($row_count > 0)
			{
				$row=$database->fetch_array_assoc($result_set_check);
				$fbid=$row['fbid'];
				$_SESSION['fbid']=$fbid;				
			   	echo 'success';exit;
			}else{
				echo 'failure';exit;
			}

		break;
		
		case 'user_update':

			$fbid = $database->escape_value($_POST['fbid']);
			$name = $database->escape_value($_POST['name']);
			$location = $database->escape_value($_POST['location']);
			$email = $database->escape_value($_POST['email']);
			$contact_number = $database->escape_value($_POST['contact_number']);

			$SQL_check = "SELECT fbid FROM tbl_usermaster WHERE fbid='{$fbid}';";
			$result_set_check = $database->query($SQL_check);
			$row_count = $database->affected_rows();

			if($row_count == 0)
			{
			    $SQL = "INSERT INTO tbl_usermaster SET fbid='{$fbid}',name='{$name}',email='{$email}',contact_number='{$contact_number}',location='{$location}';";
			    $result_set = $database->query($SQL);
			    $user_id = $database->insert_id();
			    $_SESSION['fbid']=$fbid;

			    echo 'success';
			}else{
				$row=$database->fetch_array_assoc($result_set_check);
				$fbid=$row['fbid'];
				$_SESSION['fbid']=$fbid;				
			    echo 'updated';
			}
			exit;		

		break;
		
		case 'answers_update':

			$fbid = $_SESSION['fbid'];
			$complete = $database->escape_value($_POST['complete']);
			$presence = $database->escape_value($_POST['presence']);
			$channels = $database->escape_value($_POST['channels']);
		
		    $SQL = "INSERT INTO tbl_answermaster SET fbid='{$fbid}',complete='{$complete}',presence='{$presence}',channels='{$channels}';";
		    $result_set = $database->query($SQL);
		    $user_id = $database->insert_id();
		    echo 'success';	
			exit;

		break;
		
		default:
			echo 'failure';
			exit;
		break;
	}
}else{
	echo 'failure';
	exit;
}
?>