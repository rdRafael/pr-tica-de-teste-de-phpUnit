<?php

namespace Alura\Leilao\service;

use Alura\Leilao\Model\Leilao;
use Alura\Leilao\Model\Lance;

class Avaliador
{
    private $maiorValor = -INF;
    private $menorValor = INF;
    private $maioresLances;

    public function avalia(Leilao $leilao): void
    {
        //Pegando o último valor!!!!!!!!!!!!!
        // $lances = $leilao->getLances();
        // $ultimoLance = $lances[count($lances) - 1 ];
        // $this->maiorValor = $ultimoLance->getValor();

        //proucurando o maior valor!!!!!!!!!1
        foreach($leilao->getLances() as $lance) {
            if ($lance->getValor() > $this->getMaiorValor()){
                $this->maiorValor = $lance->getValor();
             } else if($lance->getValor() < $this->menorValor ){
                $this->menorValor = $lance->getValor();
             }
        }

        $lances = $leilao->getLances();
        usort($lances, function(Lance $lance1, Lance $lance2){
            return $lance2->getValor() - $lance1->getValor();
        });
        $this->maioresLances = array_slice($lances, offset: 0, length: 3);

    }

    public function getMaiorValor(): float
    {
        return $this->maiorValor;
    }

    public function getMenorValor(): float
    {
        return $this->menorValor;
    }

    public function getMaioresLances(): array
    {
        return $this->maioresLances;
    }
}