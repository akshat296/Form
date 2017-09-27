
<?php session_start();?><html>
<head>
 
  <title>My Page</title>
  <style>
  
</style>
  <meta charset="utf-8">
  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/elegant.css">
	<link rel="stylesheet" type="text/css" href="../css/mystyle.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php

 	include '../php/dbconn.php';

	$file= $fn = $ln= $usrname = $email = $password =  $confirm_password =  $gender =  $company = $add1 = $add2 =$city =$zip = $mobile =  $dob =  $interest = $description = $rating = $condition= "";
 	
	 //$a=$rand1;$b=$rand2;
 
	$ans=520;
	 $f=0;$errors= array(); $pe=0;
	 $path="";
	 $tbname="login";
	
	if ($_SERVER["REQUEST_METHOD"]=="POST") 
	{
	$file=test_file($_FILES["uploaded_file"]);
	$f=2;
	$path="../img/{$_FILES['uploaded_file']['name']}";
	$f=2;
	$fn=test_name($_POST["first_name"]);
	$ln=test_name($_POST["last_name"]);
    $usrname=test_username($_POST["username"]);
	$email = test_email($_POST["email"]);
	$password = test_pass($_POST["password"],$_POST["confirm_password"]);
	if(isset($_POST["gender"]))
	{
	$gender = test_gender($_POST["gender"]);
	}
	else
	{
	$gender="1";
	}	
	$company = test_name($_POST["company"]);
	$add1=test_name($_POST["address1"]);
	$add2=test_name($_POST["address2"]);
	$city=test_name($_POST["city"]);
	$zip=test_zip($_POST["zip"]);
	$mobile=test_mobile($_POST["mobile_no"]);
	$dob = test_dob($_POST["date_of_birth"]);
	$interest=test_interest($_POST["interest"]);
	$ans=test_capcha($_POST["capcha"]);
	$description=$_POST["interest"];
	if(isset($_POST["rating"]))
	{
	$rating=test_rating($_POST["rating"]);
	}
	else
	{
	$rating="1";
	}	
	if(isset($_POST["condition"]))
	{
	$condition=test_condition($_POST["condition"]);
	}
	else
	{
	$condition="99";
	}
	
	if($email!="1" && $dob!="1" && $pe=="3" && $city!="1"  && $usrname !="1" && $fn!= "1" && $gender!="1" && $mobile!="1" && $city !="1" && $ans!=521)
	{
 /* $sql = "CREATE TABLE $usrname(
	Photo VARCHAR(254) NULL,
    First_Name VARCHAR(254) NOT NULL, 
    Last_Name VARCHAR(254) NULL,
    Username VARCHAR(254) PRIMARY KEY NOT NULL,
    Email VARCHAR(254) NOT NULL,
    Password VARCHAR(254) NOT NULL,
	Gender VARCHAR(254) NOT NULL,
	Company VARCHAR(254) NULL,
	Address_1 VARCHAR(254) NULL,
	Address_2 VARCHAR(254) NULL,
	City VARCHAR(254) NOT NULL,
	Zip_Code VARCHAR(6) NOT NULL,
	Mobile_No VARCHAR(10) NOT NULL,
	DOB VARCHAR(15) NOT NULL,
	Interest VARCHAR(254) NULL,
	Description VARCHAR(254) NULL,
	Rating VARCHAR(254) NULL
    )";
	$conn->exec($sql);*/
	$sql = "INSERT INTO users( Photo,First_Name, 
    Last_Name,
    Username,
    Email,
    Password,
	Gender,
	Company,
	Address_1,
	Address_2,
	City,
	Zip_Code,
	Mobile_No,
	DOB,
	Interest,
	Description,
	Rating)
	VALUES (
	'$path','$fn', '$ln', '$usrname','$email','$password','$gender','$company','$add1','$add2','$city','$zip','$mobile','$dob','$interest','$description','$rating')";

	try { 
	$conn->query($sql);
	echo "New record created successfully";
	header('Location: http://localhost/form/html/Showing%20Database.php');
	} 	
	catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
	$conn = null;
	}
	}
	function test_capcha($ansuser)
	{
		echo $ansuser."\t".$_SESSION['check'];
		if($ansuser==$_SESSION['check'])
		{
		return $ansuser;
		}
		else {
			return 521;
		}
		}
	function test_username($name)
	{ 
		include '../php/dbconn.php';
		
		$sql="Select Username from users where Username = '$name'";

		if(strlen($name)<3){ 
		$name="2";
		return $name;
		}
		
		try { 
		
		 $conn->query($sql); 
		 
		if( $conn->query($sql)->rowCount()>0)
		{
				$name="1";
				return $name; 
		}
		else{
			return $name;
		}
		/*  echo 'end';
		  foreach ($conn->query($sql) as $row) {
			   echo "pika"."\t";
			  if(  $row['Username']!=NULL)
			  { echo "pikaif"."\t";
				$name="1";
				return $name;  
			  }
			  else{ echo "pikaifes"."\t";
				  return $name;
			}
		  
		}
	
	   */
	  
	} catch(PDOException $e)
		{ 
		echo $e->getMessage();
		return $name;
		}
		catch(Exception $e)
		{ 
		return $name;
		}

		$conn = null;
	}	
	function test_gender($name)
	{
		if ($name=="male" || $name=="female")
		{return $name;}
	else{
		return "1";
	}
	}
	function test_mobile($name)
	{
		if (strlen($name)==10)
		{	return $name;	
		}
		else {
			return "1";
		}
	}
	function test_zip($name)
	{
	if (strlen($name)<=6 && strlen($name)>3)
		{	return $name;	
		}
		else {
			return "1";
		}
	}
	function test_rating($name)
	{
		
	return $name;	
	}
	function test_condition($name)
	{
		if(isset($_POST['check']) )
		{
		return $name;	
		}
		else {
			return "1";
		}
	
	}
	function test_interest($name)
	{
		if($name!="Select an Interest ")
		{return $name;}
		else {return "1";}	
	}
	function test_file($name)
	{
	if(isset($_FILES['uploaded_file'])) {
    $errors     = array();
    $maxsize    = (1024*250);
    $acceptable = array(
        
        'image/jpeg',
        'image/jpg',
        'image/gif',
        'image/png'
    );

    if(($_FILES['uploaded_file']['size'] >= $maxsize) || ($_FILES["uploaded_file"]["size"] == 0)) {
        $errors[] = 'Upload a file and It Should be less than 250 kilobytes';
    }

    if((!in_array($_FILES['uploaded_file']['type'], $acceptable)) && (!empty($_FILES["uploaded_file"]["type"]))) {
        $errors[] = 'Invalid file type. Only PDF, JPG, GIF and PNG types are accepted.';
    }

    if(count($errors) === 0) {
        move_uploaded_file($_FILES['uploaded_file']['tmp_name'], "../img/{$_FILES['uploaded_file']['name']}");
		
    }

        //die(); //Ensure no more processing is done
    }

	return $errors;

	}
	function test_email($email)
	{
	  $i;
	  $flag=0;
	  for($i=0;$i<strlen($email);$i++)
	  {
		  if($email[$i]=='@')
		  {
			  $flag=1;
		  }
		  if($flag==1 && $email[$i]=='.')
		  {
			  $flag=2;
			  
		  }
	  }
	  if($flag==2)
	  {
		  return $email;
		 
	  }
	  else 
	  {
		  return "1";
	  }
  }
	function test_dob($dob)
	{
	  $MM=" ";$DD=" ";$YYYY=" ";
	  $i;
	  $flag=0;
	  for($i=0;$i<strlen($dob);$i++)
	  {
		  if($dob[$i]=='-')
		  {
			  $flag++;
			  continue;
		  }
		  if($flag==0)
		  {
			  $YYYY=$YYYY.$dob[$i];
		  }
		  elseif($flag==1)
		  {
			  $MM=$MM.$dob[$i];
		  }
		  else
		  {
			  $DD=$DD.$dob[$i];
		  }
		  
		  
	  }
	  if($YYYY>1800 && ($MM<13 && $MM>0) && ($DD>0 && $DD<32))
	  {
		  return $dob;
	  }		  
	  else 
	  {
		  return "1";
	  }
  }

	function test_pass($pass,$confirm_pass)
	{	
	$containsLetter  = preg_match('/[a-zA-Z]/',    $pass);
	$containsDigit   = preg_match('/\d/',          $pass);
	$containsSpecial = preg_match('/[^a-zA-Z\d]/', $pass);

	//echo $containsLetter;
	if($pass==$confirm_pass && strlen($pass)>7  && $containsLetter!=0 && $containsDigit!=0 && $containsSpecial!=0)
	{
		$pass=md5($pass);
		$GLOBALS['pe']=3;
		return $pass;
	}
	if($pass!=$confirm_pass )
	{
		return 2;
	}
	else 
	{
		return 1;;
	}
} 
	function test_name($name)
	{
	if(strlen($name)>2)
	{
		return $name;
	}
	else{
		return "1";
	}
} 
?>

	<br>
	<p style="text-align: center;font-size:50px;color:#283821;">Sign Up</p><br>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
	
	<table style="margin:0px auto; width:600px; " >
	<tr>
					
					<td><p class="types"> Upload</p></td> 
					<td><input type="file" name="uploaded_file" value="" size="15"></td>
					<td><span class="error"><?php  if(count($file) !== 0 && $f==2){echo implode('',$file);}?></span></td>
	</tr>		
	<tr>
					
					<td><p class="types"> First Name</p></td> 
					<td><input type="text" name="first_name" value="" size="33"></td>
					<td><span class="error"><?php  if($fn=="1"){echo "Invalid First Name";}?></span></td>
	</tr>		
	<tr>
					<td><p class="types"> Last Name</p> </td>
					<td><input type="text" name="last_name" value="" size="33"></td>
					<td><span class="error"><?php  if($ln=="1"){echo "Invalid Last Name";}?></span></td>
	</tr>
	<tr>
					<td><p class="types"> Username </p> </td>
					<td><input type="text" name="username" value="" size="33"><span class="error"></td>
					<td><span class="error"><?php if($usrname=="1"){echo "Username not available";}
					if($usrname=="2"){echo "Username should not be blank and more than 3 characters";
					}?></span></td>
	</tr>
	<tr>	
					<td><p class="types"> E-mail</p> </td>
					<td><input type="text" name="email" value="" size="33"></td>
					<td><span class="error"><?php if($email=="1"){echo "Invalid Email";}?></span></td>
	</tr>	
	<tr>
					<td><p> Password</p> </td>
					<td><input type="password" name="password" value="" size="33"></td>
					<td><span class="error"><?php if($password=="1"){echo "Password Should contain one special character, one numeric and one alphabet and should be same";}
					if($password=="2")
					{
						echo "Password does not match";
					}?></span></td>
	</tr>
	
	<tr>				
					<td><p class="types"> Confirm_Password</p> </td>
					<td><input type="password" name="confirm_password" value="" size="33"></td>
					<td></td>
	</tr>
	<tr>
					<td><p class="types"> Gender</p> </td>
					<td><input type="radio" name="gender" value="male">&nbsp;Male &nbsp;&nbsp;&nbsp;
					<input type="radio" name="gender" value="female">&nbsp;Female &nbsp;</td>
					<td><span class="error"><?php  if($gender=="1"){echo "Please select a value";}?></span></td>
	</tr>
	<tr>			
					<td><p class="types"> Company</p> </td>
					<td><input type="text" name="company" value="" size="33"></td>
					<td><span class="error"><?php if($company=="1"){echo "Invalid Company";}?></span></td>
	</tr>
	<tr>	
					<td ><p class="types"> Address Line 1 </p> </td>
					<td ><input type="textarea" name="address1" value="" size="33"></td>
					<td ><span class="error"><?php if($add1=="1"){echo "Invalid Address";}?></span></td>
	</tr>
	
	<tr>
					<td><p class="types"> Address Line 2</p> </td>
					<td><input type="textarea" name="address2" value="" size="33"></td>
					<td></td>
	</tr>
	<tr>
					<td><p class="types"> City</p> </td>
					<td> <input type="text" name="city" value="" size="33"></td>
					<td><span class="error"><?php if($city=="1"){echo "<br>Enter a valid city";}?></span><br><br></td>
	</tr>
	<tr>
					<td><p class="types"> Zip Code</p></td>
					<td><input type="text" name="zip" value="" size="33"></td>
					<td><span class="error"><?php if($zip=="1"){echo "Invalid Zip Code";}?></span><br><br></td>
	</tr>
	<tr>
					<td><p class="types"> Mobile Number</p></td>
					<td><input type="text" name="mobile_no" value="" size="33"></td>
					<td><span class="error"><?php if($mobile=="1"){echo "Invalid Mobile Number";}?></span><br><br></td>
	</tr>
	<tr>
					<td><p class="types"> Date Of Birth</p> </td>
					<td><input type="date" name="date_of_birth" value="" size="33"></td>
					<td><span class="error"><?php if($dob=="1"){echo "Invalid Date of Birth";}?></span><br><br></td>
	</tr>
	<tr>
					<td><p class="types"> Interest </p> </td>
					<td><select name="interest">
							<option value="Select an Interest ">Select an Interest</option>
							<option value="Puzzles" name="interest">Puzzles</option>
							<option value="Programming" name="interest">Programming</option>
							<option value="Games" name="interest">Games</option>
							<option value="Cars" name="interest">Cars</option>
							</select>&nbsp;</td>
					<td><span class="error"><?php if($interest=="1"){echo "Select an interest ";}?></span><br><br></td>
	</tr>
	<tr>
					<td><p class="types"> Description</p> </td>
					<td><input type="textarea" name="description" value="" size="33"><br><br></td>
	</tr>
	<tr>
					<td><p class="types"> Rating</p> </td>
						<td><fieldset class="rating">
							<input type="radio" id="star5" name="rating" value="5" /><label class = "full" for="star5" title="Awesome - 5 stars"></label>
							<input type="radio" id="star4half" name="rating" value="4 and a half" /><label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
							<input type="radio" id="star4" name="rating" value="4" /><label class = "full" for="star4" title="Pretty good - 4 stars"></label>
							<input type="radio" id="star3half" name="rating" value="3 and a half" /><label class="half" for="star3half" title="Meh - 3.5 stars"></label>
							<input type="radio" id="star3" name="rating" value="3" /><label class = "full" for="star3" title="Meh - 3 stars"></label>
							<input type="radio" id="star2half" name="rating" value="2 and a half" /><label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
							<input type="radio" id="star2" name="rating" value="2" /><label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
							<input type="radio" id="star1half" name="rating" value="1 and a half" /><label class="half" for="star1half" title="Meh - 1.5 stars"></label>
							<input type="radio" id="star1" name="rating" value="1" /><label class = "full" for="star1" title="Sucks big time - 1 star"></label>
							<input type="radio" id="starhalf" name="rating" value="half" /><label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
							</fieldset>
						<br><br></td>
					<td></td>
	</tr>
	<tr>
					<td><p class="types"> Capcha</p><img src="Capcha.php"/>  </td>
					<td><input type="text" name="capcha" value="" size="33"><br><a href="http://localhost/form/html/login.php">Click to reload capcha</a></td>
					<td><span class="error"><?php if($GLOBALS['ans']==521){echo "Enter correct Capcha Answer";}?></span><br><br></td>
	</tr>	
	<tr>
					<td colspan=2><center><input type="checkbox" name="condition" value="" style="float:center;">&nbsp;I accept the terms and conditions</center></td>
					<td><span class="error"><?php if($condition=="99"){echo "Accept terms & Conditions";}?></span><br><br></td>
	</tr>
	<tr>
	<td></td>
	<td  ><input type="submit" name="submit" value="Submit" style="float:center;"></td></tr></table>
</form>
</body>
</html>				
		

  
  
 
 
 
 
 
 
 
 
 
 

 

 
 
 
 
   

 

	