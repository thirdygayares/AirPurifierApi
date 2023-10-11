<?php

// Getting the User class
require_once __DIR__ . '/function.php';

// Function validating all the parameters are available
// We will pass the required parameters to this function
function areParametersAvailable($params){
    //assuming all parameters are available 
    $available = true; 
    $missingparams = ""; 
    
    foreach($params as $param)
        {
        if(!isset($_POST[$param]) || strlen($_POST[$param])<=0){
        $available = false; 
        $missingparams = $missingparams . ", " . $param; 
        }
 }
 
    //if parameters are missing 
    if(!$available)
        {
        $response = array(); 
        $response['error'] = true; 
        $response['message'] = 'Parameters ' . substr($missingparams, 1, strlen($missingparams)) . ' missing';
        
        //displaying error
        echo json_encode($response);
        
        //stopping further execution
        die();
    }
 }

// An array to display response
$response = array();

// If it is an API call
// That means a get parameter named api call is set in the URL
// And with this parameter, we are concluding that it is an API call
if (isset($_GET['apicall'])) {

    switch ($_GET['apicall']) {

        case 'getAirPurifierData':
                $purifyDb = new FunctionAirPurifier();
                $purify = $purifyDb->getAirPurifierData();

                if ($purify !== null) {
                    $response['error'] = false;
                    $response['message'] = 'Purify found successfully';
                    $response['purify'] = $purify;
                } else {
                    $response['error'] = true;
                    $response['message'] = 'purify not found';
                }
            
            break;

case 'updateAirPurifierPower':
            areParametersAvailable(array('power'));

            $purifyDb = new FunctionAirPurifier();
            $power = $_POST['power'];

            if ($purifyDb->updateAirPurifierPower($power)) {
                $response['error'] = false;
                $response['message'] = 'Power updated successfully';
            } else {
                $response['error'] = true;
                $response['message'] = 'Failed to update power';
            }

            break;

        case 'updateAirPurifierLevel':
            areParametersAvailable(array('level'));

            $purifyDb = new FunctionAirPurifier();
            $level = $_POST['level'];

            if ($purifyDb->updateAirPurifierLevel($level)) {
                $response['error'] = false;
                $response['message'] = 'Level updated successfully';
            } else {
                $response['error'] = true;
                $response['message'] = 'Failed to update level';
            }

            break;

        case 'updateAirPurifierHumidity':
            areParametersAvailable(array('humidity'));

            $purifyDb = new FunctionAirPurifier();
            $humidity = $_POST['humidity'];

            if ($purifyDb->updateAirPurifierHumidity($humidity)) {
                $response['error'] = false;
                $response['message'] = 'Humidity updated successfully';
            } else {
                $response['error'] = true;
                $response['message'] = 'Failed to update humidity';
            }

            break;



        default:
            // If it is not a recognized API call
            $response['error'] = true;
            $response['message'] = 'Invalid API Call';
            break;
    }
} else {
    // If it is not an API call
    // Pushing appropriate values to the response array
    $response['error'] = true;
    $response['message'] = 'Invalid API Call';
}

// Displaying the response in JSON structure
echo json_encode($response);
