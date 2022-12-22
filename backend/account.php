<?php
include_once 'model/account_model.php';
class Account{
    private $model;
    function __construct(){
        $this->model = new Account_Model();
    }
    // Create new account
    function create_account($firstname, $lastname, $username, $email, $phone_no, $dob, $password, $confirm_password){
    // Validate all the data
        // Validate names

        // Create account
    }
}

?>