<?php echo $map['js'] ?>
<ul class="navbar nav justify-content-end">
    <li class="nav-item">
        <a href="<?= base_url('auth') ?>"><button class="btn btn-primary btn-lg">Login</button></a>
    </li>
</ul>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="col-md">
                    <div class="login-content">
                        <div class="login-logo">
                            <h2><?= $title ?></h2>
                        </div>
                        <div class="login-form">
                            <div class="map-view"><?php echo $map['html'] ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <ul class="navbar nav justify-content-end">
        <li class="nav-item">
            Web ini dibuat untuk pembelajaran oleh Zoelva. 08 Oktober 2020
        </li>
    </ul>