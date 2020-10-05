<?php
class ApiCest
{
    public function tryApiGetInvalidId(ApiTester $I)
    {
        $I->sendGET('/pessoas/2000');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiGetAll(ApiTester $I)
    {
        $I->sendGET('/pessoas');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(
            [
                "id" => 1,
                "nome" => "João da Silva",
                "data_nascimento" => "1978-09-13",
                "nome_mae" => "Aparecida Camila",
                "nome_pai" => "Cauê Danilo Drumond",
                "endereco" => "Travessa Monte Castelo",
                "cidade" => "Nova Iguaçu",
                "uf" => "RJ"
            ],
            [
                "id" => 2,
                "nome" => "Pedro Silvaaaa",
                "data_nascimento" => "1999-12-05",
                "nome_mae" => "Maria da Silva",
                "nome_pai" => "João da Silva",
                "endereco" => "Av. Paulista",
                "cidade" => "São Paulo",
                "uf" => "SP"
            ],
            [
                "id" => 3,
                "nome" => "Adriana Isabelly Benedita",
                "data_nascimento" => "1978-07-06",
                "nome_mae" => "Joana Letícia",
                "nome_pai" => "Sebastião Cardoso",
                "endereco" => "Quadra 300 Conjunto 49",
                "cidade" => "Recanto das Emas",
                "uf" => "DF"
            ],
            [
                "id" => 4,
                "nome" => "Lorenzo Jorge da Silva",
                "data_nascimento" => "1956-08-15",
                "nome_mae" => "Sophia Sebastiana Allana",
                "nome_pai" => "Leonardo Fernandes",
                "endereco" => "Travessa Dom Manoel de Paiva",
                "cidade" => "Ilhéus",
                "uf" => "BA"
            ],
            [
                "id" => 5,
                "nome" => "Isabella Raimunda Aragão",
                "data_nascimento" => "1980-05-10",
                "nome_mae" => "Elisa Sara Luiza",
                "nome_pai" => "Marcos Pedro Galvão",
                "endereco" => "Travessa K. Golveia",
                "cidade" => "Macapá",
                "uf" => "AP"
            ]
        );
    }

    public function tryApiGetPessoa(ApiTester $I)
    {
        $I->sendGET('/pessoas/1');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            "id" => 1,
            "nome" => "João da Silva",
            "data_nascimento" => "1978-09-13",
            "nome_mae" => "Aparecida Camila",
            "nome_pai" => "Cauê Danilo Drumond",
            "endereco" => "Travessa Monte Castelo",
            "cidade" => "Nova Iguaçu",
            "uf" => "RJ"
        ]);
    }

    public function tryApiPostPessoa(ApiTester $I)
    {
        $arr = [
        "nome" => "Cleber Costa",
        "data_nascimento" => "1999-09-13",
        "nome_mae" => "Camila Neves",
        "nome_pai" => "Danilo Drumond Costa",
        "endereco" => "Travessa Castelo",
        "cidade" => "São Paulo",
        "uf" => "SP"
        ];
        $I->sendPOST('/pessoas',$arr);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($arr);
    }

    public function tryApiPostInvalidParams(ApiTester $I)
    {
        $arr = [
        "nome" => "Cleber Costa",
        "data_nascimento" => "1999-09-13",
        "nome_mae" => "Camila Neves",
        "nome_pai" => "Danilo Drumond Costa",
        "endereco" => "Travessa Castelo",
        "cidade" => "São Paulo"
        ];
        $I->sendPOST('/pessoas',$arr);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiPutPessoa(ApiTester $I)
    {
        $arr = [
        "nome" => "Cléber Costa",
        "data_nascimento" => "1999-09-13",
        "nome_mae" => "Camila Neves",
        "nome_pai" => "Danilo Drumond Costa",
        "endereco" => "Travessa Castelo",
        "cidade" => "São Paulo",
        "uf" => "SP"
        ];
        $I->sendPUT('/pessoas/6',$arr);
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($arr);
    }

    public function tryApiPutInvalidParams(ApiTester $I)
    {
        $arr = [
        "nome" => "Cleber Costa",
        "data_nascimento" => "1999-09-13",
        "nome_mae" => "Camila Neves",
        "nome_pai" => "Danilo Drumond Costa",
        "endereco" => "Travessa Castelo",
        "cidade" => "São Paulo",
        ];
        $I->sendPUT('/pessoas/1',$arr);
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryApiDeletePessoa(ApiTester $I)
    {
        $I->sendDELETE('/pessoas/6');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }

    public function tryApiDeleteInvalidParams(ApiTester $I)
    {
        $I->sendDELETE('/pessoas/6');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }
}
