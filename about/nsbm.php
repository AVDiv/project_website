<?php
    session_start();
    // Imports
    include_once dirname(__DIR__).'/components/scripts/links.php';
    include_once dirname(__DIR__).'/components/scripts/page_processing.php';
    include_once dirname(__DIR__).'/backend/account.php';
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
    }
?>
<html lang="en">
<head>
    <?php include_once dirname(__DIR__).'/components/scripts/essentials.php'; ?>
    <title>Our University | Pixihire</title>
    <link rel="stylesheet" href="<?php echo $link->path('nsbm_css'); ?>">
</head>
<body>
    <!-- Navigation bar -->
    <?php
        include dirname(__DIR__).'/components/sections/navigation_bar.php';
        echo navbar_component($pp->logged_in, ($pp->logged_in?$controller->get_user_details($pp->user_id)["profile_pic"]:""), true);
    ?>
    <header class="masthead d-flex justify-content-center align-items-center" style="background-image:url('<?php echo $link->path('nsbm_img'); ?>'); background-size: cover; background-repeat: no-repeat;height: 100vh;">
        <h1 style="text-align: center;color: var(--color-white); font-size: 64px;font-weight: 600;">About NSBM</h1>
    </header>
    <div class="container">
        <div class="d-flex">
            <div class="post-meta" style="font-size: 18px;font-weight: normal;">
                <h2 class="post-title">Overview of NSBM</h2>
                <p>
                    NSBM Green University, the nation’s premier degree-awarding institute, is the first of its kind in South Asia. It is a government-owned self-financed institute that operates under the purview of the Ministry of Education. As a leading educational centre in the country, NSBM has evolved into becoming a highly responsible higher education institute that offers unique opportunities and holistic education on par with international standards while promoting sustainable living.
                </p>
                <p>
                    NSBM offers a plethora of undergraduate and postgraduate degree programmes under five faculties: Business, Computing, Engineering, Science and Postgraduate &amp; Professional Advancement. These study programmes at NSBM are either its own programmes recognised by the University Grants Commission and the Ministry of Higher Education or world-class international programmes conducted in affiliation with top-ranked foreign universities such as University of Plymouth, UK, and Victoria University, Australia.
                </p>
                <p>
                    Focused on producing competent professionals and innovative entrepreneurs for the increasingly globalising world, NSBM nurtures its graduates to become productive citizens of society with their specialisation ranging in study fields such as Business, Management, Computing, IT, Engineering, Science, Psychology, Nursing, Interior design, Quantity Surveying, Law and Multimedia.
                </p>
                <p>
                    Inspired by the vision of being Sri Lanka’s best-performing graduate school and being recognised internationally, NSBM currently achieves approximately 3000 new enrollments per year and houses above 11,000 students reading over 50 degree programmes under 4 faculties. Moreover, over the years, NSBM Green University has gifted the nation with 14,000+ graduates and has proved its global presence with an alumni network spread all across the world.
                </p>
                <p>
                    Nestling on a 40-acre land amidst the greenery and serenity in Pitipana, Homagama, NSBM Green University, is an ultra-modern university complex constructed with state-of-the-art facilities and amenities that provides the perfect setting for high-quality teaching, learning and research.
                </p>
                <p>
                    NSBM Website: <a href="https://www.nsbm.ac.lk/" target="_blank">https://www.nsbm.ac.lk/</a>
                </p>
            </div>
            <div class="post-meta">
                <div class="d-flex image-container">
                    <img src="<?php echo $link->path('nsbm_img2'); ?>" loading="lazy" alt="NSBM">
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <?php
    include dirname(__DIR__).'/components/sections/footer.php';
    echo footer_component();
    ?>
</body>

</html>