<?php
    include_once '../backend/account.php';
    class page_processor{
    public $logged_in = false;
    private $controller;

    function __construct(){
        $this->controller = new Account();
    }
    function is_logged_in($cookie){
        if(isset($cookie['LOGSESSID'])){
            $cookie_string = $cookie['LOGSESSID'];
            $user_id = $this->controller->check_login_session($cookie_string);
            if($user_id){
                $this->is_logged_in = true;
            }
        }
    }
}
?>