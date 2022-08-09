<?php
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Origin: https://www.domain.com');

/*
***************
** POST DATA **
***************
*/

//Using dummy data for documentation purposes, otherwise would use file_get_contents() to get POST data

$email = "test.".rand(1000,9999)."@domain.com";
$fullname = "artur filipe bulhosa dos santos";
$birthdate = "31/12/1999";
$phone = "910000000";
$region = "Porto";
$country = "Portugal";
$preferences = "woman,men,girl,boy";

//Klaviyo
$list = "000000"; //Klaviyo List (string)
$apiKey = "000000"; //Klaviyo API key (string)

/*
***************************
** VALIDATION / ENCODING **
***************************
*/

include 'include/validation.php';

/*
********************
** SUBSCRIBE USER **
********************
*/

//Make cURL request
$apiURL = "https://a.klaviyo.com/api/v2/list/".$list."/subscribe?api_key=".$apiKey;
$apiQuery = "{\"profiles\":[{\"email\":\"".$email."\",\"phone_number\":\"".$phone."\",\"\$consent\":[\"email\",\"sms\",\"web\",\"directmail\",\"mobile\"],\"sms_consent\":\"True\",\"first_name\":\"".$fname."\",\"last_name\":\"".$lname."\",\"\$region\":\"".$region."\",\"\$country\":\"".$country."\",\"Preferences\":".$preferences.",\"Birthdate\":\"".$birthdate."\"}]}";
$apiMethod = "POST";
$requestID = 1;
include 'include/cURL.php';

$output = json_decode($output, true);

print_r($output);

if(isset($output[0]['id'])) {
    exit("XX009");
    //XX009 Success
} else {
	exit("XX004");
    //XX004 E-mail exists
}

exit("XX000");

//XX000 Error
//XX001 Invalid email
//XX002 Invalid date
//XX003 Invalid phone
//XX004 E-mail exists
//XX008 (N) cURL error
//XX009 Success
?>