<?php
include_once dirname(__DIR__).'/scripts/links.php';

function footer_component()
{
    $links = new Links();
    $footer = '
        <link rel="stylesheet" href="' . $links->path('footer_css') . '">
        <footer>
            <div class="curve d-none d-lg-block">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
                </svg>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-4 col-md-3 text-center text-lg-start d-flex flex-column item">
                        <h3>Services</h3>
                        <ul class="list-unstyled">
                            <li><a class="link-light" href="#">Web design</a></li>
                            <li><a class="link-light" href="#">Development</a></li>
                            <li><a class="link-light" href="#">Hosting</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 text-center text-lg-start d-flex flex-column item">
                        <h3>About</h3>
                        <ul class="list-unstyled">
                            <li><a class="link-light" href="'. $links->path('team_page') .'">Our team</a></li>
                            <li><a class="link-light" href="'. $links->path('nsbm_page') .'">Our University</a></li>
                            <li><a class="link-light" href="'. $links->path('terms_page') .'">Terms & conditions</a></li>
                            <li><a class="link-light" href="'. $links->path('privacy_page') .'">Privacy policy</a></li>
                        </ul>
                    </div>
                    <div class="col-sm-4 col-md-3 text-center text-lg-start d-flex flex-column item">
                        <h3>Careers</h3>
                        <ul class="list-unstyled">
                            <li><a class="link-light" href="#">Job openings</a></li>
                            <li><a class="link-light" href="#">Employee success</a></li>
                            <li><a class="link-light" href="#">Benefits</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 text-center text-lg-start d-flex flex-column align-items-center order-first align-items-lg-start order-lg-last item social">
                        <div class="fw-bold d-flex align-items-center mb-2"><img src="'. $links->path("logo_fd") .'" alt="Pixihire logo" height="50px"></div>
                        <p class="text-muted copyright fw-bold" style="color: var(--color-gray);">All of it starts from here</p>
                    </div>
                </div>
                <hr style="margin: 5px 0;">
                <div class="d-flex justify-content-between align-items-center py-2" style="padding-top: 5px!important;">
                    <p class="mb-0 fw-bold">Copyright © '. date("Y") .' Pixihire</p>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item"><a href="#" class="fa-icons"><i class="fa-brands fa-facebook"></a></i></li>
                        <li class="list-inline-item"><a href="#" class="fa-icons"><i class="fa-brands fa-twitter"></a></i></li>
                        <li class="list-inline-item"><a href="#" class="fa-icons"><i class="fa-brands fa-instagram"></a></i></li>
                    </ul>
                </div>
            </div>
        </footer>
    ';
    return $footer;
}
?>
