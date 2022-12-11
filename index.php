<html>
<head>
    <?php include_once 'components/essentials.php'; ?>
    <title>Home | Pixihire</title>
    <?php
      include_once 'components/links.php';
      $link = new Links();
    ?>
</head>
<body>
<!-- Navigation bar -->
<?php include 'components/navigation_bar.php' ?>
<!-- Hero -->
<section id="hero" style="width: 100%;height: 100%;z-index: 0;"><img class="d-none d-md-block" src=<?php echo $link->path('hero_bg'); ?> style="height: 100vh;position: absolute;z-index: 0;">
        <div class="justify-content-between align-items-xl-center" style="position: relative;display: inline-flex;width: 100%;height: 100vh;padding-right: 32px;padding-left: 32px;">
            <div id="Context" style="width: calc(35vw);margin-left: 53px;">
                <h1 class="fw-bold" style="color: rgb(4,36,68);font-size: 45px;font-weight: 600;">Want to get some task done?</h1>
                <p class="fw-bold" style="color: rgb(255,255,255);font-size: 22px;margin: 30px 0px;font-weight: 600;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis molestie mi vel erat blandit dignissim. Donec quis imperdiet eros, a facilisis ligula.&nbsp;<br></p>
                <div id="Button"><a class="text-uppercase fw-bold" href="#" style="color: rgb(255,255,255);text-decoration: none;background: #032e4d;padding: 10px 20px;border-radius: 5px;border-style: none;font-size: 17px;font-weight: 600;">get started&nbsp;<i class="fa-solid fa-arrow-right"></i></a></div>
            </div>
            <div class="d-xxl-flex justify-content-xxl-center align-items-xxl-center" id="Image" style="height: 100%;width: 50vw;"><img src=<?php echo $link->path('hero_img'); ?> style="width: 100%;"></div>
        </div>
    </section>
</body>
</html>
