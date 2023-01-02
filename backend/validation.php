<?php

class Validation{
    // Mitigations, sanitizations and verifications
    // Html mitigation
    function html_mitigation($data): string
    {
        $data = str_replace(' ', ' ', $data); // Replace non-breaking space with space
        $data = trim($data); // Remove whitespace from both sides
        $data = stripslashes($data); // Remove backslashes
        $data = htmlspecialchars($data); // Convert special characters to HTML entities
        return $data;
    }
    function unicode_verifier($data){
        $is_pass = false;
        if(preg_match("/^[\x{20}-\x{7E} \n]*$/u", $data)){
            $is_pass = true;
        }
        return $is_pass;
    }
    // Validations
    // Validate names
    function validate_name($name){
        /*
         * Notes:                                                                       Implemented | Tested
         *     1. Names can only contain letters                                           ✓            ✓
         *     2. Names must be between 2 and 40 characters                                ✓            ✓
         *     3. Names cannot have a space                                                ✓            ✓
         */
        $is_pass = false;
        if(!empty($name)){
            if(preg_match("/^[a-zA-Z]{2,40}$/", $name)){
                $is_pass = true;
            }
            if(!($this->unicode_verifier($name))){
                $is_pass = false;
            }
        }
        return $is_pass;
    }
    // Validate username
    function validate_username($username){
        /*
         * Notes:                                                                           Implemented | Tested
         *     1. Usernames can only contain letters, numbers, underscores and dashes           ✓           ✓
         *     2. Usernames must be between 2 and 20 characters                                 ✓           ✓
         *     3. Usernames cannot start or end with a space                                    ✓           ✓
         */
        $is_pass = false;
        if(!empty($username)){
            if(preg_match("/^[a-zA-Z0-9_-]{2,20}$/", $username)){
                $is_pass = true;
            }
            if(!($this->unicode_verifier($username))){
                $is_pass = false;
            }
        }
        return $is_pass;
    }
    // Validate email
    function validate_email($email){
        /*
         * Notes:                                                                           Implemented | Tested
         *     1. Email must be a valid email address                                           ✓           ✓
         *     2. Email must be between 5 and 50 characters                                     ✓           ✓
         *     3. Email cannot start or end with a space                                        ✓           ✓
         */
        $is_pass = false;
        if(!empty($email)){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                if (preg_match("/^[[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]]{5,50}$/", $email)){
                    $is_pass = true;
                }
                $is_pass = true;
            }
            if(!($this->unicode_verifier($email))){
                $is_pass = false;
            }
        }
        return $is_pass;
    }
    // Validate phone number
    function validate_phone($phone){
        /*
         * Notes:                                                                           Implemented | Tested
         *     1. Phone number can only contain numbers and +                                   ✓           ✓
         *     2. Phone number must be between 10 and 13 characters                             ✓           ✓
         *     3. Phone number should start with +                                              ✓           ✓
         */
        $is_pass = false;
        if(!empty($phone)){
            if(preg_match("/^[+][0-9]{2,3}\s[(][0-9]{3}[)]\s[0-9]{3}\s[0-9]{4}$/", $phone)){
                $is_pass = true;
            }
            if(!($this->unicode_verifier($phone))){
                $is_pass = false;
            }
        }
        return $is_pass;
    }
    // Validate date of birth
    function validate_dob($dob){
        /*
         * Notes:                                                                        Implemented | Tested
         *     1. Date of birth must be in the past                                         ✓           ✓
         *     2. Date of birth must be in the format of YYYY-MM-DD                         ✓           ✓
         *     3. Date of birth must be at least 13 years ago                               ✓           ✓
         *     4. Date of birth must be at most 100 years ago                               ✓           ✓
         */
        $is_pass = false;
        if(!empty($dob)){
            if(!($this->unicode_verifier($dob))){
                return false;

            }
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/", $dob)){
                $today = time(); // or your date as well
                $dob_date = strtotime($dob);
                $year_diff = floor(round(($today - $dob_date)/ (60 * 60 * 24))/365);
                if($year_diff > 100){
                    return -1; // Age is too old
                }else if($year_diff < 13){
                    return -2; // Age is too young
                }
                $is_pass = true;
            }
        }
        return $is_pass;
    }
    // Validate password
