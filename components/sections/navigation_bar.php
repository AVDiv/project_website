<?php

    include_once  dirname(__DIR__, 2).'/components/scripts/links.php';
    function navbar_component($is_logged_in, $profile_picture = "", $dark_theme = false) {
        $links = new Links();
        $navigation_component ='
            <link rel="stylesheet" href="'. $links->path('navbar_css') .'">
            <nav id="navbar" class="navbar navbar-light navbar-expand-md py-3'. ($dark_theme?' dark':'') .'" style="width: 100%;padding-right: 32px;padding-left: 32px;">
                <div class="container-fluid"><a class="navbar-brand d-flex align-items-center" href="'. $links->path('home_page') .'"><div style="height: 37px;">'.  file_get_contents($links->path('logo_svg'))  .'</div></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-3"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-3">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item dropdown" style="font-weight: 600;padding: 0 20px;letter-spacing: 0.5px;"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Work</a><i class="fa-solid fa-caret-down"></i>
                                <div class="dropdown-menu" style="box-shadow: 5px 5px #CDD7E1;">
                                    <a class="dropdown-item" href="'. $links->path('search_page') .'?m=1">Propose Projects</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" style="font-weight: 600;padding: 0 20px;letter-spacing: 0.5px;"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Services</a><i class="fa-solid fa-caret-down"></i>
                                <div class="dropdown-menu" style="box-shadow: 5px 5px #CDD7E1;">
                                    <a class="dropdown-item" href="'. $links->path('post_project_page') .'">Post Project</a>
                                    <a class="dropdown-item" href="'. $links->path('search_page') .'?m=2">Find Freelancer</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" style="font-weight: 600;padding: 0 20px;letter-spacing: 0.5px;"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">About us</a><i class="fa-solid fa-caret-down"></i>
                                <div class="dropdown-menu" style="box-shadow: 5px 5px #CDD7E1;">
                                    <a class="dropdown-item" href="'. $links->path('team_page') .'">Our Team</a>
                                    <a class="dropdown-item" href="'. $links->path('contact_us_page') .'">Contact us</a>
                                    <a class="dropdown-item" href="'. $links->path('nsbm_page') .'">Our University</a>
                                    <a class="dropdown-item" href="'. $links->path('terms_page') .'">Terms &amp; Conditions</a>
                                    <a class="dropdown-item" href="'. $links->path('privacy_policy_page') .'">Privacy Policy</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav">'.
                        (!($is_logged_in)?(
                            '<li class="nav-item signup-link" style="background: var(--bs-blue);color: var(--bs-body-bg);border-radius: 100px;padding: 3px 5px;margin-right: 10px;"><a class="nav-link" href="'. $links->path('signup_page') .'" style="font-weight: 600;height: 100%;width: 100%;color: var(--bs-white);font-size: 16px;padding: 0px;padding-left: 15px;padding-bottom: 5px;padding-right: 15px;padding-top: 5px;letter-spacing: 0.5px;">Signup</a></li>
                            <li class="nav-item"><a class="nav-link" href="'. $links->path('login_page') .'" style="font-weight: 600;font-size: 16px;letter-spacing: 0.5px;">Login</a></li>'
                            ):(
                            '<li class="nav-item dropdown" style="font-weight: 600;padding: 0 20px;letter-spacing: 0.5px;"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><img id="nav-profile-pic" src="'. ($profile_picture!==""?$profile_picture:$links->path('avatar_img')) .'" width="35px" height="35px" style="border-radius: 100px;" alt="profile picture"></a>
                                <div class="dropdown-menu dropdown-right" style="box-shadow: 5px 5px #CDD7E1;">
                                    <a class="dropdown-item" href="'. $links->path('dashboard_page') .'"><i class="fa-solid fa-chart-line"></i>&nbsp;Dashboard</a>
                                    <a class="dropdown-item" href="'. $links->path('profile_edit_page') .'"><i class="fa-solid fa-pen-to-square"></i>&nbsp;Edit profile</a>
                                    <a class="dropdown-item" href="'. $links->path('logout_page') .'"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;Logout</a>
                                </div>
                            </li>'
                        )).'</ul>
                    </div>
                </div>
            </nav>
            <script src="'. $links->path('navbar_js') .'"></script>
            ';
        return $navigation_component;
    }

?>
