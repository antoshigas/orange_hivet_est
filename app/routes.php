<?php

declare(strict_types=1);

use App\Application\Actions\Workers\ListWorkersAction;
use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Views\PhpRenderer;
use App\Model\Database;

return function (App $app) {

    $app->get('/', function (Request $request, Response $response, $args) {
        $renderer = new PhpRenderer('../templates/');
        return $renderer->render($response, "home.php", $args);
    });

    $app->get('/workers', function (Request $request, Response $response, $args) {
        $conn = new Database();
        $workers = $conn->select('SELECT * FROM workers');
        $renderer = new PhpRenderer('../templates/');
        $renderer->data = ['workers' => $workers];
        return $renderer->render($response, "workers.php", $args);
    });

    $app->get('/worker/{id}', function (Request $request, Response $response, $args) {
        $workerId = $args['id'];
        $conn = new Database();
        $worker = $conn->select('SELECT * FROM workers WHERE worker_id = ?', ["i", $workerId])[0];
        $renderer = new PhpRenderer('../templates/');
        return $renderer->render($response, "worker.php", $worker);
    });

    $app->get('/workers/add', function (Request $request, Response $response, $args) {
        $renderer = new PhpRenderer('../templates/');
        return $renderer->render($response, "add.php", $args);
    });

    $app->post('/workers/add', function (Request $request, Response $response, $args) {
        $params = $request->getParsedBody();
        $renderer = new PhpRenderer('../templates/');
        $conn = new Database();
        
        $randomImageName = (string) random_int(100, 100000);
        $target_dir = __DIR__ . '/../public/img/workers/';
        $target_file = $target_dir . $_FILES["avatar"]["name"];
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $target_file_random = $target_dir . $randomImageName . '.' . $imageFileType;
        $check = getimagesize($_FILES["avatar"]["tmp_name"]);
        // Check if image
        if ($check === false) {
            $renderer->data['error'] = "File is an image - " . $check["mime"] . ".";
            return $renderer->render($response, "add.php", $args);
        }
        // Check if file already exists
        if (file_exists($target_file_random)) {
            $renderer->data['error'] = "Sorry, file already exists";
            return $renderer->render($response, "add.php", $args);
        }
        // Check file size
        if ($_FILES["avatar"]["size"] > 500000) {
            $renderer->data['error'] = "Sorry, your file is too large";
            return $renderer->render($response, "add.php", $args);
        }
        // Allow certain file formats
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            $renderer->data['error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed";
            return $renderer->render($response, "add.php", $args);
        }
       
        if (!move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file_random)) {
            $renderer->data['error'] = "Sorry, there was an error uploading your file";
            return $renderer->render($response, "add.php", $args);
        }

        if(strlen($params['name']) && strlen($params['surname']) && strlen($params['position']) && strlen($params['about'])) {
            $params['img'] = str_replace(__DIR__ . "/../public/", "", $target_file_random);
            $conn->simpleStatementHandler("INSERT INTO workers (name, surname, position, about, img) VALUES(?, ?, ?, ?, ?)", ["sssss", array_values($params)]);
            return $response->withHeader('Location', '/workers')->withStatus(200);
        } else {
            $renderer->data['error'] = "Sorry, some input was empty";
            return $renderer->render($response, "add.php", $args);
        }
    });
};
