<?php require_once 'main_html.php'; ?>

<body class="d-flex flex-column h-100">

    <?php require_once 'header.php'; ?>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Mitarbeiter</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 my-3">
                <?php foreach ($this->data['workers'] as $worker) :
                    echo '<div class="col">
                            <div class="card h-100 cursor-pointer" id="' . $worker['worker_id'] .'">
                                <img src="' . $worker['img'] . '" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">' . $worker['name'] . ' ' . $worker['surname'] . '</h5>
                                    <p class="card-text">' . $worker['position'] . '</p>
                                </div>
                            </div>
                        </div>';
                endforeach; ?>
            </div>
            <a class="btn btn-secondary my-2" href="workers/add">+</a>
        </div>
    </main>



    <?php require_once 'footer.php'; ?>

    <script src="js/card.js"></script>

</body>

</html>