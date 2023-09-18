<?php

include './admin/inc/database.php';
include './admin/inc/validate.php';
include './admin/inc/valid.php';

$date = date('Y-m-d');
$db = new Database();
$rules_array = array(
    'first_name' => array('type' => 'string', 'required' => TRUE, 'min' => 0, 'max' => 255, 'trim' => true),
    'last_name' => array('type' => 'string', 'required' => TRUE, 'min' => 0, 'max' => 255, 'trim' => true),
    'mobile_number' => array('type' => 'string', 'required' => TRUE, 'min' => 0, 'max' => 255, 'trim' => true),
    'email' => array('type' => 'string', 'required' => FALSE, 'min' => 0, 'max' => 255, 'trim' => true),
    'password' => array('type' => 'string', 'required' => FALSE, 'min' => 0, 'max' => 255, 'trim' => true)
);

$val = new validation();
$val->addSource($_REQUEST);
$val->AddRules($rules_array);
$val->run();

if (sizeof($val->errors) > 0) {
    print_r($val->errors);
} else {
    $data = $val->sanitized;
    $isMobileUnique = isMobileUnique($data['mobile_number']);

    if ($isMobileUnique == false) {
        $response = [
            "is_error" => 1,
            "error_code" => 'error',
            "title" => "Mobile No already exist.",
            "msg" => "Mobile No already exist.",
            "url" => "register.php"
        ];
    } else {
        $user = $db->insert("users", [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'mobile_number' => $data['mobile_number'],
            'email' => $data['email'],
            'password' => md5($data['password'])
        ]);

        if ($user >= 1) {
            session_start();
            unset($_SESSION['mobile_number']);
            header("location:login.php");
            // $response = [
            //     "is_error" => 0,
            //     "error_code" => 'success',
            //     "title" => "OK!",
            //     "msg" => "User Added.",
            //     "url" => "register.php"
            // ];
        } else {

            $response = [
                "is_error" => 1,
                'error_code' => 'error',
                "title" => "Opps!!",
                "msg" => "Something went wrong. Please try again."
            ];
        }
    }
}


function isMobileUnique($mobile_number) {
    $db = new Database();
    $isUnique = $db->select("users", "id", ['mobile_number' => $mobile_number]);
    if (sizeof($isUnique) > 0) {
        return false;
    } else {
        return true;
    }
}

// print_r( $response);
// die;

echo json_encode($response);
?>