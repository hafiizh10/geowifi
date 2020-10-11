<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="overview-wrap">
                        <h2 class="title-1"><?= $title ?></h2>
                    </div>
                </div>
            </div>
            <div class="row m-t-25">
                <div class="table-responsive table--no-card m-b-30">
                    <table class="table table-borderless table-striped table-earning">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Alamat</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($wifilist as $wl) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $wl['name']; ?></td>
                                    <td><?= $wl['username']; ?></td>
                                    <td><?= $wl['password']; ?></td>
                                    <td><?= $wl['address']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>user/edit_loc/<?= $wl['id'] ?>" class="badge badge-pill badge-success">edit</a>
                                        <a href="<?= base_url(); ?>user/hapus_loc/<?= $wl['id'] ?>" class="badge badge-pill badge-danger tombol-hapus">delete</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php if (validation_errors()) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?= validation_errors(); ?>
                    </div>
                <?php endif; ?>

                <?= $this->session->flashdata('message'); ?>
                <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
                <?php if ($this->session->flashdata('flash')) : ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->