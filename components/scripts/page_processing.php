<?php
    include_once dirname(__DIR__, 2).'/backend/account.php';

    class page_processor{
    public bool $logged_in = false;
    public int $user_id = 0;
    private Account $controller;
    function __construct(){
        $this->controller = new Account();
    }
    function is_logged_in($cookie): void
    {
        if(isset($cookie['LOGSESSID'])){
            $cookie_string = $cookie['LOGSESSID'];
            $this->user_id = $this->controller->check_login_session($cookie_string);
            if($this->user_id){
                $this->logged_in = true;
            }
        }
    }
    function is_verified_account($user_id): bool{
        if( $this->controller->check_email_verification($user_id)){
            return true;
        }
        return false;
    }
}
