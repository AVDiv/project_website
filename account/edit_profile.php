<?php
session_start();
// Imports
include dirname(__DIR__).'/components/scripts/links.php';
include dirname(__DIR__).'/components/scripts/page_processing.php';
include dirname(__DIR__).'/backend/account.php';
// Initializations
$link = new Links();
$pp = new page_processor();
$controller = new Account();

$pp->is_logged_in($_COOKIE); // Check if user is logged in
// If logged in, check if account is verified
if($pp->logged_in){
    if(!$pp->is_verified_account($pp->user_id)){
        // Account is not verified
        header("Location: ".$link->path('email_verify_page')); // Redirect to verification page
        die();
    }
} else {
    // User is not logged in
    header("Location: ".$link->path('login_page')."?redirect=".$link->path('profile_edit_page')); // Redirect to login page
    die();
}
?>

<html lang="en">
<head>
    <title>Edit your profile</title>
</head>

<body>
    <section id="head" style="position: relative;">
        <div style="background: #e7eef9;position: absolute;height: 270px;width: 100%;z-index: -10;"></div>
        <div class="container" style="padding-top: 124px;z-index: 0;">
            <div class="row d-flex justify-content-center justify-content-lg-start">
                <div class="col-md-6 d-flex" style="width: 280px;">
                    <div class="d-flex justify-content-center align-items-center" id="profile-picture" style="height: 300px;width: 250px;background: #ffffff;border-top-left-radius: 10px;border-bottom-left-radius: 10px;border-bottom-right-radius: 50px;box-shadow: 5px 5px 10px rgba(33,37,41,0.1);border-top-right-radius: 50px;position: relative;"><input class="form-control" type="file" name="picture-data" style="height: 100%;width: 100%;"><i class="far fa-star" style="position: absolute;"></i></div>
                </div>
                <div class="col-md-6 d-flex flex-column">
                    <h2 class="justify-content-sm-center" id="profile-name" style="font-weight: bold;margin-top: 40px;border-color: rgb(5,27,59);">Full name</h2>
                    <div class="d-flex flex-row"><input class="form-control justify-content-sm-center" type="text" id="profile-tagline" value="Tagline" style="font-size: 24px;background: rgba(255,255,255,0);border-radius: 8px;" name="tagline" placholder="Tagline"><i class="far fa-star"></i></div>
                </div>
            </div>
        </div>
    </section>
    <section id="achivements" style="width: 100%;padding-top: 50px;">
        <div class="container" id="description" style="margin-top: 30px;">
            <p></p><textarea class="form-control" text="Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Auctor neque vitae tempus quam. Turpis massa sed elementum tempus egestas sed. Sed cras ornare arcu dui vivamus arcu felis bibendum. Porttitor lacus luctus accumsan tortor posuere ac ut. Vitae nunc sed velit dignissim sodales ut. Mi proin sed libero enim sed faucibus turpis in eu. Augue eget arcu dictum varius duis at consectetur lorem donec. Diam sollicitudin tempor id eu nisl nunc mi ipsum faucibus. Quis commodo odio aenean sed. Vestibulum mattis ullamcorper velit sed ullamcorper morbi tincidunt. Varius sit amet mattis vulputate enim nulla aliquet. Pretium lectus quam id leo in. Ut ornare lectus sit amet est placerat in egestas erat. Quam quisque id diam vel quam elementum pulvinar etiam non. Aliquam ut porttitor leo a diam. Suscipit tellus mauris a diam. Lacus vestibulum sed arcu non odio euismod lacinia at quis. Et netus et malesuada fames ac turpis egestas." placeholder="Describe yourself."></textarea>
        </div>
        <div class="container" id="portfolio" style="margin-top: 30px;padding: 20px;background: #eff4ff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(33,37,41,0.1);">
            <h3 style="font-weight: bold;border-color: rgb(5,27,59);margin-left: 20px;">Portfolio</h3>
            <div class="d-flex justify-content-center align-items-center flex-wrap">
                <div class="portfolio-item" style="height: 200px;background: #ffffff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(33,37,41,0.1);width: 180px;margin: 25px;position: relative;"><button class="btn btn-primary d-flex d-xxl-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button><img style="width: 100%;height: 75%;">
                    <div class="d-flex d-xxl-flex justify-content-center align-items-center" style="height: 25%;border-top: 1px solid rgb(205,215,225) ;">
                        <h6 style="font-weight: bold;color: rgb(113,160,230);">Portfolio item name</h6>
                    </div>
                </div>
                <div class="portfolio-item" style="height: 200px;background: #ffffff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(33,37,41,0.1);width: 180px;margin: 25px;position: relative;"><button class="btn btn-primary d-flex d-xxl-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button><img style="width: 100%;height: 75%;">
                    <div class="d-flex d-xxl-flex justify-content-center align-items-center" style="height: 25%;border-top: 1px solid rgb(205,215,225) ;">
                        <h6 style="font-weight: bold;color: rgb(113,160,230);">Portfolio item name</h6>
                    </div>
                </div>
                <div class="portfolio-item" style="height: 200px;background: #ffffff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(33,37,41,0.1);width: 180px;margin: 25px;position: relative;"><button class="btn btn-primary d-flex d-xxl-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button><img style="width: 100%;height: 75%;">
                    <div class="d-flex d-xxl-flex justify-content-center align-items-center" style="height: 25%;border-top: 1px solid rgb(205,215,225) ;">
                        <h6 style="font-weight: bold;color: rgb(113,160,230);">Portfolio item name</h6>
                    </div>
                </div>
                <div class="portfolio-item" style="height: 200px;background: #ffffff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(33,37,41,0.1);width: 180px;margin: 25px;position: relative;"><button class="btn btn-primary d-flex d-xxl-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button><img style="width: 100%;height: 75%;">
                    <div class="d-flex d-xxl-flex justify-content-center align-items-center" style="height: 25%;border-top: 1px solid rgb(205,215,225) ;">
                        <h6 style="font-weight: bold;color: rgb(113,160,230);">Portfolio item name</h6>
                    </div>
                </div>
                <div class="portfolio-item" style="height: 200px;background: #ffffff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(33,37,41,0.1);width: 180px;margin: 25px;position: relative;"><button class="btn btn-primary d-flex d-xxl-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button><img style="width: 100%;height: 75%;">
                    <div class="d-flex d-xxl-flex justify-content-center align-items-center" style="height: 25%;border-top: 1px solid rgb(205,215,225) ;">
                        <h6 style="font-weight: bold;color: rgb(113,160,230);">Portfolio item name</h6>
                    </div>
                </div>
                <div class="portfolio-item" style="height: 200px;background: #ffffff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(33,37,41,0.1);width: 180px;margin: 25px;position: relative;"><button class="btn btn-primary d-flex d-xxl-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button><img style="width: 100%;height: 75%;">
                    <div class="d-flex d-xxl-flex justify-content-center align-items-center" style="height: 25%;border-top: 1px solid rgb(205,215,225) ;">
                        <h6 style="font-weight: bold;color: rgb(113,160,230);">Portfolio item name</h6>
                    </div>
                </div>
                <div class="portfolio-item" style="height: 200px;background: #ffffff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(33,37,41,0.1);width: 180px;margin: 25px;position: relative;"><button class="btn btn-primary d-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button><img style="width: 100%;height: 75%;">
                    <div class="d-flex d-xxl-flex justify-content-center align-items-center" style="height: 25%;border-top: 1px solid rgb(205,215,225) ;">
                        <h6 style="font-weight: bold;color: rgb(113,160,230);">Portfolio item name</h6>
                    </div>
                </div>
                <div class="d-flex d-xxl-flex flex-column justify-content-center align-items-center portfolio-item" style="height: 200px;background: #ffffff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(33,37,41,0.1);width: 180px;margin: 25px;position: relative;">
                    <div class="d-flex d-xxl-flex flex-column justify-content-center align-items-center" style="position: absolute;"><i class="fas fa-plus" style="font-size: 40px;color: var(--bs-white);"></i>
                        <h4 style="font-weight: bold;color: var(--bs-white);text-align: center;">Add item</h4>
                    </div><button class="btn btn-primary" type="button" style="width: 100%;height: 100%;background: #0448DA;border-radius: 26px;"></button>
                </div>
            </div>
        </div>
        <div class="container" id="experience" style="margin-top: 30px;padding: 20px;background: #eff4ff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
            <h3 style="font-weight: bold;border-color: rgb(5,27,59);margin-left: 20px;">Experience</h3>
            <div class="d-flex flex-row justify-content-center align-items-center flex-wrap" style="margin-top: 22px;">
                <div class="d-flex align-items-center" style="height: 100px;background: #ffffff;width: 580px;border-radius: 20px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);position: relative;margin-bottom: 25px;margin-right: 25px;">
                    <div style="height: 60px;margin-left: 30px;">
                        <div class="d-flex position-details">
                            <h5 class="company-name" style="font-weight: bold;margin-right: 10px;color: rgb(5,27,59);">Sample Corp.</h5>
                            <h5 style="font-weight: bold;margin-right: 10px;color: #CDD7E1;">•</h5>
                            <h5 class="position-name" style="font-weight: bold;margin-right: 10px;color: rgb(113,160,230);">Position</h5>
                        </div>
                        <p style="font-weight: bold;color: rgb(205,215,225);">From 2XXX to 2XXX</p>
                    </div><button class="btn btn-primary d-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button>
                </div>
                <div class="d-flex align-items-center" style="height: 100px;background: #ffffff;width: 580px;border-radius: 20px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);position: relative;margin-bottom: 25px;margin-right: 25px;">
                    <div style="height: 60px;margin-left: 30px;">
                        <div class="d-flex position-details">
                            <h5 class="company-name" style="font-weight: bold;margin-right: 10px;color: rgb(5,27,59);">Sample Corp.</h5>
                            <h5 style="font-weight: bold;margin-right: 10px;color: #CDD7E1;">•</h5>
                            <h5 class="position-name" style="font-weight: bold;margin-right: 10px;color: rgb(113,160,230);">Position</h5>
                        </div>
                        <p style="font-weight: bold;color: rgb(205,215,225);">From 2XXX to 2XXX</p>
                    </div><button class="btn btn-primary d-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button>
                </div>
                <div class="d-flex align-items-center" style="height: 100px;background: #ffffff;width: 580px;border-radius: 20px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);position: relative;margin-bottom: 25px;margin-right: 25px;">
                    <div style="height: 60px;margin-left: 30px;">
                        <div class="d-flex position-details">
                            <h5 class="company-name" style="font-weight: bold;margin-right: 10px;color: rgb(5,27,59);">Sample Corp.</h5>
                            <h5 style="font-weight: bold;margin-right: 10px;color: #CDD7E1;">•</h5>
                            <h5 class="position-name" style="font-weight: bold;margin-right: 10px;color: rgb(113,160,230);">Position</h5>
                        </div>
                        <p style="font-weight: bold;color: rgb(205,215,225);">From 2XXX to 2XXX</p>
                    </div><button class="btn btn-primary d-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button>
                </div>
                <div class="d-flex justify-content-center align-items-center" style="height: 100px;background: #ffffff;width: 580px;border-radius: 20px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);position: relative;margin-bottom: 25px;margin-right: 25px;">
                    <div class="d-flex d-xxl-flex flex-row justify-content-center align-items-center" style="position: absolute;"><i class="fas fa-plus" style="font-size: 24px;color: var(--bs-white);margin-right: 5px;"></i>
                        <h4 style="font-weight: bold;color: var(--bs-white);text-align: center;margin-bottom: 0px;">Add item</h4>
                    </div><button class="btn btn-primary" type="button" style="width: 100%;height: 100%;background: #0448DA;border-radius: 20px;"></button>
                </div>
            </div>
        </div>
        <div class="container" id="education" style="margin-top: 30px;padding: 20px;background: #eff4ff;border-radius: 30px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);">
            <h3 style="font-weight: bold;border-color: rgb(5,27,59);">Education</h3>
            <div class="d-flex flex-row justify-content-center align-items-center flex-wrap" style="margin-top: 22px;">
                <div class="d-flex align-items-center" style="height: 140px;background: #ffffff;width: 580px;border-radius: 20px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);position: relative;margin-bottom: 25px;margin-right: 25px;">
                    <div style="height: 80px;margin-left: 30px;">
                        <div class="d-flex position-details">
                            <h5 class="company-name" style="font-weight: bold;margin-right: 10px;color: rgb(5,27,59);">BSc. in ABCDEFG</h5>
                            <h5 style="font-weight: bold;margin-right: 10px;color: #CDD7E1;">•</h5>
                            <h5 class="position-name" style="font-weight: bold;margin-right: 10px;color: rgb(205,215,225);">4 years</h5>
                        </div>
                        <p style="color: rgb(113,160,230);margin-bottom: 0px;">NSBM Green University - Sri Lanka</p>
                        <p style="color: rgb(113,160,230);margin-bottom: 0px;">From 2XXX to 2XXX</p>
                    </div><button class="btn btn-primary d-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button>
                </div>
                <div class="d-flex align-items-center" style="height: 140px;background: #ffffff;width: 580px;border-radius: 20px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);position: relative;margin-bottom: 25px;margin-right: 25px;">
                    <div style="height: 80px;margin-left: 30px;">
                        <div class="d-flex position-details">
                            <h5 class="company-name" style="font-weight: bold;margin-right: 10px;color: rgb(5,27,59);">BSc. in ABCDEFG</h5>
                            <h5 style="font-weight: bold;margin-right: 10px;color: #CDD7E1;">•</h5>
                            <h5 class="position-name" style="font-weight: bold;margin-right: 10px;color: rgb(205,215,225);">4 years</h5>
                        </div>
                        <p style="color: rgb(113,160,230);margin-bottom: 0px;">NSBM Green University - Sri Lanka</p>
                        <p style="color: rgb(113,160,230);margin-bottom: 0px;">From 2XXX to 2XXX</p>
                    </div><button class="btn btn-primary d-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button>
                </div>
                <div class="d-flex align-items-center" style="height: 140px;background: #ffffff;width: 580px;border-radius: 20px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);position: relative;margin-bottom: 25px;margin-right: 25px;">
                    <div style="height: 80px;margin-left: 30px;">
                        <div class="d-flex position-details">
                            <h5 class="company-name" style="font-weight: bold;margin-right: 10px;color: rgb(5,27,59);">BSc. in ABCDEFG</h5>
                            <h5 style="font-weight: bold;margin-right: 10px;color: #CDD7E1;">•</h5>
                            <h5 class="position-name" style="font-weight: bold;margin-right: 10px;color: rgb(205,215,225);">4 years</h5>
                        </div>
                        <p style="color: rgb(113,160,230);margin-bottom: 0px;">NSBM Green University - Sri Lanka</p>
                        <p style="color: rgb(113,160,230);margin-bottom: 0px;">From 2XXX to 2XXX</p>
                    </div><button class="btn btn-primary d-flex justify-content-center align-items-center" type="button" style="position: absolute;border-radius: 100px;padding: 4px 4px;top: -10px;right: -10px;background: #E63946;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);z-index: 10;border-style: none;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-96 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 14px;">
                            <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                            <path d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z"></path>
                        </svg></button>
                </div>
                <div class="d-flex justify-content-center align-items-center" style="height: 140px;background: #ffffff;width: 580px;border-radius: 20px;box-shadow: 3px 5px 10px rgba(0,0,0,0.1);position: relative;margin-bottom: 25px;margin-right: 25px;">
                    <div class="d-flex d-xxl-flex flex-row justify-content-center align-items-center" style="position: absolute;"><i class="fas fa-plus" style="font-size: 24px;color: var(--bs-white);margin-right: 5px;"></i>
                        <h4 style="font-weight: bold;color: var(--bs-white);text-align: center;margin-bottom: 0px;">Add item</h4>
                    </div><button class="btn btn-primary" type="button" style="width: 100%;height: 100%;background: #0448DA;border-radius: 20px;"></button>
                </div>
            </div>
        </div>
    </section>
    <div class="container d-flex justify-content-around align-items-center" style="margin: 50px auto;"><button class="btn btn-primary" type="button" style="background: rgb(4,72,218);padding: 15px 30px;border-radius: 10px;font-weight: bold;">Save Changes</button><button class="btn btn-primary" type="button" style="background: rgb(205,215,225);padding: 15px 30px;border-radius: 10px;font-weight: bold;color: var(--bs-btn-disabled-color);border-style: none;">Reset to default</button></div>
</body>

</html>