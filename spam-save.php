<?php

include './admin/inc/database.php';
include './admin/inc/validate.php';
include './admin/inc/valid.php';

$date = date('Y-m-d');
$db = new Database();
$rules_array = array(
    'url' => array('type' => 'string', 'required' => TRUE, 'min' => 0, 'max' => 255, 'trim' => true),
    'description' => array('type' => 'string', 'required' => TRUE, 'min' => 0, 'max' => 255, 'trim' => true)
);

$val = new validation();
$val->addSource($_REQUEST);
$val->AddRules($rules_array);
$val->run();

if (sizeof($val->errors) > 0) {
    print_r($val->errors);
} else {
    $data = $val->sanitized;

    
        $user = $db->insert("spam_links", [
            'url' => $data['url'],
            'description' => $data['description']
        ]);

        if ($user >= 1) {
            // session_start();
            // unset($_SESSION['mobile_number']);
            // header("location:login.php");
            $response = [
                "is_error" => 0,
                "error_code" => 'success',
                "title" => "OK!",
                "msg" => "User Added.",
                "url" => "report-spam.php"
            ];
        } else {

            $response = [
                "is_error" => 1,
                'error_code' => 'error',
                "title" => "Opps!!",
                "msg" => "Something went wrong. Please try again."
            ];
        }
    }



// print_r( $response);
// die;

echo json_encode($response);
?>