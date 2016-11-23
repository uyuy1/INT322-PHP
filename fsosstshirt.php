
<html>
<body>


<?php
$servername = "db-mysql.zenit";
$dbusername = "int322_163c24";
$dbpassword = "seneca";
$dbname = "int322_163c24";

$fname = $_POST['firstName'];
$lname = $_POST['lastName'];
$multiple = $_POST['multiple'];
$sex = $_POST['sex'];
$size = $_POST['size'];
$numOrder = $_POST['numOrder'];

$firstNameErr ="";
$lastNameErr ="";
$dataValid = true;

$conn = new mysqli($servername,$dbusername,$dbpassword,$dbname);

if($conn->connect_error){
	die("Connection Failed: " . $conn->connect_error);
}
// If submit with POST

if ($_POST) { 
        // Test for nothing entered in field
if ($_POST['firstName'] == "") {
$firstNameErr = "Error - you must fill in a first name";
$dataValid = false;
}
if ($_POST['multiple'] == "Yes" && $_POST['numOrder'] == "") {
$numOrderErr = "Please Indicate how many orders.";
$dataValid = false;
}
if ($_POST['sex'] == "") {
$sexErr = "No radio buttons were checked";
$dataValid = false;	
}
if ($_POST['multiple'] == "") {
$multipleErr = "No check buttons were checked";
$dataValid = false;	
}
if ($_POST['size'] == "0") {
$sizeErr = "Please select size.";
$dataValid = false;	
}
if ($_POST['lastName'] == "") {
$lastNameErr = "Error - you must fill in a last name";
$dataValid = false; 
}
}
// If the submit button was pressed and something was entered in both fields, process data
// (we just print a mesg)
if ($_POST && $dataValid) {
?>

<!--
<form method="post" action="">
First name:<input type="text" name=firstName value="">
<br/>
Last name:<input type="text" name=lastName value="">
<br />
<input type="submit" value = "Submit">
</form>
-->

<form method="post" action="">
First name:<input type="text" name=firstName value="<?php echo $_POST['firstName']?>">
<br/>
Last name:<input type="text" name=lastName value="<?php echo $_POST['lastName'] ?>">
<br />
<br/>
Male or Female:
<br/>
Male: <input type="radio" name=sex value="M" <?php if ($_POST['sex'] == "M") echo "CHECKED"; ?>>
<br/>
Female: <input type="radio" name=sex value="F" <?php if ($_POST['sex'] == "D") echo "CHECKED"; ?>>
<br/>
<br/>
Multiple shirts:
<br/>
Yes <input type="checkbox" name=multiple value="Yes" <?php if ($_POST['multiple']) echo "CHECKED"; ?>>
<br/>
No <input type="checkbox" name=multiple value="No" <?php if ($_POST['multiple']) echo "CHECKED"; ?>>
</br>
Number of Order:
</br>
<input type="text" name=numOrder value="<?php echo $_POST['numOrder']?>">
<br/>
<br/>
Tshirt Size: 
<select name="size"><br/>
<br/>
<option name="none" value="0">Please Choose</option>
<option name="s" value="Small"<?php if ($_POST['s']) echo "SELECTED"; ?>>Small</option>
<option name="m" value="Medium"<?php if ($_POST['m']) echo "SELECTED"; ?>>Medium</option>
<option name="l" value="Large"<?php if ($_POST['m']) echo "SELECTED"; ?>>Large</option>
<option name="xl" value="Extra Large"<?php if ($_POST['m']) echo "SELECTED"; ?>>XL</option>
<br/>
<br/>
<input type="submit" value ="Submit">
</form>


<?php

$sql = "INSERT INTO fsossregister(firstName, lastName, sex, multiple,size,numOrder1)
Values ('$fname', '$lname', '$sex', '$multiple', '$size', '$numOrder')";



if($conn->query($sql) === TRUE){
	
	$sql_query = "SELECT * from fsossregister";
	
	$result = mysqli_query($conn, $sql_query) or die('query failed'. mysqli_error($conn));
	//iterate through result printing each record
	echo "<br/>";
	echo "Thank you! Your info has been entered into the database, you may close this window!";
} else {
	echo "Error: " . $sql . "<br/>" . $conn->error;
}
$conn-> close();
?>
<html>
<body>
<table border="1">
<tr>
<th>First Name</th><th>Last Name</th><th>Gender</th><th>Multiple Shirts</th><th>Number of Order</th><th>Tshirt Size</th><th>Link</th>
<?php

 		while($row = mysqli_fetch_assoc($result))
 		{
?>
		<tr>
		<td><?php print $row['firstName']; ?></td>
		<td><?php print $row['lastName']; ?></td>
		<td><?php print $row['sex']; ?></td>
		<td><?php print $row['multiple']; ?></td>
		<td><?php print $row['numOrder1']; ?></td>
		<td><?php print $row['size']; ?></td>
		<td><a href="somepage.php?numOrder1=<?php echo $row['multiple'];?>">Cancel</a></td>
		</tr>
<?php
 		}
	
?>
</table>
</body>
</html>
</br>
<a href="http://zenit.senecac.on.ca:16546/cgi-bin/lab4/fsosstshirt.php">Want to order again?</a>



   
<?php
} else { 
?>
<form method="post" action="">
First name:<input type="text" name=firstName value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>"><?php echo $firstNameErr;?>
<br/>
Last name:<input type="text" name=lastName value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>"><?php echo $lastNameErr; ?>
<br />
<br/>
Male or Female:
<br/>
Male<input type="radio" name=sex value="M" <?php if (isset($_POST['sex'])) echo $_POST['sex']; ?>>  <?php echo $sexErr; ?>
<br/>
Female <input type="radio" name=sex value="F" <?php if (isset($_POST['sex'])) echo $_POST['sex']; ?>>  <?php echo $sexErr; ?>
<br/>
<br/>
Multiple shirts:
<br/>
Yes: <input type="checkbox" name=multiple value="Yes" <?php if (isset($_POST['multiple'])) echo $_POST['multiple']; ?>>  <?php echo $multipleErr; ?>
<br/>
No: <input type="checkbox" name=multiple value="No" <?php if (isset($_POST['multiple'])) echo $_POST['multiple']; ?>>  <?php echo $multipleErr; ?>
<br/>
<br/>
Number of Order:
<br/>
<input type="text" name=numOrder value="<?php if (isset($_POST['numOrder'])) echo $_POST['numOrder']; ?>"><?php echo $numOrderErr;?>
<br/>
<br/>
Tshirt Size: 
<select name="size">
<option name="none" value="0" <?php if (isset($_POST['none'])) echo $_POST['none']; ?>> Please Choose </option>
<option name="s" value="Small">Small </option>
<option name="m" value="Medium">Medium</option>
<option name="l" value="Large">Large </option>
<option name="xl" value="Extra Large">XL </option>
</select> <?php echo $sizeErr; ?>
<br/>
<br/>
<input type="submit" value = "Submit">
</form>

<a href="http://zenit.senecac.on.ca:16546/cgi-bin/lab4/fsosstshirt.php">Want to order again?</a>
<?php
}
?>
</body>
</html>