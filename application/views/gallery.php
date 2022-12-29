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
    <section class="inner_banner">
        <div class="container">
            <h1>GALLERY</h1>
            <ul class="breadcrum">
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li>Gallery</li>
            </ul>
        </div>
    </section>
    <section class="gallery">
        <div class="container">
            <div class="tabs">
                <ul class="tab-links">
                    <li class="active"><a href="#tab1">All</a></li>
                    <?php
                    $i = 1;
                    if ($cat != '') {
                        foreach ($cat as $row) {
                            $i = $i + 1;
                    ?>
                            <li><a href="#tab<?= $i  ?>"><?= $row['category'] ?></a></li>
                    <?php
                        }
                    }
                    ?>
                </ul>

                <div class="gallery-tab-content">
                    <div id="tab1" class="tab active">
                        <?php
                        if (!empty($gallery)) {
                            foreach ($gallery as $imgs) {
                        ?>
                                <img src="<?= base_url() ?>/uploads/gallery/<?= $imgs['img']; ?>" />
                        <?php
                            }
                        }
                        ?>
                    </div>
                    <?php
                    $i = 1;
                    if ($cat != '') {
                        foreach ($cat as $row) {
                            $i = $i + 1;
                    ?>
                            <div id="tab<?= $i ?>" class="tab">
                                <?php
                                $img  =   getRowById('tbl_gallery', 'category',  $row['cid']);
                                if ($img != '') {
                                    foreach ($img as $image) {
                                ?>

                                        <img src="<?= base_url() ?>/uploads/gallery/<?= $image['img']; ?>" />

                                <?php
                                    }
                                }
                                ?>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>




    <?php include 'include/footer.php' ?>

    <?php include 'include/footerlink.php' ?>
    <script>
        jQuery(document).ready(function() {
            jQuery('.tabs .tab-links a').on('click', function(e) {
                var currentAttrValue = jQuery(this).attr('href');

                // Show/Hide Tabs
                jQuery('.tabs ' + currentAttrValue).siblings().slideUp(400);
                jQuery('.tabs ' + currentAttrValue).delay(400).slideDown(400);

                // Change/remove current tab to active
                jQuery(this).parent('li').addClass('active').siblings().removeClass('active');

                jQuery(this).parent('.tab').addClass('active').siblings().removeClass('active');


                e.preventDefault();
            });
        });


        document.getElementById('video-player').controls = false
    </script>
</body>

</html>