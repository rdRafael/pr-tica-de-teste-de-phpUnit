<?php 

namespace Alura\Leilao\tests\Service;

use Alura\Leilao\Model\Lance;
use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Usuario;
use Alura\Leilao\service\Avaliador;
use PgSql\Lob;
use PHPUnit\Framework\TestCase;

class AvaliadorTest extends TestCase
{
    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemCrescente()
    {
        $leilao = new Leilao(descricao: 'Fiat 147 0km');

        $maria = new Usuario(nome: 'Maria');
        $joao = new Usuario(nome: 'João');

        $leilao->recebeLance(new Lance($joao, valor: 2000));
        $leilao->recebeLance(new Lance($maria, valor: 2500));


        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);


        $maiorValor = $leiloeiro->getmaiorValor();

        // $valorEsperado = 2500;

        // if ($valorEsperado == 2500) {
        //     echo "TESTE OK";
        // } else {
        //     echo "TESTE FALHOU";
        // }

        // echo $maiorValor;

        // Assert - Then
        $this->assertEquals (2500, $maiorValor );
        // self::assertEquals(2500, $maiorValor);
    }

    public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemDescrescente()
    {
        $leilao = new Leilao(descricao: 'Fiat 147 0km');

        $maria = new Usuario(nome: 'Maria');
        $joao = new Usuario(nome: 'João');

        $leilao->recebeLance(new Lance($joao, valor: 2500));
        $leilao->recebeLance(new Lance($maria, valor: 2000));


        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);


        $menorValor = $leiloeiro->getMenorValor();

        // $valorEsperado = 2500;

        // if ($valorEsperado == 2500) {
        //     echo "TESTE OK";
        // } else {
        //     echo "TESTE FALHOU";
        // }

        // echo $maiorValor;

        // Assert - Then
        self::assertEquals(2000, $menorValor);
        // self::assertEquals(2500, $maiorValor);
    }

    public function testAvaliadorDeveBuscar3MaioresValores()
    {
        $leilao = new Leilao(descricao: 'Fiat 147 0km');
        $joao = new Usuario(nome: 'Joao');
        $maria = new Usuario(nome: 'Maria');
        $ana = new Usuario(nome: 'Ana');
        $jorge = new Usuario(nome: 'Jorge');

        $leilao->recebeLance(new Lance($ana, valor:1500));
        $leilao->recebeLance(new Lance($joao, valor: 1000));
        $leilao->recebeLance(new Lance($maria, valor:2000));
        $leilao->recebeLance(new Lance($jorge, valor:1700));

        $leiloeiro = new Avaliador();
        $leiloeiro->avalia($leilao);

        $maiores = $leiloeiro->getMaioresLances();

        static::assertCount( 3, $maiores);
        static::assertEquals(2000, $maiores[0]->getValor());
        static::assertEquals(1700, $maiores[1]->getValor());
        static::assertEquals(1500, $maiores[2]->getValor());

    }
}