<html>
<head>
<title>View</title>
<body>
<br>

<table border=3 style="margin:auto;">
<!-- <tr>><th>ID</th> -->




<?php
	include '../php/dbconn.php';
	$id=(int)$_GET['id']; //var_dump($id);
	$sql="Select * from users where id=$id";
	try { 
	$conn->query($sql);
	
	} 	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	
	foreach ($conn->query($sql) as $row) {
				echo '<tr><th>Photo			</th>';
				echo '<td> <img src="'.$row['Photo'].'" height=50 width=50></td></tr>';
				echo '<tr><th>First_Name		</th>';
				echo '<td>'. $row['First_Name'].                          '</td></tr>';
				echo '<tr><th>Last_Name		</th>';
				echo '<td> '.$row['Last_Name'].                           '</td></tr>';	
				echo '<tr><th>Full Name			</th>';
				echo '<td>'. $row['First_Name']."  ".$row['Last_Name'] .                              '</td></tr>';
				echo '<tr><th>Username		</th>';
				echo '<td>'. $row['Username'].                            '</td></tr>';
				
				echo '<tr><th>Email			</th>';
				echo '<td>'. $row['Email'].                               '</td></tr>';
									// echo '<td>'.$row['Password'].'</td>';
				echo '<tr><th>Gender			</th>';
				echo '<td>'. $row['Gender'].                              '</td></tr>';
				echo '<tr><th>Company			</th>';
				echo '<td>'.$row['Company'].                              '</td></tr>';
				echo '<tr><th>Address Line 1	</th>';
				echo '<td>'. $row['Address_1'].                           '</td></tr>';
				echo '<tr><th>Address Line 2	</th>';
				echo '<td>'.$row['Address_2'].                            '</td></tr>';
				echo '<tr><th>City			</th>';
				echo '<td>'. $row['City'].                                '</td></tr>';
				echo '<tr><th>Zip_Code		</th>';
				echo '<td>'.$row['Zip_Code'].                             '</td></tr>';
				echo '<tr><th>Mobile_No		</th>';
				echo '<td>'.$row['Mobile_No'].                            '</td></tr>';
				echo '<tr><th>DOB				</th>';
				echo '<td style="padding-right:8px;padding-left:8px;">'. $row['DOB'].'</td></tr>';
				echo '<tr><th>Interest		</th>';
			    echo '<td>'. $row['Interest'].                            '</td></tr>';
				echo '<tr><th>Description		</th>';
				echo '<td>'. $row['Description'].                         '</td></tr>';
				echo '<tr><th>Rating			</th>';
				echo '<td>'. $row['Rating'].                              '</td></tr>';
				
				
	}
	$conn = null;
 	  ?>
 	<table>
 	</body>
 	</head>
 	</html>