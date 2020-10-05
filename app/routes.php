<?php
declare(strict_types=1);

use App\Application\Actions\User\ViewUserAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;
use App\Controllers\PessoaController;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->group('/pessoas', function (Group $group) {
        $group->get('', PessoaController::class . ':getAll');
        $group->get('/{id}', PessoaController::class . ":get");
        $group->post('', PessoaController::class . ":create");
        $group->put('/{id}', PessoaController::class . ":update");
        $group->delete('/{id}', PessoaController::class . ":delete");
    });
};