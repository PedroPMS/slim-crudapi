<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Pessoa;
use Exception;

class PessoaController
{
    private static $required = ['nome','data_nascimento','nome_mae','nome_pai','endereco','cidade','uf'];

    public static function getAll (Request $request, Response $response)
    {
        $pessoas = Pessoa::get();
        $payload = json_encode($pessoas, (JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE));
        $response->getBody()->write($payload);
        return $response
                ->withHeader("Content-Type", "application/json;charset=utf-8");
    }

    public static function get (Request $request, Response $response, $args)
    {
        try{
            $pessoas = Pessoa::findOrFail($args['id']);
            $payload = json_encode($pessoas, (JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE));
            $status = 200;
        }catch(Exception $e) {
            $payload = json_encode(['message' => 'Pessoa não encontrada!'], (JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE));
            $status = 400;
        }

        $response->getBody()->write($payload);
        return $response
                 ->withHeader("Content-Type", "application/json;charset=utf-8")
                 ->withStatus($status);
    }

    public static function create (Request $request, Response $response)
    {
        try{
            self::requestHaveAllParams(self::$required, $request->getParsedBody());
            $data = $request->getParsedBody();
            $pessoa = Pessoa::create($data);
            $payload = json_encode($pessoa, (JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE));
            $status = 200;
        }catch(Exception $e) {
            $payload = json_encode(['message' => 'Erro ao inserir a pessoa!'], (JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE));
            $status = 400;
        }

        $response->getBody()->write($payload);
        return $response
                 ->withHeader("Content-Type", "application/json;charset=utf-8")
                 ->withStatus($status);
    }

    public static function update (Request $request, Response $response, $args)
    {
        try{
            parse_str($request->getBody()->getContents(), $data);
            self::requestHaveAllParams(self::$required, $data);
            $pessoa = Pessoa::findOrFail($args['id']);
            $pessoa->update($data);
            $payload = json_encode($data, (JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE));
            $status = 200;
        }catch(Exception $e){
            $payload = json_encode(['message' => 'Erro ao atualizar a pessoa!'], (JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE));
            $status = 400;
        }
        
        $response->getBody()->write($payload);
        return $response
                 ->withHeader("Content-Type", "application/json;charset=utf-8")
                 ->withStatus($status);
    }

    public static function delete (Request $request, Response $response, $args)
    {
        try{
            $pessoa = Pessoa::findOrFail($args['id']);
            $pessoa->delete();
            $payload = json_encode($pessoa, (JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE));
            $status = 200;
        }catch(Exception $e){
            $payload = json_encode(['message' => 'Erro ao deletar a pessoa!'], (JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT |  JSON_UNESCAPED_UNICODE));
            $status = 400;
        }
        
        $response->getBody()->write($payload);
        return $response
                 ->withHeader("Content-Type", "application/json;charset=utf-8")
                 ->withStatus($status);
    }

    public static function requestHaveAllParams(array $keys, array $arr) {
        if(!array_diff_key(array_flip($keys), $arr)){
            return true;
        }else{
            throw new Exception("Todos os parâmetros são necessários!");
        }
    }
}