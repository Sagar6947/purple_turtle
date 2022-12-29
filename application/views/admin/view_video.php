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
                        <a href="<?= base_url('admin_Dashboard/add_video'); ?>" class="btn btn-primary">
                            Add Video</a>

                    </li>
                </ul>

            </div>
        </header>
        <section class="page-content container-fluid">
            <div class="row">
                <div class="col-md-12   mb-3 ">
                    <?php if ($msg = $this->session->flashdata('msg')) :
                        $msg_class = $this->session->flashdata('msg_class') ?>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="alert  <?= $msg_class; ?>"><?= $msg; ?></div>
                            </div>
                        </div>
                    <?php
                        $this->session->unset_userdata('msg');
                    endif; ?>
                    <div class="col-lg-12 col-xl-12">
                        <div class="card">
                            <div class="card-header">

                                <ul class="actions top-right">
                                    <li>
                                        <a href="javascript:void(0)" data-q-action="card-expand"><i class="icon dripicons-expand-2"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="bs4-table" class="table table-striped table-bordered" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>S No</th>
                                                <th>Category</th>

                                                <th>Title</th>
                                                <th>Thumbnail</th>
                                                <th>Video Link</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            foreach ($video as $fetchrow) {
                                                $cat = getRowById('tbl_category', 'category_id', $fetchrow['category_id']);

                                            ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td>
                                                        <?= $cat[0]['cat_name']; ?>
                                                    </td>

                                                    <td>
                                                        <?= $fetchrow['title']; ?>
                                                    </td>
                                                    <td><img src="<?= base_url() ?>/uploads/video/<?= $fetchrow['thumbnail']; ?>" width="100px"></td>

                                                    <td><?php echo wordwrap($fetchrow['video_link'], 10, '<br>'); ?></td>
                                                    <td> <a href="<?php echo base_url() . 'admin_Dashboard/edit_video/' . $fetchrow['product_id']; ?>" class="btn btn-success edit"><i class="fas fa-pencil-alt"></i></a>

                                                        <a href="<?php echo base_url() . 'admin_Dashboard/deletevideo/' . $fetchrow['product_id']; ?>" class="btn btn-danger delete"><i class="fas fa-trash-alt"></i></a>

                                                    </td>

                                                </tr>

                                            <?php
                                                $i++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
        </section>
    </div>
    <?php $this->load->view('admin/template/footer_link'); ?>

</body>

</html>