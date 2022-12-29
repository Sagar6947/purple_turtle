<!DOCTYPE html>
<html lang="en">
<?php $this->load->view('admin/template/header_link'); ?>

<body class="sidebar-fixed">
    <div id="app">
        <?php $this->load->view('admin/template/header'); ?>

        <?php $this->load->view('admin/template/sidebar'); ?>
        <!--START PAGE HEADER -->
        <header class="page-header">
            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h1><?= $title ?></h1>
                </div>

                <ul class="actions top-right">
                    <li>
                        <button onclick="history.back()" class="btn btn-dark"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>

                    </li>
                </ul>

            </div>
        </header>

        <section class="page-content container-fluid">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <?php foreach ($productInfo as $row) {
                                // print_r($row);
                            ?>

                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class="row">

                                        <div class="col-md-12 col-lg-12 col-xl-12">
                                            <div class="">
                                                <input class="form-control" type="hidden" name="cid" value="<?= $row['cid']; ?>">

                                                <div class="row">
                                                    <div class="form-group col-md-6">
                                                        <label class="">Video Cateogry Name</label>
                                                        <select class="form-control" name="category_id" id="category_id">
                                                            <option>Video Category Category</option>
                                                            <?php foreach ($category as $rows) {
                                                            ?>
                                                                <option value="<?= $rows['category_id']; ?>" <?= (($rows['category_id'] == $row['category_id']) ? 'selected' : '') ?>><?= $rows['cat_name']; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-6">
                                                        <label class="">video Category Name</label>
                                                        <select class="form-control" name="level_id" id="">
                                                            <option disabled>Select Level</option>
                                                            <option value="1" <?= (($row['level_id'] == '1') ? 'selected' : '') ?>>Level 1</option>
                                                            <option value="2" <?= (($row['level_id'] == '2') ? 'selected' : '') ?>>level 2</option>
                                                            <option value="3" <?= (($row['level_id'] == '3') ? 'selected' : '') ?>>Level 3</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-sm-12">
                                                    <label class="">Select New Thumbnail </label>
                                                    <div class="pos-relative">
                                                        <input class="form-control pd-r-80" type="file" name="thumbnail_temp">
                                                        <input class="form-control pd-r-80" type="hidden" name="thumbnail" value="<?= $row['thumbnail'] ?>">
                                                        <img src="<?= base_url() ?>uploads/class_video/<?= $row['thumbnail'] ?>" width="100px" />
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label class="">Title</label>
                                                    <input class="form-control" type="text" name="title" value="<?= $row['title']; ?>">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label class="">Video Link</label>
                                                    <input class="form-control" type="text" name="video_link" value="<?= $row['video_link']; ?>">
                                                </div>








                                                <button type="submit" class="btn btn-light">Update</button>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
        </section>

    </div>
    <!-- container-scroller -->
    <?php $this->load->view('admin/template/footer_link'); ?>

</body>

</html>