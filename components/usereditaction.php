<?php
include_once("../database/connection.php");
if ($_POST['action'] == 'edit' && $_POST['id']) {	
	$updateField='';
	if(isset($_POST['name'])) {
		$updateField.= "usrName='".$_POST['name']."'";
	}
    if(isset($_POST['email'])) {
		$updateField.= ", usrEmail='".$_POST['email']."'";
	}
    if(isset($_POST['phone'])) {
		$updateField.= ", usrPhone='".$_POST['phone']."'";
	}
     if(isset($_POST['cart'])) {
		$updateField.= ", usrCart='".$_POST['cart']."'";
	}
     if(isset($_POST['itemqty'])) {
		$updateField.= ", usrItemQty='".$_POST['itemqty']."'";
	} 
    if(isset($_POST['username'])) {
		$updateField.= ", usrUname='".$_POST['username']."'";
	} 
    if(isset($_POST['password'])) {
		$updateField.= ", usrPassword='".$_POST['password']."'";
	} 
    if(isset($_POST['level'])) {
        $updateField.= ", usrLevel='".$_POST['level']."'";
        // if ($_POST['level'] == "admin")
        // {
        //     $updateField.= ", usrLevel=0";
        // }
        // else
        // {
        //     $updateField.= ", usrLevel=1";
        // }
		
	} 
	if($updateField && $_POST['id']) {
        $conn = OpenCon();
		$sqlQuery = "UPDATE accounts SET $updateField WHERE usrId='" . $_POST['id'] . "'";	
		mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));	
		$data = array(
			"message"	=> "Record Updated " . $sqlQuery,	
			"status" => 1
		);
		echo json_encode($data);		
	}
}
if ($_POST['action'] == 'delete' && $_POST['id']) {
	$sqlQuery = "DELETE FROM accounts WHERE usrId='" . $_POST['id'] . "'";	
	mysqli_query($conn, $sqlQuery) or die("database error:". mysqli_error($conn));	
	$data = array(
		"message"	=> "Record Deleted",	
		"status" => 1
	);
	echo json_encode($data);	
}
?>