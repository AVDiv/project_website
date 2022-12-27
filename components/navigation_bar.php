<?php
    include_once 'links.php';

    function navbar_component($is_logged_in){
        $links = new Links();
        $navigation_component ='
            <link rel="stylesheet" href="'. $links->path('navbar_css') .'">
            <nav id="navbar" class="navbar navbar-light navbar-expand-md py-3" style="width: 100%;padding-right: 32px;padding-left: 32px;">
                <div class="container-fluid"><a class="navbar-brand d-flex align-items-center" href="'. $links->path('home_page') .'"><img src="'. $links->path('logo') .'" style="height: 37px;" alt="Logo"></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-3"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navcol-3">
                        <ul class="navbar-nav mx-auto">
                            <li class="nav-item dropdown" style="font-weight: 600;padding: 0px 20px;letter-spacing: 0.5px;"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Work</a><i class="fa-solid fa-caret-down"></i>
                                <div class="dropdown-menu" style="box-shadow: 5px 5px #CDD7E1;">
                                    <a class="dropdown-item" href="#">Propose Projects</a>
                                    <a class="dropdown-item" href="#">Second Item</a>
                                    <a class="dropdown-item" href="#">Third Item</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" style="font-weight: 600;padding: 0px 20px;letter-spacing: 0.5px;"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">Services</a><i class="fa-solid fa-caret-down"></i>
                                <div class="dropdown-menu" style="box-shadow: 5px 5px #CDD7E1;">
                                    <a class="dropdown-item" href="#">Post Project</a>
                                    <a class="dropdown-item" href="#">Find Freelancer</a>
                                    <a class="dropdown-item" href="#">Third Item</a>
                                </div>
                            </li>
                            <li class="nav-item dropdown" style="font-weight: 600;padding: 0px 20px;letter-spacing: 0.5px;"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">About us</a><i class="fa-solid fa-caret-down"></i>
                                <div class="dropdown-menu" style="box-shadow: 5px 5px #CDD7E1;">
                                    <a class="dropdown-item" href="#">Who are we</a>
                                    <a class="dropdown-item" href="#">Contact us</a>
                                    <a class="dropdown-item" href="#">Our University</a>
                                    <a class="dropdown-item" href="'. $links->path('terms_page') .'">Terms &amp; Conditions</a>
                                    <a class="dropdown-item" href="#">Privacy Policy</a>
                                </div>
                            </li>
                        </ul>
                        <ul class="navbar-nav"><li class="nav-item signup-link" style="background: var(--bs-blue);color: var(--bs-body-bg);border-radius: 100px;padding: 3px 5px;margin-right: 10px;"><a class="nav-link" href="'. $links->path('signup_page') .'" style="font-weight: 600;height: 100%;width: 100%;color: var(--bs-white);font-size: 16px;padding: 0px;padding-left: 15px;padding-bottom: 5px;padding-right: 15px;padding-top: 5px;letter-spacing: 0.5px;">Signup</a></li>
                            <li class="nav-item"><a class="nav-link" href="'. $links->path('login_page') .'" style="font-weight: 600;font-size: 16px;letter-spacing: 0.5px;">Login</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <script src="'. $links->path('navbar_js') .'"></script>
            ';
        return $navigation_component;
    }

?>
