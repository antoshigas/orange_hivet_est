<?php require_once 'main_html.php'; ?>

<body class="d-flex flex-column h-100">

    <?php require_once 'header.php'; ?>

    <!-- Begin page content -->
    <main class="flex-shrink-0">
        <div class="container">
            <h1 class="mt-5">Mitarbeiter hinzufügen</h1>
            <?php if(isset($this->data['error'])): echo '<h3 class="mt-5 text-danger">' . $this->data['error'] . '</h1>'; endif; ?>
            <form class="my-3" method="post" action="/workers/add" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label">Surname</label>
                    <input type="text" class="form-control" id="surname" name="surname" required>
                </div>
                <div class="mb-3">
                    <label for="position" class="form-label">Position</label>
                    <input type="text" class="form-control" id="position" name="position" required>
                </div>
                <div class="mb-3">
                    <label for="avatar" class="form-label">Bild</label>
                    <input type="file" class="form-control" accept="image/*" id="avatar" name="avatar" required>
                </div>
                <div class="mb-3">
                    <label for="about" class="form-label">Beschreibung</label>
                    <textarea class="form-control" id="about" rows="3" name="about" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </main>

    <?php require_once 'footer.php'; ?>

</body>

</html>