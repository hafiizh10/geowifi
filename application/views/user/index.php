<!-- MAIN CONTENT-->
<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="au-card recent-report">
                        <div class="au-card-inner">
                            <h3 class="title-2 m-b-10"><?= $title ?></h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="<?= base_url('assets/img/profile/' . $user['image']); ?>" width="100px" height="100px" />
                                </div>
                                <div class="col-md-6">
                                    Nama : <strong><?= $user['name']; ?></strong><br>
                                    Username : <strong><?= $user['username']; ?></strong><br>
                                    Jabatan : <strong><?= $user['jabatan']; ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END MAIN CONTENT-->
<!-- END PAGE CONTAINER-->