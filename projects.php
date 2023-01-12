<?php
session_start();
// Imports
include_once 'components/scripts/links.php';
include_once 'components/scripts/page_processing.php';
include_once 'backend/controller.php';
include_once 'backend/html_utilities.php';
// Initializations
$link = new Links();
$pp = new page_processor();
$controller = new Controller();
$result = 0;
$error_code = 0;
$project_details = null;
$project_user_details = null;
$user_details = null;
$project_proposal = null;
$ui_mode = 0; // 0: Not logged in, 1: Freelancer, 2: Freelancer(Already submitted) ,  3: Project owner, 4: Project owner(Already assigned)
if(!empty($_GET['id'])){
    $project_details = $controller->get_project_details($_GET['id']);
    if($project_details == 1 || $project_details == 2){
        header("HTTP/1.0 404 Not Found");
        header("Location: ".$link->path('404_page'));
        die();
    } else {
        $project_details['budget'] = number_format($project_details['budget']);
        $project_user_details = $controller->get_user_details($project_details['u_ID']);
    }
    $pp->is_logged_in($_COOKIE); // Check if user is logged in
    // If logged in, check if account is verified
    if($pp->logged_in){
        $ui_mode = 1;
        $user_details = $controller->get_user_details($pp->user_id);
        $project_proposal = $controller->get_project_proposal_by_user($pp->user_id, $project_details['ID']);
        if (!empty($project_proposal['p_ID'])) {

            $ui_mode = 2;
        }
        if($project_details['u_ID'] == $pp->user_id){
            $ui_mode = 3;
        }
        if(!$pp->is_verified_account($pp->user_id)){
            // Account is not verified
            header("Location: ".$link->path('email_verify_page')); // Redirect to verification page
            die();
        } else{
            // Account is verified
            // Check if any POST request is made
            if(!empty($_POST)){
                // Check if all required data is given
                if(!empty($_POST['email']) && !empty($_POST['proposal']) && !empty($_POST['budget']) && $ui_mode == 1){
                    $result = $controller->propose_project($pp->user_id, $_GET['id'], $_POST['email'], $_POST['proposal'], $_POST['budget']);
                }
            }
        }
    }
} else {
    header("HTTP/1.0 404 Not Found");
    header("Location: ".$link->path('404_page'));
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once 'components/scripts/essentials.php'; ?>
    <title><?php echo $project_details['project_title']?> | Pixihire</title>
    <link rel="stylesheet" href="<?php echo $link->path('project_css') ?>">
</head>

<body>
<!-- Navigation bar -->
<?php
include 'components/sections/navigation_bar.php';
echo navbar_component($pp->logged_in, (!empty($user_details['profile_pic'])?$user_details['profile_pic']:""), true);
?>

<header>
    <div>
        <div style="height: 425px;">
            <div style="width: 100%;height: 100%;background: url('<?php echo $link->path('project_wall_img'); ?>');position: absolute;"></div>
            <div style="position: relative;width: 100%;height: 100%;background: #163565;backdrop-filter: opacity(1);opacity: 1;mix-blend-mode: lighten;"><div class="custom-shape-divider-bottom-1672634478" style="width: 100%;overflow: hidden;line-height: 0;transform: rotate(180deg); postion:absolute; bottom: 0;left: 0; height: 425px;">
                    <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none" style="position: relative;display: block;min-width: 1300px;width: 150%;height: 150px;">
                        <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill" style="fill: #FFFFFF;"></path>
                    </svg>
                </div></div>
        </div>
        <div id="project_heading" style="border-color: rgb(255,255,255);color: rgb(255,255,255);position: absolute;bottom: 140px;padding-left: 110px;">
            <h1 id="title" style="text-align: left;font-weight: bold;width: 100%;"><?php echo html_mitigation($project_details['project_title']); ?></h1>
            <div class="d-flex align-items-center" id="user-details" style="color: inherit;width: 100%;"><img src="<?php echo ($project_user_details['profile_pic']===''?$link->path('avatar_img'):$project_user_details['profile_pic']); ?>" style="width: 50px;height: 50px;border-radius: 123px;">
                <a href="<?php echo $link->path('profile_page')."?u=".html_mitigation($project_user_details['username']); ?>" style="color: inherit; text-decoration: none;"><h5 id="project_user" style="padding-left: 20px;">@<?php echo $project_user_details['username']?></h5></a>
            </div>
        </div>
    </div>
</header>
<div class="container" style="min-height: 350px;">
    <h1 id="budget-text" style="font-weight: bold;margin: 30px 0px;color: var(--color-dark-blue);">Budget: Rs. <?php echo html_mitigation($project_details['budget']); ?></h1>
    <h2 style="font-weight: bold;margin: 30px 0px;color: var(--color-dark-blue);">Project description:</h2>
    <p style="margin: 30px 0px;color: var(--color-dark-blue);"><?php echo html_mitigation($project_details['project_description']); ?></p>
</div>
<div class="container" style="margin-bottom: 30px;">
    <?php
    if($ui_mode == 0){
        echo '
        <div style="padding: 32px;border-radius: 10px;border: 1px solid rgb(197,197,197);box-shadow: 0px 5px 10px rgba(33,37,41,0.05);color: var(--color-dark-blue);">
            <h3>Want to propose for this project?</h3>
            <button style="padding: 10px 15px; background-color: var(--color-blue); color: var(--color-white); border-radius: 10px; font-weight: 600; border: none;" onclick="window.location.assign(\''. $link->path('login_page') .'\');">Login</button>
        </div>
        ';
    }else if($ui_mode == 1) {
        echo '
        <form method="post" style="padding: 32px;border-radius: 10px;border: 1px solid rgb(197,197,197);box-shadow: 0px 5px 10px rgba(33,37,41,0.05);color: var(--color-dark-blue);">
            <h2 style="text-align: center; font-weight: 600;">Project proposal</h2>
            <div style="height: auto;margin-top: 30px;">
                <h6>Contactable email address:</h6><input class="form-control" type="email" name="email" minlength="5" maxlength="50" value="' . $user_details['email'] . '" required>
            </div>
            <div style="height: auto;margin-top: 30px;">
                <h6>Write your proposal:</h6><textarea class="form-control" style="width: 100%;height: 240px;" name="proposal" minlength="100" maxlength="800" required></textarea>
            </div>
            <div style="height: auto;margin-top: 30px;">
                <h6>Your budget:</h6><input class="form-control" id="budget" type="text" name="budget" placeholder="Rs. _______" maxlength="12" required><small class="form-text" style="padding-left: 10px;padding-top: 10px;" data-budget="12000">The least budget amount you can enter is 50% of the project budget</small>
            </div>
            <div class="d-flex justify-content-center" style="height: auto;margin-top: 30px;"><input id="submit-btn" class="form-control" type="submit" name="submit" value="Send" /></div>
        </form>
        <script src="'. $link->path('propose_project_js') .'"></script>
        ';
    } elseif ($ui_mode == 2) {
        echo '<form method="post" style="padding: 32px;border-radius: 10px;border: 1px solid rgb(197,197,197);box-shadow: 0px 5px 10px rgba(33,37,41,0.05);color: var(--color-dark-blue);">
            <h2 style="text-align: center; font-weight: 600;">Project proposal</h2>
            <div style="height: auto;margin-top: 30px;">
                <h6>Contactable email address:</h6><input class="form-control" type="email" name="email" minlength="5" maxlength="50" value="' . $project_proposal['email'] . '" disabled>
            </div>
            <div style="height: auto;margin-top: 30px;">
                <h6>Write your proposal:</h6><textarea class="form-control" style="width: 100%;height: 240px;" name="proposal" minlength="100" maxlength="800" disabled>'. $project_proposal['proposal'] .'</textarea>
            </div>
            <div style="height: auto;margin-top: 30px;">
                <h6>Your budget:</h6><input class="form-control" id="budget" type="text" name="budget" placeholder="Rs. _______" maxlength="12" value="Rs.'. number_format($project_proposal['budget']) .'" disabled><small class="form-text" style="padding-left: 10px;padding-top: 10px;" data-budget="12000">The least budget amount you can enter is 50% of the project budget</small>
            </div>
            <div class="d-flex justify-content-center" style="height: auto;margin-top: 30px;"><input id="submit-btn" class="form-control" type="submit" name="submit" value="Send" disabled/></div>
        </form>';
    } elseif ($ui_mode == 3) {
        echo '
            <h1 style="font-size: 32px;">Assignees</h1>
            <div id="assignees-holder" style="margin-top: 30px;" data-url="'. $link->path('proposals_api') .'">
                <div class="row" style="padding: 30px 20px;border-radius: 15px;border: 1px solid rgb(220,220,220);box-shadow: 0px 5px 10px rgba(0,0,0,0.1);margin-bottom: 20px;">
                    <div class="col">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"><img width="100" height="80" style="width: 50px;height: 50px;border-radius: 100px;border: 1px solid rgb(232,232,232) ;">
                                    <div class="d-flex flex-column justify-content-center" style="margin-left: 15px;">
                                        <h5 style="margin-bottom: 3px;font-weight: bold;">Name</h5>
                                        <h6>@username</h6>
                                    </div>
                                </div>
                                <div style="height: 100%;"><button class="btn btn-primary" type="button">Assign</button></div>
                            </div>
                            <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam neque eu sem feugiat, vel semper tellus aliquet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam ut fringilla lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis egestas convallis nisl, vitae accumsan velit placerat ac. Proin vitae orci nec est suscipit convallis sit amet semper mauris. Praesent euismod fermentum ante, et vestibulum massa placerat sed. Quisque pharetra odio non neque bibendum imperdiet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris eu vehicula risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus mollis, enim vitae vestibulum tempus, ex est molestie nisl, blandit rutrum lectus metus at orci. Morbi consequat rhoncus condimentum.</p>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 30px 20px;border-radius: 15px;border: 1px solid rgb(220,220,220);box-shadow: 0px 5px 10px rgba(0,0,0,0.1);margin-bottom: 20px;">
                    <div class="col">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"><img width="100" height="80" style="width: 50px;height: 50px;border-radius: 100px;border: 1px solid rgb(232,232,232) ;">
                                    <div class="d-flex flex-column justify-content-center" style="margin-left: 15px;">
                                        <h5 style="margin-bottom: 3px;font-weight: bold;">Name</h5>
                                        <h6>@username</h6>
                                    </div>
                                </div>
                                <div style="height: 100%;"><button class="btn btn-primary" type="button">Assign</button></div>
                            </div>
                            <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam neque eu sem feugiat, vel semper tellus aliquet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam ut fringilla lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis egestas convallis nisl, vitae accumsan velit placerat ac. Proin vitae orci nec est suscipit convallis sit amet semper mauris. Praesent euismod fermentum ante, et vestibulum massa placerat sed. Quisque pharetra odio non neque bibendum imperdiet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris eu vehicula risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus mollis, enim vitae vestibulum tempus, ex est molestie nisl, blandit rutrum lectus metus at orci. Morbi consequat rhoncus condimentum.</p>
                        </div>
                    </div>
                </div>
                <div class="row" style="padding: 30px 20px;border-radius: 15px;border: 1px solid rgb(220,220,220);box-shadow: 0px 5px 10px rgba(0,0,0,0.1);margin-bottom: 20px;">
                    <div class="col">
                        <div>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center"><img width="100" height="80" style="width: 50px;height: 50px;border-radius: 100px;border: 1px solid rgb(232,232,232) ;">
                                    <div class="d-flex flex-column justify-content-center" style="margin-left: 15px;">
                                        <h5 style="margin-bottom: 3px;font-weight: bold;">Name</h5>
                                        <h6>@username</h6>
                                    </div>
                                </div>
                                <div style="height: 100%;"><button class="btn btn-primary" type="button">Assign</button></div>
                            </div>
                            <p style="margin-top: 10px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi aliquam neque eu sem feugiat, vel semper tellus aliquet. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Etiam ut fringilla lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis egestas convallis nisl, vitae accumsan velit placerat ac. Proin vitae orci nec est suscipit convallis sit amet semper mauris. Praesent euismod fermentum ante, et vestibulum massa placerat sed. Quisque pharetra odio non neque bibendum imperdiet. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris eu vehicula risus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vivamus mollis, enim vitae vestibulum tempus, ex est molestie nisl, blandit rutrum lectus metus at orci. Morbi consequat rhoncus condimentum.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div><button id="see-more-btn" class="btn btn-primary d-block" type="button" style="margin: auto;padding: 10px 25px;">See more...</button></div>
        ';
    }
    ?>
</div>
<!-- Footer -->
<?php
include 'components/sections/footer.php';
echo footer_component();
?>
</body>
</html>
