<?php
// Class with links
class Links{
    /* For production
       $project_domain = "www.pixihire.com"
    */
    public $project_domain = "http://localhost:880/project_website";
    private $links = array(
        // Pages
        'home_page'=> '/',
        'login_page'=> '/auth/login.php',
        'signup_page'=> '/auth/signup.php',
        // Components
        'navbar'=> '/components/navigation_bar.php',
        // CSS files
        'bs_css'=> '/assets/bootstrap/css/bootstrap.min.css',
        'master_css'=> '/assets/css/master.css',
        'home_css' => '/assets/css/home.css',
        'login_css'=> '/assets/css/login.css',
        'signup_css'=> '/assets/css/signup.css',
        'navbar_css'=> '/assets/css/navigation.css',
        // JS scripts
        'bs_js' => '/assets/bootstrap/js/bootstrap.min.js',
        'navbar_js' => '/assets/js/navigation.js',
        // Media
        'logo'=>'/assets/media/images/Logo.png',
        'logo_fd'=>'/assets/media/images/Logo I.png',
        'hero_bg' => '/assets/media/images/1.svg',
        'hero_img' => '/assets/media/images/sofa-man.png',
        'login_img' => '/assets/media/images/login-banner.jpg',
        'signup_img' => '/assets/media/images/signup_bg.png'
    );
    function path($filename){
        return $this->project_domain.$this->links[$filename];
    }
}

?>
