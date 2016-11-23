
<html>
<body>

<?php
$min = $_POST['min'];
$max = $_POST['max'];
$product = $_POST['product'];

$student = "Student Declaration";
$student2 = "I/we declare that the attached assignment is my/our own work in accordance with Seneca Academic Policy. No part of this assignment has";
$student3 = "been copied manually or electronically from any other source (including web sites) or distributed to other students.";
$student4 = "Name Riko Angeles";
$student5 = "Student ID 027 123 157";


$price = fopen("price1.txt","r+");
$OS=	fopen("OS1.txt","r+");
$model=	fopen("cellphone1.txt","r+");
$version=fopen("version1.txt","r+");

$model1= explode(",",fgets($model));
$price1= explode(",",fgets($price));
$OS1= 	 explode(",",fgets($OS));
$version1 = explode(",", fgets($version));

$prodErr = "";
$minErr ="";
$maxErr ="";
$dataValid = true;

//If submit with POST

$lines = file('/home/int322_163c24/secret/topsecret.txt');
	$dbserver = trim($lines[0]);
	$username = trim($lines[1]);
	$password = trim($lines[2]);
	$database = trim($lines[3]);
	$conn = mysqli_connect($dbserver,$username,$password,$database)or die ('Database server cnnot conenct:'.$mysqli_error($conn));//connecting to the server.
	if($conn->connect_error){
die("Connection Failed: " . $conn->connect_error);
}
$check = "Select * from product1";

$val = mysqli_query($conn,$check) or die('query failed'. mysqli_error($conn));


if($val->num_rows == 0)//check if the table exist so you wont have a duplicate value.
{
	for($i = 0; $i < 12; $i++){
	
		$getVal = "INSERT INTO product1(itemName, model, os, price)
		Values ('$model1[$i]','$version1[$i]','$OS1[$i]','$price1[$i]')";
		mysqli_query($conn, $getVal) or die('query failed'. mysqli_error($conn));
	}

}
$conn->close();

echo $student;
echo "<br/>";
echo $student2;
echo "<br/>";
echo $student3;
echo "<br/>";
echo $student4;
echo "<br/>";
echo $student5;
echo "<br/>";
echo "<br/>";

if ($_POST) { 
        // Test for nothing entered in field
if ($_POST['min'] == "" || $min > $max) {
$minErr = "Error! please try again.";
$dataValid = false; 
}
if ($_POST['product'] == "") {
$prodErr = "Please select product.";
$dataValid = false;	
}
if ($_POST['max'] == "" || $max < $min) {
$maxErr = "Error! please try again.";
$dataValid = false; 
}
}
if ($_POST && $dataValid) {
	
?>


<br/>
<br/>
<form method="post" action="">
Minimum Price: <input type="text" name="min" value="<?php if (isset($_POST['min'])) echo $_POST['min']; ?>">
<br/>
Maximum Price: <input type="text" name="max" value="<?php if (isset($_POST['max'])) echo $_POST['max']; ?>">  
<br />
Product 
<select name="product">
<option name="none" value="none"> Choose a Product </option>
<option name="none" value="Apple" <?php if($product == "Apple") echo SELECTED; ?>> Apple </option>
<option name="none" value="Samsung" <?php if($product == "Samsung") echo SELECTED; ?>> Samsung </option>
<option name="none" value="Sony" <?php if($product == "Sony") echo SELECTED; ?>> Sony </option>
<option name="none" value="LG" <?php if($product == "LG") echo SELECTED; ?>> LG </option>
<option name="none" value="HTC" <?php if($product == "HTC") echo SELECTED; ?>> HTC </option>
<option name="none" value="Nokia" <?php if($product == "Nokia") echo SELECTED; ?>> Nokia </option>

</select>
<br/>
<br/>
<input type="submit" value ="Submit">
</form>

<table border="1">
<tr>
<th>id</th><th>itemName</th><th>model</th><th>os</th><th>price</th>
<?php		
		
	$lines = file('/home/int322_163c24/secret/topsecret.txt');
	$dbserver = trim($lines[0]);
	$username = trim($lines[1]);
	$password = trim($lines[2]);
	$database = trim($lines[3]);
	$conn = mysqli_connect($dbserver,$username,$password,$database)or die ('Database server cnnot conenct:'.$mysqli_error($conn));
	
if($conn->connect_error){
die("Connection Failed: " . $conn->connect_error);
}
	$sql_query = "SELECT * from product1 WHERE itemName = '$product' AND price BETWEEN '$min' AND '$max' ORDER BY price";// selecting the price between the max and min
	
	$result = mysqli_query($conn, $sql_query) or die('query failed'. mysqli_error($conn));

	$conn->close();

 		while($row = mysqli_fetch_assoc($result))//Display the table
 		{
?>
		<tr>
		<td><?php print $row['id']; ?></td>
		<td><?php print $row['itemName']; ?></td>
		<td><?php print $row['model']; ?></td>
		<td><?php print $row['os']; ?></td>
		<td><?php print $row['price']; ?></td>
		</tr>
<?php

	}		
?>
</table>
<?php
} else { 
?>
<form method="post" action="">
Minimum Price: <input type="text" name="min" value="<?php if(isset($_POST['min'])) echo $_POST['min']; ?>"><?php echo $maxErr; ?>
<br/>
Maximum Price: <input type="text" name="max" value="<?php if(isset($_POST['max'])) echo $_POST['max']; ?>"><?php echo $maxErr; ?>
<br />
Product:
<select name="product">
<option name="none" value="0"> Choose a Product </option>
<option name="a" value="a">Apple </option>
<option name="b" value="b">Samsung</option>
<option name="c" value="c">Sony</option>
<option name="d" value="d">LG </option>
<option name="d" value="d">HTC</option>
<option name="d" value="d">Nokia </option>
</select> <?php echo $prodErr; ?>
<br/>
<br/>
<input type="submit" value = "Submit">
</form>
<?php
}
?>
</body>
</html>

