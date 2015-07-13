<?php session_start();
if(isset($_POST) && !empty($_POST)){
	$_SESSION['fbid']=$_POST['fbid'];
	$_SESSION['full_name']=$_POST['full_name'];
	$_SESSION['email']=$_POST['email'];
	$_SESSION['location']=$_POST['location'];
	echo 'success';
	exit;
}else{
	echo 'failure';
	exit;
}
?>