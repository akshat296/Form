<html>
<head>
 
  <title>My Page</title>
  <style>
   .error{
    color: red;
    font-size: 18px;


}

</style>
  <meta charset="utf-8">
  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/elegant.css">
	<link rel="stylesheet" href="../css/mystyle.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<br>

<table border=3>
<!-- ><th>ID</th> -->
<tr><th>Photo</th>
<th>First_Name</th>
<th>Last_Name</th>
<th>Username</th>
<th>Email</th>
<!-- <th>Password</th> -->
<th>Gender</th>
<th>Company</th>
<th>Address Line 1</th>
<th>Address Line 2</th>
<th>City</th>
<th>Zip_Code</th>
<th>Mobile_No</th>
<th>DOB</th>
<th>Interest</th>
<th>Description</th>
<th>Rating</th>
<th colspan="3"><center>Actions</center></th>
</tr>

<?php

	include '../php/dbconn.php';
	$sql="Select * from users";
  foreach ($conn->query($sql) as $row) {
		

				//echo htmlspecialchars($row["Photo"]);
				// echo '<td>'. $row['id'].'</td>';
  				 $k=$row['id'];
				echo '<td> <img src="'.$row['Photo'].'" height=50 width=50 </td>';

				echo '<td>'. $row['First_Name'].'</td>';
				echo '<td> '.$row['Last_Name'].'</td>';	
				echo '<td>'. $row['Username'].'</td>';
				echo '<td>'. $row['Email'].'</td>';
				// echo '<td>'.$row['Password'].'</td>';
				echo '<td>'. $row['Gender'].'</td>';
				echo '<td>'.$row['Company'].'</td>';
				echo '<td>'. $row['Address_1'].'</td>';
				echo '<td>'.$row['Address_2'].'</td>';
				echo '<td>'. $row['City'].'</td>';
				echo '<td>'.$row['Zip_Code'].'</td>';
				echo '<td>'.$row['Mobile_No'].'</td>';
				echo '<td style="padding-right:8px;padding-left:8px;">'. $row['DOB'].'</td>';
			    echo '<td>'. $row['Interest'].'</td>';
				echo '<td>'. $row['Description'].'</td>';
				echo '<td>'. $row['Rating'].'</td>';
				echo '<td><a href="../html/Delete.php?id='.$k.'"><div class="btn-danger" style="padding-left:3px;padding-right:3px">Delete</div></td></a><td><a href="../html/Edit.php?id='.$k.'"><div class="btn-primary" style="padding-left:12px;padding-right:12px">Edit</div></a></td><td><a href="../html/View.php?id='.$k.'"><div class="btn-info"style="padding-left:7px;padding-right:7px">View</div></a></td></tr>';
  }
?>
</table>
<a href="http://localhost/form/html/login.php"><div class="btn-primary" style="margin:auto;width:65px;padding:2px">Add User</div></a>
</body>
</html>

