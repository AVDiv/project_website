<?php
// Class with links
class Links{
    /* For production
       $project_domain = "www.pixihire.com"
    */
    public $project_domain = "http://localhost:8080/project_website";
    public $links = array(
        // Pages
        'home_page'=> '/',
        'login_page'=> '/auth/login.php',
        // Components
        'navbar'=> '/components/navigation_bar.php',
        // CSS files
        'bs_css'=> '/assets/bootstrap/css/bootstrap.min.css',
        'master_css'=> '/assets/css/master.css',
        'login_css'=> '/assets/css/login.css',
        'navbar_css'=> '/assets/css/navigation.css',
        // JS scripts
        'bs_js' => '/assets/bootstrap/js/bootstrap.min.js',
        'navbar_js' => '/assets/js/navigation.js',
        // Media
        'logo'=>'/assets/media/images/Logo.png',
        'logo_fd'=>'/assets/media/images/Logo I.png'
    );
    function path($filename){
        return $this->project_domain.$this->links[$filename];
    }
}

?>
