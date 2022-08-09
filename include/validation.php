<?php
//Email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("XX001");
    //XX001 Invalid email
} else {
   $email = strtolower($email); 
}

//Name
$fullname = htmlspecialchars($fullname, ENT_QUOTES);
$fullname = ucwords(strtolower($fullname));

$names = explode(" ", $fullname);
$fname = $names[0];
$lname = $names[count($names)-1];

if($lname == $fname) {
   $lname = ""; 
}

//Birthdate
$birthdate = explode("/", $birthdate);

if( !checkdate ($birthdate[1], $birthdate[0], $birthdate[2]) ) { //Format is: MM/DD/YYYYY
    exit("XX002");
    //XX002 Invalid date
} else { 
    $birthdate = date("Y-m-d H:i:s", mktime(0, 0, 0, $birthdate[1], $birthdate[0], $birthdate[2]));
    //Klaviyo date format: 1999-12-31 00:00:00
}

//Phone
if(!is_numeric($phone) || strlen($phone) != 9) {
    exit("XX003");
    //XX003 Invalid phone
} else {
    $phone = "+351" . $phone;
}

//JSON encode preferences
$preferences = explode(",", $preferences);
$preferences = json_encode($preferences);
?>