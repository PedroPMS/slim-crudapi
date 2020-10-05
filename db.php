<?php
use DI\ContainerBuilder;

if (PHP_SAPI != 'cli'){
    exit();
}

require __DIR__ . '/vendor/autoload.php';

$containerBuilder = new ContainerBuilder();
$settings = require __DIR__ . '/app/settings.php';
$settings($containerBuilder);
$dependencies = require __DIR__ . '/app/dependencies.php';
$dependencies($containerBuilder);

$container = $containerBuilder->build();

$db = $container->get('db');

$schema = $db->schema();
$tabela = 'pessoas';

$schema->dropIfExists($tabela);

$schema->create($tabela, function($table){
    $table->increments('id')->nullable(false);
    $table->string('nome',50)->nullable(false);
    $table->date('data_nascimento')->nullable(false);
    $table->string('nome_mae',50)->nullable(false);
    $table->string('nome_pai',50)->nullable(false);
    $table->string('endereco',100)->nullable(false);
    $table->string('cidade',50)->nullable(false);
    $table->char('uf',2)->nullable(false);
});

//Inserts

$db->table($tabela)->insert([
    'nome' => 'João da Silva',
    'data_nascimento' => '1978-09-13',
    'nome_mae' => 'Aparecida Camila',
    'nome_pai' => 'Cauê Danilo Drumond',
    'endereco' => 'Travessa Monte Castelo',
    'cidade' => 'Nova Iguaçu',
    'uf' => 'RJ',
]);
$db->table($tabela)->insert([
    'nome' => 'Lara Fabiana Andreia Porto',
    'data_nascimento' => '1970-04-18',
    'nome_mae' => 'Betina Mirella',
    'nome_pai' => 'Diogo Gomes',
    'endereco' => 'Avenida Brasil 657',
    'cidade' => 'Lençóis Paulista',
    'uf' => 'SP',
]);
$db->table($tabela)->insert([
    'nome' => 'Adriana Isabelly Benedita',
    'data_nascimento' => '1978-07-06',
    'nome_mae' => 'Joana Letícia',
    'nome_pai' => 'Sebastião Cardoso',
    'endereco' => 'Quadra 300 Conjunto 49',
    'cidade' => 'Recanto das Emas',
    'uf' => 'DF',
]);
$db->table($tabela)->insert([
    'nome' => 'Lorenzo Jorge da Silva',
    'data_nascimento' => '1956-08-15',
    'nome_mae' => 'Sophia Sebastiana Allana',
    'nome_pai' => 'Leonardo Fernandes',
    'endereco' => 'Travessa Dom Manoel de Paiva',
    'cidade' => 'Ilhéus',
    'uf' => 'BA',
]);
$db->table($tabela)->insert([
    'nome' => 'Isabella Raimunda Aragão',
    'data_nascimento' => '1980-05-10',
    'nome_mae' => 'Elisa Sara Luiza',
    'nome_pai' => 'Marcos Pedro Galvão',
    'endereco' => 'Travessa K. Golveia',
    'cidade' => 'Macapá',
    'uf' => 'AP',
]);