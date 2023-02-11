<?php
// Class with links
class Links{
    // For production
//   public $project_domain = "https://pixihire.cf";
    // For development
    public $project_domain = "http://localhost:881/project_website";
    private $links = array(
        // Pages
        'home_page'=> '/',
        'login_page'=> '/auth/login.php',
        'signup_page'=> '/auth/signup.php',
        '404_page'=> '/error/404.php',
        'dashboard_page'=> '/search.php',
        'terms_page'=> '/about/terms.php',
        'nsbm_page'=> '/about/nsbm.php',
        'privacy_page'=> '/about/privacy.php',
        'contact_page'=> '/about/contact_us.php',
        'team_page'=> '/about/team.php',
        'forgot_password_page'=> '/auth/forgot_password.php',
        'email_verify_page'=> '/auth/verify/email_verify.php',
        'privacy_policy_page'=> '/about/privacy.php',
        'profile_edit_page' => '/account/edit_profile.php',
        'logout_page' => '/account/logout.php',
        'contact_us_page' => '/about/contact_us.php',
        'post_project_page' => '/post_project.php',
        'project_page' => '/projects.php',
        'search_page' => '/search.php',
        'profile_page' => '/user.php',
        // APIs
        'otp_resend_api' => '/api/send_otp.php',
        'search_api' => '/api/search.php',
        'proposals_api' => '/api/proposals.php',
        // Components
        'navbar'=> '/components/navigation_bar.php',
        // CSS files
        'bs_css'=> '/assets/bootstrap/css/bootstrap.min.css',
        'master_css'=> '/assets/css/master.css',
        'home_css' => '/assets/css/home.css',
        'login_css'=> '/assets/css/login.css',
        'signup_css'=> '/assets/css/signup.css',
        'navbar_css'=> '/assets/css/navigation.css',
        'footer_css'=> '/assets/css/footer.css',
        '404_css'=> '/assets/css/404.css',
        'terms_css'=> '/assets/css/terms.css',
        'nsbm_css'=> '/assets/css/nsbm.css',
        'email_verify_css'=> '/assets/css/email_verify.css',
        'profile_css' => '/assets/css/profile.css',
        'contact_us_css' => '/assets/css/contact.css',
        'bs_grid_images_css' => '/assets/css/Projects-Grid-images.css',
        'project_css' => '/assets/css/project.css',
        'search_css' => '/assets/css/search.css',
        // JS scripts
        'bs_js' => '/assets/bootstrap/js/bootstrap.min.js',
        'navbar_js' => '/assets/js/navigation.js',
        'email_verify_js' => '/assets/js/verify_email.js',
        'profile_edit_js' => '/assets/js/edit_profile.js',
        'signup_js' => '/assets/js/signup.js',
        'post_project_js' => '/assets/js/post_project_form.js',
        'propose_project_js' => '/assets/js/propose_project_form.js',
        'search_function_js' => '/assets/js/search_functionality.js',
        'assign_project_js' => '/assets/js/project_assign.js',
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
        'email_img' => '/assets/media/images/email.png',
        'avatar_img' => '/assets/media/images/avatar.png',
        'email_temp_bg' => '/assets/media/images/email_bg.jpeg',
        'email_temp_img' => '/assets/media/images/email_img.png',
        'twitter_logo' => '/assets/media/images/twitter.png',
        'fb_logo' => '/assets/media/images/fb.png',
        'linkedin_logo' => '/assets/media/images/linkedin.png',
        'instagram_logo' => '/assets/media/images/instagram.png',
        'project_wall_img' => '/assets/media/images/wall.png',
        'team_avin_img' => '/assets/media/images/avin.png',
        'team_thinula_img' => '/assets/media/images/thinula.jpg',
        'team_hansaka_img' => '/assets/media/images/hansaka.jpg',
        'team_nidula_img' => '/assets/media/images/nidula.jpg',
        'team_praneeth_img' => '/assets/media/images/praneeth.jpg',
        'team_dilshan_img' => '/assets/media/images/dilshan.jpg',
    );
    function path($filename){
        return $this->project_domain.$this->links[$filename];
    }
}

?>