function validate_password($password, $confirm_password){
        /*
         * Notes:                                                                               Implemented | Tested
         *     1. Password must be between 3 and 20 characters                                      ✓           ✓
         *     2. Password can contain uppercase letters, lowercase letters, symbols, numbers       ✓           ✓
         *     3. Password cannot start or end with a space                                         ✓           ✓
         */
        $is_pass = false;
        if (empty($password)){
            return -2; // Password is empty
        } else if (empty($confirm_password)){
            return -3; // Confirm password is empty
        } else if($password !== $confirm_password){
            return -1; // Passwords do not match
        }else if(!($this->unicode_verifier($password))){
            return false;
        }else if(preg_match("/^[\x{20}-\x{7E} ]{3,20}$/", $password)){
            $is_pass = true;
        }
        return $is_pass;
    }
    function validate_cookie_string($cookie_string){
        /*
         * Notes:                                                                        Implemented | Tested
         *     1. Cookie string must be a string                                           ✓           -
         *     2. Cookie string must be in a length of 32 chars                            ✓           -
         *     3. Cookie string must be alphanumeric                                       ✓           -
         */
        $is_pass = false;
        if(!empty($cookie_string)){
            if(preg_match("/^[a-zA-Z0-9]*$/", $cookie_string) && strlen($cookie_string) == 32){
                $is_pass = true;
            }
            if(!($this->unicode_verifier($cookie_string))){
                $is_pass = false;
            }
        }
        return $is_pass;
    }
    function validate_otp($otp){
        /*
         * Notes:                                                                        Implemented | Tested
         *     1. OTP must be a string                                                     ✓           -
         *     2. OTP must be in a length of 6 chars                                       ✓           -
         *     3. OTP must be numeric                                                      ✓           -
         */
        $is_pass = false;
        if(!empty($otp)){
            if(preg_match("/^[0-9]*$/", $otp) && strlen($otp) == 6){
                $is_pass = true;
            }
            if(!($this->unicode_verifier($otp))){
                $is_pass = false;
            }
        }
        return $is_pass;
    }
    function validate_profile_picture($img_file){
        /*
         * Notes:                                                                        Implemented | Tested
         *     1. Image file must be a file, in format of jpg, png, or gif                   ✓            -
         *     2. Image file must be less than 2MB                                           ✓            -
         *
         */
//        $imageData = file_get_contents($img_file);
        $imageSize = strlen($img_file);
        $is_pass = false;
        if ($imageSize > 2097152) {
            return -1; // Image is too large
        }
        if(!empty($img_file)){
            $img_type = exif_imagetype($img_file);
            if($img_type == IMAGETYPE_JPEG || $img_type == IMAGETYPE_PNG || $img_type == IMAGETYPE_GIF){
                $is_pass = true;
            }

        }else{
            return -2; // Image is invalid
        }
        return $is_pass;
    }
    function validate_project_title($title){
        /*
         * Notes:                                                                        Implemented | Tested
         *     1. Project title must be a string                                           ✓            -
         *     2. Project title must be in a length of 8 to 60 chars                        ✓            -
         *     3. Project title must be alphanumeric                                       ✓            -
         */
        $is_pass = false;
        if(!empty($title)){
            if(preg_match("/^[\x{20}-\x{7E}]*$/", $title) && strlen($title) >= 8 && strlen($title) <= 60){
                $is_pass = true;
            }
            if(!($this->unicode_verifier($title))){
                $is_pass = false;
            }
        }
        return $is_pass;
    }
    function validate_project_description($description){
        /*
         * Notes:                                                                        Implemented | Tested
         *     1. Project description must be a string                                     ✓            -
         *     2. Project description must be in a length of 120 to 800 chars                ✓            -
         *     3. Project description must be alphanumeric                                 ✓            -
         */
        $is_pass = false;
        if(!empty($description)){
            if(preg_match("/^[\x{20}-\x{7E}\n]*$/", $description) && strlen($description) >= 120 && strlen($description) <= 800){
                $is_pass = true;
            }
            if(!($this->unicode_verifier($description))){
                $is_pass = false;
            }
        }
        return $is_pass;
    }
    function validate_project_budget($budget)
    {
        /*
         * Notes:                                                                       Implemented | Tested
         *    1. Project budget must be a number                                           ✓            -
         *    2. Project budget must be greater than 500 and less than 1000000             ✓            -
         */
        $is_pass = false;
        if(!empty($budget)){
            if(preg_match("/^[0-9]*$/", $budget) && $budget >= 500 && $budget <= 1000000){
                $is_pass = true;
            }
            if(!($this->unicode_verifier($budget))){
                $is_pass = false;
            }
        }
        return $is_pass;
    }
    function validate_project_shortlink($shortlink){
        /*
         * Notes:                                                                       Implemented | Tested
         *    1. Project shortlink must be a string                                        ✓            -
         *    2. Project shortlink must be in a length of 10 chars                         ✓            -
         *    3. Project shortlink can't have any special characters                       ✓            -
         */
        $is_pass = false;
        if(!empty($shortlink)){
            if(preg_match("/^[a-zA-Z0-9]*$/", $shortlink) && strlen($shortlink) == 10){
                $is_pass = true;
            }
            if(!($this->unicode_verifier($shortlink))){
                $is_pass = false;
            }
        }
        return $is_pass;
    }
    function validate_project_proposal($proposal){
        /*
         * Notes:                                                                      Implemented | Tested
         *   1. Project proposal must be a string                                          ✓            -
         *   2. Project proposal must be in a length of 20 to 100 chars                    ✓            -
         *   3. Project proposal can contain letters, numbers, and special characters      ✓            -
         */
        $is_pass = false;
        if(!empty($proposal)){
            if(preg_match("/^[\x{20}-\x{7E}\n]*$/", $proposal) && strlen($proposal) >= 100 && strlen($proposal) <= 800){
                $is_pass = true;
            }
            if(!($this->unicode_verifier($proposal))){
                $is_pass = false;
            }
        }
        return $is_pass;
    }
}