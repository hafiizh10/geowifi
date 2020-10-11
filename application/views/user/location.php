<?php echo $map['js'] ?>
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
            <?php if (validation_errors()) : ?>
                <div class="alert alert-danger" role="alert">
                    <?= validation_errors(); ?>
                </div>
            <?php endif; ?>

            <?= $this->session->flashdata('message'); ?>
            <div class="flash-data" data-flashdata="<?= $this->session->flashdata('flash'); ?>"></div>
            <?php if ($this->session->flashdata('flash')) : ?>
            <?php endif; ?>
            <div class="row m-t-25">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header">
                            Form <strong><?= $title ?></strong>
                        </div>
                        <div class="card-body card-block">
                            <?= form_open_multipart() ?>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Nama Tempat</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Tempat">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Alamat</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="address" name="address" placeholder="Alamat">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Username WiFi</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Username WiFi">
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Password WiFi</label>
                                </div>
                                <div class="col-12 col-md-9">
                                    <input type="text" class="form-control" id="password" name="password" placeholder="Password WiFi">
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="col-sm-3 control-label">Koordinat :</label>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input id="input-calendar" type="text" name="latitude" class="form-control" placeholder="latitude">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input id="input-calendar" type="text" name="longitude" class="form-control" placeholder="longitude">
                                        <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                </div>
                                <div class="col-12 col-md-9">
                                    <?php echo $map['html'] ?>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col col-md-3">
                                    <label for="text-input" class=" form-control-label">Foto Tempat</label>
                                </div>
                                <div class="col-sm-9">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="foto" name="foto">
                                        <label class="custom-file-label" for="foto">Choose file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fa fa-dot-circle-o"></i> Submit
                        </button>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->