<?php
// Class with links
class Links{
    // For production
    public $project_domain = "https://pixihire.cf";
    // For development
//   public $project_domain = "http://localhost:881/project_website";
    private $links = array(
        // Pages
        'home_page'=> '/',
        'login_page'=> '/auth/login.php',
        'signup_page'=> '/auth/signup.php',
        '404_page'=> '/error/404.php',
        'terms_page'=> '/about/terms.php',
        'nsbm_page'=> '/about/nsbm.php',
        'privacy_page'=> '/about/privacy.php',
        'contact_page'=> '/about/contact.php',
        'about_page'=> '/about/about.php',
        'forgot_password_page'=> '/auth/forgot_password.php',
        'email_verify_page'=> '/verify/email_verify.php',
        // Components
        'navbar'=> '/components/navigation_bar.php',
        // CSS files
        'bs_css'=> '/assets/bootstrap/css/bootstrap.min.css',
        'master_css'=> '/assets/css/master.css',
        'home_css' => '/assets/css/home.css',
        'login_css'=> '/assets/css/login.css',
        'signup_css'=> '/assets/css/signup.css',
        'navbar_css'=> '/assets/css/navigation.css',
        '404_css'=> '/assets/css/404.css',
        'terms_css'=> '/assets/css/terms.css',
        'nsbm_css'=> '/assets/css/nsbm.css',
        'email_verify_css'=> '/assets/css/email_verify.css',
        // JS scripts
        'bs_js' => '/assets/bootstrap/js/bootstrap.min.js',
        'navbar_js' => '/assets/js/navigation.js',
        // Media
        'logo'=>'/assets/media/images/Logo.png',
        'logo_fd'=>'/assets/media/images/Logo I.png',
        'logo_svg' => '/assets/media/images/Logo.svg',
        'hero_bg' => '/assets/media/images/1.svg',
        'hero_img' => '/assets/media/images/sofa-man.png',
        'login_img' => '/assets/media/images/login-banner.jpg',
        'signup_img' => '/assets/media/images/signup_bg.png',
        '404_img' => '/assets/media/images/404.svg',
        'nsbm_img' => '/assets/media/images/nsbm.jpg',
        'nsbm_img2' => '/assets/media/images/nsbm2.png',
        'favicon_img' => '/assets/media/images/favicon.ico',
    );
    function path($filename){
        return $this->project_domain.$this->links[$filename];
    }
}

?>
