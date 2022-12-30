<?php
include_once 'model/account_model.php';
include_once 'validation.php';
include_once '../components/scripts/links.php';
class Account
{
    private $model;
    private $verify;
    private $links;

    function __construct()
    {
        $this->model = new AccountModel();
        $this->verify = new Validation();
        $this->links = new Links();
    }

    // Create new account
    function create_account($firstname, $lastname, $username, $email, $phone_no, $dob, $password, $confirm_password): int
    {
        // Error codes
        // 0 - No error
        // 1 - Firstname is invalid
        // 2 - Lastname is invalid
        // 3 - Username is invalid
        // 4 - Email is invalid
        // 5 - Phone number is invalid
        // 6 - Date of birth is invalid
        // 7 - User is too young
        // 8 - User is too old
        // 9 - Passwords do not match
        // 10 - Password is empty
        // 11 - Confirm password is empty
        // 12 - Password is invalid
        // 13 - Username already exists
        // 14 - Email already exists
        // 15 - Phone number already exists
        // 16 - Account creation failed
        // Validate all the data
        // Validate names
        $is_valid_fname = $this->verify->validate_name($firstname);
        $is_valid_lname = $this->verify->validate_name($lastname);
        // Validate username
        $is_valid_username = $this->verify->validate_username($username);
        // Validate email
        $is_valid_email = $this->verify->validate_email($email);
        // Validate phone number
        $is_valid_phone = $this->verify->validate_phone($phone_no);
        // Validate date of birth
        $is_valid_dob = $this->verify->validate_dob($dob);
        // Validate password
        $is_valid_pass = $this->verify->validate_password($password, $confirm_password);
        // Check if all the data is valid
        $is_valid_data = $is_valid_fname && $is_valid_lname && $is_valid_username && $is_valid_email && $is_valid_phone && $is_valid_dob===true && $is_valid_pass===true;
        if ($is_valid_data) {
            // Check if username already exists
            $is_username_exists = $this->model->check_username($username);
            if ($is_username_exists) {
                return 13;
            }
            // Check if email already exists
            $is_email_exists = $this->model->check_email($email);
            if ($is_email_exists) {
                return 14;
            }
            // Check if phone number already exists
            $is_phone_exists = $this->model->check_phone($phone_no);
            if ($is_phone_exists) {
                return 15;
            }
            // Create account
            $user_id = $this->model->create_account($firstname, $lastname, $username, $dob, $phone_no, $email); // Fill user details
            if ($user_id !== -1) {
                $password = hash("sha512", $password); // Hash password
                echo $password;
                $result = $this->model->set_password($user_id, $password); // Set password
                if ($result == 0) {
                    return 0;
                } else {
                    return 16;
                }
            } else {
                return 16; // Account creation failed
            }
        } else {
            // Check which data is invalid
            if (!$is_valid_fname) {
                return 1; // Firstname is invalid
            } else if (!$is_valid_lname) {
                return 2; // Lastname is invalid
            } else if (!$is_valid_username) {
                return 3; // Username is invalid
            } else if (!$is_valid_email) {
                return 4; // Email is invalid
            } else if (!$is_valid_phone) {
                return 5; // Phone number is invalid
            } else if (!$is_valid_dob || is_integer($is_valid_dob)) { // Date of birth errors
                if ($is_valid_dob === -1) {
                    return 8; // Too old
                } else if ($is_valid_dob === -2) {
                    return 7; // Too young
                }
                return 6; // Date of birth is invalid
            } else if (!$is_valid_pass || is_int($is_valid_pass)) { // Password errors
                if ($is_valid_pass === -1) {
                    return 9; // Passwords do not match
                } else if ($is_valid_pass === -2) {
                    return 10; // Password is empty
                } else if ($is_valid_pass === -3) {
                    return 11; // Confirm password is empty
                }
                return 12; // Password is invalid
            }
        }
        return 0;
    }
    function get_user_details($user_id)
    {
        // Error codes
        // {User details} - No error
        // 1 - User does not exist
        // 2 - User details could not be retrieved at the moment
        $result_users = $this->model->get_user_details($user_id);
        $result_user_dp = $this->model->get_user_profile_picture($user_id);
        if ($result_users === -1 || $result_user_dp === -1) return 2; // User details could not be retrieved at the moment
        if (!$result_users) return 1; // User does not exist
        $user_details = array(
            'user_id' => $result_users['ID'],
            'firstname' => $result_users['firstname'],
            'lastname' => $result_users['lastname'],
            'username' => $result_users['username'],
            'email' => $result_users['email_address'],
            'phone' => $result_users['phone_no'],
            'dob' => $result_users['dob'],
            'created_at' => $result_users['creation_date'],
            'profile_pic' => (!$result_user_dp ? $result_user_dp:$this->links->path('avatar_img'))
        );
        return $user_details;
    }
    function check_login_session($cookie_string)
    {
        $is_valid = $this->verify->validate_cookie_string($cookie_string) && $this->verify->unicode_verifier($cookie_string);
        if ($is_valid) {
            return $this->model->get_login_session($cookie_string);
        }
        return false;
    }

