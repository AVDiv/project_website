<html>
<head>
    <?php include_once 'components/essentials.php'; ?>
    <title>Home | Pixihire</title>
    <?php
      include_once 'components/links.php';
      $link = new Links();
      echo '<link rel="stylesheet" href="'. $link->path('home_css') .'">';
    ?>
</head>
<body>
<!-- Navigation bar -->
<?php include 'components/navigation_bar.php' ?>
<!-- Hero -->
<section id="hero" style="width: 100%;height: 100%;z-index: 0;"><img src=<?php echo $link->path('hero_bg'); ?>>
        <div class="justify-content-between align-items-xl-center">
            <div id="Context">
                <h1 class="fw-bold" style="color: var(--color-dark-blue);font-size: 45px;font-weight: 600;">Want to get some task done?</h1>
                <p class="fw-bold" style="color: var(--color-white);font-size: 22px;margin: 30px 0px;font-weight: 600;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis molestie mi vel erat blandit dignissim. Donec quis imperdiet eros, a facilisis ligula.&nbsp;<br></p>
                <div id="Button"><a class="text-uppercase fw-bold" href="#" style="color: var(--color-white);text-decoration: none;background: var(--color-dark-blue);padding: 10px 20px;border-radius: 5px;border-style: none;font-size: 17px;font-weight: 600;">get started&nbsp;<i class="fa-solid fa-arrow-right"></i></a></div>
            </div>
            <div class="d-xxl-flex justify-content-xxl-center align-items-xxl-center" id="Image"><img src=<?php echo $link->path('hero_img'); ?> style="width: 100%;"></div>
        </div>
    </section>
</body>
</html>
