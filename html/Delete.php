<?php 
	include '../php/dbconn.php';
	$id=$_GET['id']; 
	$sql="Delete from users where id=$id";
	
	try { 
	$conn->query($sql);
	echo "Deleted Successfully";
	header("Location: http://localhost/form/html/Showing%20Database.php");
	
	} 	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	$conn = null;
	
	

				
  
?>