    function create_login_session($identity, $password): int|string
    {
        // Error codes
        // {Cookie string} - No error
        // 1 - Email/Password is incorrect
        // 2 - Account is banned
        // 3 - Cannot log in to account at this time
        // Validate login credentials
        $is_valid_email = $this->verify->validate_email($identity);
        if(!$is_valid_email){
            $is_valid_username = $this->verify->validate_username($identity);
            if(!$is_valid_username){
                return 1;
            } else{
                $user_id = $this->model->check_username($identity);
            }
        } else {
            $user_id = $this->model->check_email($identity);
        }
        // Check if email/username exists
        if($user_id===false || $user_id===-1){
            return 1;
        }
        // Check if account is banned
        $is_banned = $this->model->check_ban($user_id);
        if($is_banned){
            return 2;
        } elseif ($is_banned===-1) {
            return 3;
        }
        $is_valid_pass = $this->verify->validate_password($password, $password);
        if(!$is_valid_pass) return 1;
        // Check if password is correct
        $account_associated_password = $this->model->get_password($user_id);
        $password = hash('sha512', $password);
        if ($account_associated_password === $password) {
            // Generate random string
            $permitted_cookie_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            $string1 = substr(uniqid(), 0, 8);
            $string2 = substr(str_shuffle($permitted_cookie_chars), 6, 8);
            $string3 = substr(str_shuffle($permitted_cookie_chars), 2, 8);
            $string4 = substr(str_shuffle($permitted_cookie_chars), 15, 8);
            // Setting the cookie and login session
            $cookie_string = substr(sha1($string1 . $string2 . $string3 . $string4), 3, 32);
            $is_session_exists = $this->check_login_session($cookie_string);
            if ($is_session_exists !== -1 && $is_session_exists !== false) {
                $this->create_login_session($identity, $password);
            } elseif ($is_session_exists === false) {
                $result = $this->model->set_login_session($user_id, $cookie_string);
                if ($result !== false && $result !== -1) {
//                            setcookie($cookie_name, $cookie_string, time() + (86400 * 30), "/"); // 86400 = 1 day
                    return $cookie_string;
                } else {
                    return 3;
                }
            }
        } else {
            return 1;
        }
        return 1;
    }
    // Check if the email associated with the account is verified
    function check_email_verification($user_id): bool
    {
        $is_verified = $this->model->get_email_verification_status($user_id);
        if($is_verified===false || $is_verified===-1){
            return false;
        } else {
            return true;
        }
    }
    // Create email verification
    function create_email_verification($user_id): int|string
    {
        // Error codes
        // {OTP code} - No error
        // 1 - Email is already verified
        // 2 = No. of OTP requests for the day exceeded
        // 3 - Cannot create email verification at this time (5 attempts/day)

        // Check whether the email is already verified
        $is_verified = $this->check_email_verification($user_id);
        if($is_verified){
            return 1;
        }
        // Check if the user has exceeded the number of OTP requests for the day
        $request_attempts = $this->model->get_no_of_email_verification_requests($user_id);
        if($request_attempts===-1){
            return 3;
        } elseif($request_attempts>=5){
            return 2;
        }
        // Generate random 6-digit OTP code
        $valid_nums = '0123456789';
        $digit1 = substr(str_shuffle($valid_nums), 0, 1);
        $digit2 = substr(str_shuffle($valid_nums), 1, 1);
        $digit3 = substr(str_shuffle($valid_nums), 2, 1);
        $digit4 = substr(str_shuffle($valid_nums), 3, 1);
        $digit5 = substr(str_shuffle($valid_nums), 4, 1);
        $digit6 = substr(str_shuffle($valid_nums), 5, 1);
        $otp_code = $digit1.$digit2.$digit3.$digit4.$digit5.$digit6;
        // Create email verification
        $result = $this->model->set_email_verification_request($user_id, $otp_code);
        if ($result !== -1) {
            return $otp_code;
        } else {
            return 3;
        }
    }
    // Check if the email verification code is valid
    function verify_otp($user_id, $otp){
        // Error codes
        // 0 - No error
        // 1 - OTP code is incorrect
        // 2 - OTP code has expired
        // 3 - Cannot verify OTP code at this time
        $is_valid_otp = $this->verify->validate_otp($otp);
        if(!$is_valid_otp){
            return 1;
        }
        $available_request = $this->model->get_email_verification_request($user_id);
        if($available_request===false || $available_request===-1){
            return 3;
        }
        if(((strtotime("now")-strtotime($available_request['create_time']))/60)>15){ // Valid for 15 minutes from the time of creation of the OTP code
            return 2;
        }
        if($available_request['otp_code']===$otp){
            $result = $this->model->set_email_is_verified($user_id);
            if($result===-1){
                return 3;
            } else {
                return 0;
            }
        } else {
            return 1;
        }
    }
}