
<html>
<body>


<?php
$firstNameErr ="";
$lastNameErr ="";
$dataValid = true;
// If submit with POST
if ($_POST) { 
        // Test for nothing entered in field
if ($_POST['firstName'] == "") {
$firstNameErr = "Error - you must fill in a first name";
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
<input type="submit" value ="Submit">
</form>

<?php

echo "First Name: "; 
echo $_POST['firstName'];
echo "<br>";

echo "Last Name: ";
echo $_POST['lastName'];
echo "<br>";
?>

   
<?php
// If no submit or data is invalid, print form, repopulating fields and printing err mesgs
} else { 
?>
<form method="post" action="">
First name:<input type="text" name=firstName value="<?php if (isset($_POST['firstName'])) echo $_POST['firstName']; ?>"><?php echo $firstNameErr;?>
<br/>
Last name:<input type="text" name=lastName value="<?php if (isset($_POST['lastName'])) echo $_POST['lastName']; ?>"><?php echo $lastNameErr; ?>
<br />
<input type="submit" value = "Submit">
</form>
<?php
}
?>
</body>
</html>