<?php
    include_once "config/db.php";

    // Class with the connection to the _database and functions to interact with the _database
    class Model{
        // Variables for the connection to the _database
        private PDO $connection;
        private string $_servername = HOST; // Host or Server address
        private string $_username = USER; // Username of the user accessing the database
        private string $_password = PSK; // Password for the username accessing the database
        private string $_database = DB; // Database name

        function __construct(){
            try {
                $this->connection = new PDO("mysql:host=$this->_servername;dbname=$this->_database", $this->_username, $this->_password);
                // set the PDO error mode to exception
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "Connected successfully";
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
                // Change error output later
            }
        }
        /*
        *   Model functions for the account operations

            function returns:
                true - exists/pass(Based on the situation)
                false - does not exist/not pass(Based on the situation)
                0 - success/executed without an error
                -1 - error/failed to execute
        */

        // Model function to create a user account
        function create_account($firstname, $lastname, $username, $dob, $phone_no, $email_address){
            try{
                $stmt = $this->connection->prepare("INSERT INTO users (firstname, lastname, DOB, username, phone_no, email_address) VALUES (:firstname, :lastname, :dob, :username, :phone_no, :email_address)");
                $stmt->bindParam(":firstname", $firstname);
                $stmt->bindParam(":lastname", $lastname);
                $stmt->bindParam(":dob", $dob);
                $stmt->bindParam(":username", $username);
                $stmt->bindParam(":phone_no", $phone_no);
                $stmt->bindParam(":email_address", $email_address);
                $stmt->execute();
                // Return user id
                $stmt = $this->connection->prepare("SELECT ID FROM users WHERE username = :username");
                $stmt->bindParam(":username", $username);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['ID'];
            } catch (PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to check if the username is already taken
        function check_username($username){
            try{
                $stmt = $this->connection->prepare("SELECT ID FROM users WHERE username = :username");
                $stmt->bindParam(":username", $username);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result['ID'] !== null){
                    return $result['ID'];
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to check if the email is already taken
        function check_email($email){
            try{
                $stmt = $this->connection->prepare("SELECT ID FROM users WHERE email_address = :email");
                $stmt->bindParam(":email", $email);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result['ID'] !== null){
                    return $result['ID'];
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to check if the phone number is already taken
        function check_phone($phone){
            try{
                $stmt = $this->connection->prepare("SELECT ID FROM users WHERE phone_no = :phone");
                $stmt->bindParam(":phone", $phone);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result['ID'] !== null){
                    return $result['ID'];
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to check if the user is banned
        function check_ban($u_id){
            try{
                $stmt = $this->connection->prepare("SELECT reason_ID FROM banned_users WHERE u_ID = :u_id AND is_valid = 1");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result['reason_ID'] !== null){
                    return $result['reason_ID'];
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get the reason for which the user was banned
        function get_ban_reason($reason_id)
        {
            try {
                $stmt = $this->connection->prepare("SELECT reason FROM ban_reason WHERE reason_ID = :reason_ID");
                $stmt->bindParam(":reason_ID", $reason_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result['reason'];
            } catch (PDOException $e) {
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to create a login session
        function set_login_session($u_id, $cookie_string){
            try{
                $stmt = $this->connection->prepare("INSERT INTO login_sessions (u_ID, cookie_string) VALUES (:u_id, :cookie_string)");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->bindParam(":cookie_string", $cookie_string);
                $stmt->execute();
                // Fetch the session ID
                $stmt = $this->connection->prepare("SELECT ID FROM login_sessions WHERE cookie_string = :cookie_string");
                $stmt->bindParam(":cookie_string", $cookie_string);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result['ID'] !== null) {
                    return $result['ID'];
                } else {
                    return false;
                }
            } catch (PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get details of the user's current logged sessions
        function get_login_session($cookie_string){
            try{
                $stmt = $this->connection->prepare("SELECT u_ID FROM login_sessions WHERE cookie_string = :cookie_string AND is_active = 1");
                $stmt->bindParam(":cookie_string", $cookie_string);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result['u_ID']){
                    return $result['u_ID'];
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to log out of the current session
        function logout_session($cookie_string): int{
            try{
                $stmt = $this->connection->prepare("UPDATE login_sessions SET is_active = 0, session_end=CURRENT_TIMESTAMP WHERE cookie_string = :cookie_string");
                $stmt->bindParam(":cookie_string", $cookie_string);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get the user's details
        function get_user_details($u_id){
            try{
                $stmt = $this->connection->prepare("SELECT * FROM users WHERE ID = :u_id");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result;
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get the user's profile picture
        function get_user_profile_picture($u_id){
            try{
                $stmt = $this->connection->prepare("SELECT path FROM user_profile_picture WHERE u_ID = :u_id AND is_active = 1");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result['path'];
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to change the user's profile picture
        function change_user_profile_picture($u_id, $path) : int{
            try{
                // Deactivate the current profile picture
                $stmt = $this->connection->prepare("UPDATE user_profile_picture SET is_active = 0 WHERE u_ID = :u_id AND is_active = 1");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->execute();
                // Insert the new profile picture
                $stmt = $this->connection->prepare("INSERT INTO user_profile_picture (u_ID, path) VALUES (:u_id, :path)");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->bindParam(":path", $path);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get the user's password
        function get_password($u_id){
            try{
                $stmt = $this->connection->prepare("SELECT password FROM password WHERE u_ID = :u_id AND is_active = 1");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result['password'];
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to change user's password
        function set_password($u_id, $password) : int{
            try {
                // Deactivate the current password
                $stmt = $this->connection->prepare("UPDATE password SET is_active = 0 WHERE u_ID = :u_id AND is_active = 1");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->execute();
                // Set the new password
                $stmt = $this->connection->prepare("INSERT INTO password (u_ID, password) VALUES (:u_id, :password)");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->bindParam(":password", $password);
                $stmt->execute();
                return 0;
            } catch (PDOException $e) {
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get the email verification request time
        function get_email_verification_request($u_id){
            try{
                $stmt = $this->connection->prepare("SELECT ID, u_ID, OTP, create_time FROM email_verification WHERE u_ID = :u_id AND is_verified = 0 ORDER BY create_time DESC LIMIT 1");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result;
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to set the user's email verification request
        function set_email_verification_request($u_id, $otp) : int{
            try{
                // Set the email verification request
                $stmt = $this->connection->prepare("INSERT INTO email_verification (u_ID, OTP) VALUES (:u_id, :otp)");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->bindParam(":otp", $otp);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get the user's email verification status
        function get_email_verification_status($u_id){
            try{
                $stmt = $this->connection->prepare("SELECT ID FROM email_verification WHERE u_ID = :u_id AND is_verified = 1 ORDER BY create_time DESC LIMIT 1");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result['ID'];
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to set the user's email is verified status
        function set_email_is_verified($u_id, $otp) : int{
            try{
                // Set the new email verification status
                $stmt = $this->connection->prepare("UPDATE email_verification SET is_verified = 1, verify_time=CURRENT_TIMESTAMP WHERE u_ID = :id AND OTP = :otp");
                $stmt->bindParam(":id", $u_id);
                $stmt->bindParam(":otp", $otp);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get the no of email verification requests for the day
        function get_no_of_email_verification_requests($u_id){
            try{
                $stmt = $this->connection->prepare("SELECT COUNT(ID) AS no_of_requests FROM email_verification WHERE u_ID = :u_id AND DATE(create_time) = CURDATE()");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result['no_of_requests'];
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to add a portfolio item
        function add_portfolio_item($u_ID, $portfolio_title, $portfolio_description, $portfolio_img){
            try{
                $stmt = $this->connection->prepare("INSERT INTO user_portfolio (u_ID, portfolio_title, portfolio_description, portfolio_img_path) VALUES (:u_id, :port_title, :port_desc, :port_img)");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->bindParam(":port_title", $portfolio_title);
                $stmt->bindParam(":port_desc", $portfolio_description);
                $stmt->bindParam(":port_img", $portfolio_img);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get a portfolio item
        function get_portfolio_items($u_ID){
            try{
                $stmt = $this->connection->prepare("SELECT (ID, u_ID, portfolio_title, portfolio_description, portfolio_img_path) FROM user_portfolio WHERE u_ID = :u_id AND is_active = 1 ORDER BY added_time");
                $stmt->bindParam(":u_id", $u_ID);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result;
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to remove a portfolio item
        function remove_portfolio_item($ID){
            try{
                $stmt = $this->connection->prepare("UPDATE user_portfolio SET is_active = 0 WHERE ID = :id");
                $stmt->bindParam(":id", $ID);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to add a experience item
        function add_experience_item($u_ID, $experience_company, $experience_position, $begin_year, $end_year){
            try{
                $stmt = $this->connection->prepare("INSERT INTO user_experience (u_ID, company,  position, begin_year, end_year) VALUES (:u_id, :xp_comp, :xp_posi, :xp_byear, xp_eyear)");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->bindParam(":xp_comp", $experience_company);
                $stmt->bindParam(":xp_posi", $experience_position);
                $stmt->bindParam(":xp_byear", $begin_year);
                $stmt->bindParam(":xp_eyear", $end_year);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get a experience item
        function get_experience_items($u_ID){
            try{
                $stmt = $this->connection->prepare("SELECT (ID, u_ID, company,  position, begin_year, end_year) FROM user_experience WHERE u_ID = :u_id AND is_active = 1 ORDER BY added_time");
                $stmt->bindParam(":u_id", $u_ID);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result;
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to remove a experience item
        function remove_experience_item($ID){
            try{
                $stmt = $this->connection->prepare("UPDATE user_experience SET is_active = 0 WHERE ID = :id");
                $stmt->bindParam(":id", $ID);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to add a education item
        function add_education_item($u_ID, $education_title, $education_institute, $begin_year, $end_year){
            try{
                $stmt = $this->connection->prepare("INSERT INTO user_experience (u_ID, edu_name, edu_institute, begin_year, end_year) VALUES (:u_id, :edu_name, :edu_institute, :edu_byear, edu_eyear)");
                $stmt->bindParam(":u_id", $u_id);
                $stmt->bindParam(":edu_name", $experience_company);
                $stmt->bindParam(":edu_institute", $experience_position);
                $stmt->bindParam(":edu_byear", $begin_year);
                $stmt->bindParam(":edu_eyear", $end_year);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get a education item
        function get_education_items($u_ID){
            try{
                $stmt = $this->connection->prepare("SELECT (ID, u_ID, edu_name, edu_institute, begin_year, end_year) FROM user_education WHERE u_ID = :u_id AND is_active = 1 ORDER BY added_time");
                $stmt->bindParam(":u_id", $u_ID);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result;
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to remove a education item
        function remove_education_item($ID){
            try{
                $stmt = $this->connection->prepare("UPDATE user_education SET is_active = 0 WHERE ID = :id");
                $stmt->bindParam(":id", $ID);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to add a project
        function set_project($u_ID, $project_title, $project_description, $budget, $shortlink){
            try{
                $stmt = $this->connection->prepare("INSERT INTO projects (u_ID, project_title, project_description, budget, shortlink) VALUES (:u_id, :project_title, :project_description, :budget, :shortlink)");
                $stmt->bindParam(":u_id", $u_ID);
                $stmt->bindParam(":project_title", $project_title);
                $stmt->bindParam(":project_description", $project_description);
                $stmt->bindParam(":budget", $budget);
                $stmt->bindParam(":shortlink", $shortlink);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get a project from short link
        function get_project_from_shortlink($short_link){
            try{
                $stmt = $this->connection->prepare("SELECT * FROM projects WHERE shortlink = :shortlink AND is_active = 1 ORDER BY created_date");
                $stmt->bindParam(":shortlink", $short_link);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result;
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get projects from user ID
        function get_projects_from_userid($u_ID){
            try{
                $stmt = $this->connection->prepare("SELECT * FROM user_project WHERE u_ID = :u_id AND is_active = 1 ORDER BY created_date");
                $stmt->bindParam(":u_id", $u_ID);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result;
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to remove a project item
        function remove_project($ID){
            try{
                $stmt = $this->connection->prepare("UPDATE project SET is_active = 0 WHERE ID = :id");
                $stmt->bindParam(":id", $ID);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to add a project proposal
        function set_project_proposal($u_ID, $project_ID, $proposal_description, $proposal_budget, $callback_email){
            try {
                $stmt = $this->connection->prepare("INSERT INTO project_proposals (u_ID, p_ID, proposal, budget, email) VALUES (:u_id, :project_id, :proposal_description, :proposal_budget, :callback_email)");
                $stmt->bindParam(":u_id", $u_ID);
                $stmt->bindParam(":project_id", $project_ID);
                $stmt->bindParam(":proposal_description", $proposal_description);
                $stmt->bindParam(":proposal_budget", $proposal_budget);
                $stmt->bindParam(":callback_email", $callback_email);
                $stmt->execute();
                return 0;
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
        // Model function to get project proposals from project ID and user ID
        function get_project_proposal_from_project_and_user($user_id, $project_id){
            try{
                $stmt = $this->connection->prepare("SELECT * FROM project_proposals WHERE u_ID = :u_id AND p_ID = :project_id AND is_active = 1 ORDER BY created_time DESC LIMIT 1");
                $stmt->bindParam(":u_id", $user_id);
                $stmt->bindParam(":project_id", $project_id);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if($result){
                    return $result;
                }else{
                    return false;
                }
            } catch(PDOException $e){
                echo "PDO(MySQL) Error: " . $e->getMessage();
                return -1;
            }
        }
    }