<!DOCTYPE html>
<html lang="en">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Blogs - Purple Turtle</title>
    <?php include 'include/headerlink.php' ?>
</head>

<body>

    <?php include 'include/header.php' ?>



    <section class="blog_sec blog_inn padding-bottom" id="overlay-4">
        <div class="container">
            <h2 class="global_title" style="line-height: 30px !important;">All Events</h2>
            <div class="inner">
                <div class="row row-eq-height row_gap" style="margin: auto;">
                    <?php
                    $i = 0;
                    if (!empty($event)) {
                        foreach ($event as $row) {
                            $i = $i + 1;
                    ?>
                            <div class="col-lg-4 col-sm-6 mb-2">
                                <div class="blog_info recycling">
                                    <div data-aos="zoom-in" data-aos-duration="1200">
                                        <figure class="blog_img"><a href="<?php echo base_url() . 'eventdetails/' . $row['id'] . "/" . url_title($row['name']); ?>"><img src="<?= base_url(); ?>uploads/blogs/<?= $row['image']; ?>" alt="<?= $row['name']; ?>"></a>
                                        </figure>
                                    </div>
                                    <div class="detail">

                                        <?php
                                        $cate =   getSingleRowById('tbl_blog_category', array('category_id' => $row['category_id']));

                                        if ($cate != "") {
                                        ?>
                                            <span class="blog-type <?= $cate['cat_name'] ?>"><?= $cate['cat_name'] ?></span>
                                        <?php
                                        }
                                        ?>


                                        <h3><a href="<?php echo base_url() . 'eventdetails/' . $row['id'] . "/" . url_title($row['name']); ?>"><?= $row['name']; ?></a></h3>
                                        <p class="text-length"><?= $row['intro']; ?></p>
                                    </div>
                                    <div class="link">
                                        <a href="<?php echo base_url() . 'eventdetails/' . $row['id'] . "/" . url_title($row['name']); ?>">Read More</a>
                                    </div>

                                </div>
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
        document.getElementById('video-player').controls = false
    </script>
</body>

</html>