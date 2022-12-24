<?php
    $is_logged_in = false;
    if(isset($_COOKIE['LOGSESSID'])){
        $is_logged_in = true;
    }
?>