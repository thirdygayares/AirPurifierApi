<?php

// Getting the User class
require_once __DIR__ . '/user.php';

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

        // The CREATE operation
        // If the API call value is 'createUser'
        // We will create a record in the database
        case 'createUser':
            // First, check the parameters required for this request are available or not
            areParametersAvailable(array('email', 'fullName', 'userName', 'birthday', 'position', 'password'));

                // Creating a new User object
                $userDb = new User();

                // Creating a new record in the database
                $result = $userDb->createUser(
                    $_POST['email'],
                    $_POST['fullName'],
                    $_POST['userName'],
                    $_POST['birthday'],
                    $_POST['position'],
                    $_POST['password']
                );

                // If the record is created, adding success to response
                if ($result) {
                    $response['error'] = false;
                    $response['message'] = 'User created successfully';
                    //$response['users'] = $userDb->getAllUsers();
                } else {
                    // If the record is not added, there is an error
                    $response['error'] = true;
                    $response['message'] = 'Failed to create user. Please try again';
                }
            
            break;


        // The LOGIN operation
        case 'login':
            // First, check the parameters required for this request are available or not
            areParametersAvailable(array('userName', 'password'));

            // Creating a new User object
            $userDb = new User();

            // Attempting to log in
            $result = $userDb->login(
                $_POST['userName'],
                $_POST['password']
            );

            // If login is successful, adding user information to response
            if ($result !== null) {
                $response['error'] = false;
                $response['message'] = 'Login successful';
                $response['user'] = $result;
            } else {
                // If login fails, there is an error
                $response['error'] = true;
                $response['message'] = 'Invalid username or password';
            }

            break;


        // The READ operation
        // If the call is getUsers
        case 'getUsers':
            $userDb = new User();
            $response['error'] = false;
            $response['message'] = 'Request successfully completed';
            $response['users'] = $userDb->getAllUsers();
            break;

      // The READ operation
        // If the call is getUserById
        case 'getUserById':
            // First, check if the 'id' parameter is available
            if (areParametersAvailable(array('id'))) {
                $userDb = new User();
                $userId = $_POST['id'];
                $user = $userDb->getUserById($userId);

                if ($user !== null) {
                    $response['error'] = false;
                    $response['message'] = 'User found successfully';
                    $response['user'] = $user;
                } else {
                    $response['error'] = true;
                    $response['message'] = 'User not found';
                }
            } else {
                // If parameters are missing
                $response['error'] = true;
                $response['message'] = 'Required parameters are missing';
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
