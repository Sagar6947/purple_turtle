<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <?php include 'include/headerlink.php' ?>
</head>

<body>

    <?php include 'include/header.php' ?>


    <section class="inner_banner ani_wave">
        <div class="container">
            <h1>all <span>Videos</span></h1>
            <ul class="breadcrum">
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li>Animated Videos</li>
            </ul>
        </div>
    </section>

    <section class="team_sec team_sec_4 padding-bottom">
        <div class="container">
            <div class="inner vid-grid">

                <?php
                if (!empty($all_vid)) {
                    foreach ($all_vid as $row) {
                ?>
                        <div class="item">
                            <figure>
                                <video width="300" height="200" controls
                                 poster="<?= base_url(); ?>uploads/video/<?= $row['thumbnail']; ?>">
                                    <source src="<?= str_replace(
                                                        "https://www.dropbox.com/s/",
                                                        "https://dl.dropboxusercontent.com/s/",
                                                        $row['video_link']
                                                    ) ?>" frameborder="0" allow="accelerometer; encrypted-media; gyroscope; picture-in-picture" allowfullscreen allow="autoplay">
                                </video>
                            </figure>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>





    <?php include 'include/footer.php' ?>

    <?php include 'include/footerlink.php' ?>
    <script>
        document.getElementById('video-player').controls = false
    </script>
</body>

</html>