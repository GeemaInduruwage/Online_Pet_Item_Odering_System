<?php
$con=mysqli_connect("localhost", "root", "", "pet_shop_db");

if(!$con){
	echo "DB not Connected...";
}
else{
	?> <h1>XML of the clients Details </h1><?php
$result=mysqli_query($con, "Select * from clients");
if($result){
$xml = new DOMDocument("1.0");

// It will format the output in xml format otherwise
// the output will be in a single row
$xml->formatOutput=true;
$fitness=$xml->createElement("clients");
$xml->appendChild($fitness);
while($row=mysqli_fetch_array($result)){
	$user=$xml->createElement("clients");
	$fitness->appendChild($user);
	
	$id=$xml->createElement("id", $row['id']);
	$user->appendChild($id);
	
	$fname=$xml->createElement("firstname", $row['firstname']);
	$user->appendChild($fname);

	$lname=$xml->createElement("lastname", $row['lastname']);
	$user->appendChild($lname);

	$contact=$xml->createElement("contact", $row['contact']);
	$user->appendChild($contact);
	
	$email=$xml->createElement("email", $row['email']);
	$user->appendChild($email);
	
	$password=$xml->createElement("password", $row['password']);
	$user->appendChild($password);
	
	$address=$xml->createElement("Address", $row['default_delivery_address']);
	$user->appendChild($address);

	$date=$xml->createElement("date", $row['date_created']);
	$user->appendChild($date);
	

	
}
echo "<xmp>".$xml->saveXML()."</xmp>";
$xml->save("report.xml");
}
else{
	echo "error";
}
}
?>
