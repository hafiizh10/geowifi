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
            <div class="row m-t-25">
                <div class="col-lg">
                    <div class="card">
                        <div class="card-header">
                            <strong><?= $title ?></strong>
                        </div>
                        <div class="card-body card-block">
                            <div class="col-md-10">
                                <div class="map-view"><?php echo $map['html'] ?></div>
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