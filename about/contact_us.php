<?php
session_start();
// Imports
include_once dirname(__DIR__).'/components/scripts/links.php';
include_once dirname(__DIR__).'/components/scripts/page_processing.php';
include_once dirname(__DIR__) . '/backend/controller.php';
// Initializations
$link = new Links();
$pp = new page_processor();
$controller = new Controller();;

$pp->is_logged_in($_COOKIE); // Check if user is logged in
// If logged in, check if account is verified
if($pp->logged_in){
    if(!$pp->is_verified_account($pp->user_id)){
        // Account is not verified
        header("Location: ".$link->path('email_verify_page')); // Redirect to verification page
        die();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once dirname(__DIR__).'/components/scripts/essentials.php'; ?>
    <title>Contact us | Pixihire</title>
    <link rel="stylesheet" href="<?php echo $link->path('contact_us_css'); ?>">
</head>
<body>
    <!-- Navigation bar -->
    <?php
        include dirname(__DIR__).'/components/sections/navigation_bar.php';
        echo navbar_component($pp->logged_in, ($pp->logged_in?$controller->get_user_details($pp->user_id)["profile_pic"]:""));
    ?>
    <section class="position-relative d-flex justify-content-center align-items-center py-4 py-xl-5" style="min-height: 100vh;">
        <div class="container position-relative">
            <div class="row mb-5">
                <div class="col-md-8 col-xl-6 text-center mx-auto">
                    <h2>Contact us</h2>
                    <p class="w-lg-50">For any inquiries or any problems please contact us with the following details</p>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="d-flex flex-column justify-content-center align-items-center align-items-md-start h-100">
                        <div class="d-flex align-items-center p-3">
                            <div class="bs-icon-md bs-icon-rounded bs-icon-primary d-flex flex-shrink-0 justify-content-center align-items-center d-inline-block bs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-envelope">
                                    <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"></path>
                                </svg></div>
                            <div class="px-2">
                                <h6 class="mb-0">Email</h6>
                                <p class="mb-0">pixihire@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-5 col-xl-4">
                    <div>
                        <form class="p-3 p-xl-4" method="post">
                            <div class="mb-3"><input class="form-control" type="text" id="name-1" name="name" placeholder="Name"></div>
                            <div class="mb-3"><input class="form-control" type="email" id="email-1" name="email" placeholder="Email"></div>
                            <div class="mb-3"><textarea class="form-control" id="message-1" name="message" rows="6" placeholder="Message"></textarea></div>
                            <div><button class="btn btn-primary d-block w-100" type="submit">Send </button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>