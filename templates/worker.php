<?php require_once 'main_html.php'; ?>

<body class="d-flex flex-column h-100">

    <?php require_once 'header.php'; ?>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <div class="row my-5 justify-content-center">
                <div class="col-12 col-md-6">
                        <div class="card h-100">
                            <img src="<?=$img?>" class="card-img-top" alt="Avatar">
                            <div class="card-body">
                                <h5 class="card-title"><?=$name?> <?=$surname?></h5>
                                <p class="card-text"><?=$about?></p>
                                <div class="card-footer">
                                    <small class="text-muted"><?=$position?></small>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once 'footer.php'; ?>

</body>

</html>