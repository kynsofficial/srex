<?php

var_dump($_POST);

$fullname = $_POST['fullname'];
$fullnameP = explode(" ", $fullname);
$firstname = $fullnameP[0];
$lastname = $fullnameP[1];

echo $firstname;
echo $lastname;
?>