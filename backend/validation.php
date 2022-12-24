<?php

class Validation{
    // Validate names
    function validate_name($name){
        /*
         * Notes:                                                                       Implemented | Tested
         *     1. Names can only contain letters                                           ✓            -
         *     2. Names must be between 2 and 40 characters                                -            -
         *     3. Names cannot start or end with a space                                   -            -
         */
        $is_pass = false;
        if(!empty($name)){
            if(preg_match("/^[a-zA-Z]*$/", $name)){
                $is_pass = true;
            }
        }
        return $is_pass;
    }
    // Validate username
    function validate_username($username){
        /*
         * Notes:                                                                           Implemented | Tested
         *     1. Usernames can only contain letters, numbers, underscores and dashes           ✓           -
         *     2. Usernames must be between 5 and 20 characters                                 -           -
         *     3. Usernames cannot start or end with a space                                    ✓           -
         */
        $is_pass = false;
        if(!empty($username)){
            if(preg_match("/^[a-zA-Z0-9_-]*$/", $username)){
                $is_pass = true;
            }
        }
        return $is_pass;
    }
    // Validate email
    function validate_email($email){
        /*
         * Notes:                                                                           Implemented | Tested
         *     1. Email must be a valid email address                                           ✓           -
         *     2. Email must be between 5 and 50 characters                                     -           -
         *     3. Email cannot start or end with a space                                        ✓           -
         */
        $is_pass = false;
        if(!empty($email)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $is_pass = true;
            }
        }
        return $is_pass;
    }
    // Validate phone number
    function validate_phone($phone){
        /*
         * Notes:                                                                           Implemented | Tested
         *     1. Phone number can only contain numbers and +                                   ✓           -
         *     2. Phone number must be between 10 and 13 characters                             -           -
         *     3. Phone number should start with +                                              ✓           -
         */
        $is_pass = false;
        if(!empty($phone)){
            if(preg_match("/^[+][0-9]*$/", $phone)){
                $is_pass = true;
            }
        }
        return $is_pass;
    }
    // Validate date of birth
    function validate_dob($dob){
        /*
         * Notes:                                                                        Implemented | Tested
         *     1. Date of birth must be in the past                                         -           -
         *     2. Date of birth must be in the format of YYYY-MM-DD                         ✓           -
         *     3. Date of birth must be at least 18 years ago                               -           -
         *     4. Date of birth must be at most 100 years ago                               -           -
         */
        $is_pass = false;
        if(!empty($dob)){
            if(preg_match("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", $dob)){
                $is_pass = true;
            }
        }
        return $is_pass;
    }
}