<?php

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\service\Avaliador;

require 'vendor/autoload.php';

$leilao = new Leilao( descricao: 'Fiat 147 0km');

$maria = new Usuario(nome: 'Maria');
$joao = new Usuario(nome: 'João');

$leilao->recebeLance(new Lance($joao, valor: 2000));
$leilao->recebeLance(new Lance($maria, valor: 2500));


$leiloeiro = new Avaliador();
$leiloeiro->avalia($leilao);


$maiorValor = $leiloeiro->getmaiorValor();

$valorEsperado = 2500;

if($valorEsperado == 2500) {
    echo "TESTE OK";
}else {
    echo "TESTE FALHOU";
}

echo $maiorValor;