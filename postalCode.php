<html>
<body>

<?php

$senecaCode = '';
$postalCode = '';
$phoneCode = '';
$validPostCode1 = 'Invalid Input';
$validPostCode2 = 'Invalid Input';
$validPostCode3 = 'Invalid Input';


if(isset($_GET['postalCode'])){
	$postalCode = $_GET['postalCode'];
}

if(isset($_GET['senecaCode'])){
	$senecaCode = $_GET['senecaCode'];
}
if(isset($_GET['phoneCode'])){
	$phoneCode = $_GET['phoneCode'];
}

if(preg_match('/^\s*[A-Z][0-9][A-Z]\s?[0-9][A-Z][0-9]\s*$/i', $postalCode)){

	$validPostCode1 = $postalCode;
}
if(preg_match('/^\s*[A-Z][A-Z][A-Z][0-9][0-9][0-9][A-Z]?[A-Z]?[A-Z]?\s*$/i', $senecaCode)){

	$validPostCode2 = $senecaCode;
}
if(preg_match('/^\s*\(?\d{3}\)?(-|\s)?\d{3}(-|\s)?\d{4}\s*$/i', $phoneCode)){

	$validPostCode3 = $phoneCode;
}
?>	

<form>
Postal Code: <input type="TEXT" name="postalCode"/>
<br/>
Postal Code Entered: <?php echo $validPostCode1; ?>
<br/>
Seneca: <input type="TEXT" name="senecaCode"/>
<br/>
SENECA Code Entered: <?php echo $validPostCode2; ?>
<br/>
Phone Number: <input type="TEXT" name="phoneCode" />
<br/>
Phone Number Entered: <?php echo $validPostCode3; ?>
<br/>
<br/>
<input type="submit" value = "Submit">
</form>
</html>
</body>

