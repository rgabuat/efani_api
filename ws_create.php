<?php 
require('./functions.php');
require('./config.php');

$WS_Curl = new WS_Curl(CONFIG_URL . "/webservice.php", CONFIG_NAME, CONFIG_KEY);
$WS_Curl->login();

$redirect_url = "https://www.efani.com/cartflows_step/direct-checkout-page/?fctag=a-28694b-25499c-";
$afid = '000-000-000-000';

// if(isset($POST['submit']))
// {

    $affid = validate($_POST['affiliateid']);
    $firstname = validate($_POST['billing_first_name']);
    $lastname = validate($_POST['billing_last_name']);
    $company = validate($_POST['billing_company']);
    $country = validate($_POST['billing_country']);
    $lane = validate($_POST['billing_address_1']);
    $address2 = validate($_POST['billing_address_2']);
    $city = validate($_POST['billing_city']);
    $state = validate($_POST['billing_state']);
    $code = validate($_POST['billing_postcode']);
    $phone = validate($_POST['billing_phone']);
    $email = validate($_POST['billing_email']);
    $leadsource = validate($_POST['leadsource']);

    $type = 'Leads'; 
    $element = array(
        'cf_855' => $affid, //affiliate ID
        'firstname' => $firstname ,
        'lastname' => $lastname,
        'company' => $company,
        'country' => $country,
        'lane' => $lane,
        'cf_853' => $address2, //address_2
        'city' => $city,
        'state' => $state,
        'code' => $code,
        'phone' => $phone,
        'email' => $email,
        'leadsource' => $leadsource,
        'assigned_user_id'=> '19x5',
    );

    $result = $WS_Curl->create($type, $element);
    $link = $redirect_url.$affid.'&billing_first_name='.$firstname.'&billing_last_name='.$lastname.'&billing_company='.$company.'&billing_country='.$country.'&billing_address_1='.$lane.'&billing_address_2='.$address2.'&billing_city='.$city.'&billing_state='.$state.'&billing_postcode='.$code.'&billing_phone='.$phone.'&billing_email='.$email;

    header("location:".$link);
// }


?>