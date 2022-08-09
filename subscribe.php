<?php
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Origin: https://www.domain.com');

/*
***************
** POST DATA **
***************
*/

//Using dummy data for documentation purposes, otherwise would use file_get_contents() to get POST data

$email = "test".rand(1000,9999)."@domain.com";
$fullname = "artur filipe bulhosa dos santos";
$birthdate = "31/12/1999";
$phone = "910000000";
$region = "Porto";
$country = "Portugal";
$preferences = "woman,men,girl,boy";

//Klaviyo
$list = "000000"; //Klaviyo List
$apiKey = "000000"; //Klaviyo API key

/*
***************************
** VALIDATION / ENCODING **
***************************
*/

include 'include/validation.php';

/*
***************************
** CHECK IF EMAIL EXISTS **
***************************
*/

//Make cURL request
$apiURL = "https://a.klaviyo.com/api/v2/list/".$list."/get-members?api_key=".$apiKey;
$apiQuery = "{\"emails\":[\"".$email."\"]}";
$apiMethod = "POST";
$requestID = 1;
include 'include/cURL.php';

$output = json_decode($output, true);

if( isset($output[0]['id']) ) {
    exit("XX004");
    //XX004 E-mail exists
}

/*
*****************************
** SUBSCRIBE / UPDATE USER **
*****************************
*/

//Make cURL request
$apiURL = "https://a.klaviyo.com/api/v2/list/".$list."/subscribe?api_key=".$apiKey;
$apiQuery = "{\"profiles\":[{\"email\":\"".$email."\",\"phone_number\":\"".$phone."\",\"\$consent\":[\"email\",\"sms\",\"web\",\"directmail\",\"mobile\"],\"sms_consent\":\"True\",\"first_name\":\"".$fname."\",\"last_name\":\"".$lname."\",\"\$region\":\"".$region."\",\"\$country\":\"".$country."\",\"Preferences\":".$preferences.",\"Birthdate\":\"".$birthdate."\"}]}";
$apiMethod = "POST";
$requestID = 2;
include 'include/cURL.php';

$output = json_decode($output, true);

if( isset($output[0]['id']) ) {
    exit("XX009");
    //XX009 Success
}

exit("XX000");
//XX000 Unknown error

//Response codes
//XX000 Unknown error
//XX001 Invalid email
//XX002 Invalid date
//XX003 Invalid phone
//XX004 E-mail exists
//XX008 (N) cURL error

//XX009 Success
?>