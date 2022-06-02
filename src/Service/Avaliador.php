<?php

namespace Leilao\Service;

use Leilao\Model\Leilao;

class Avaliador
{
  private $maiorLance;


  public function __construct()
  {
    $this->maiorLance = -INF;
  }

  public function avalia(Leilao $leilao): void
  {
    foreach ($leilao->getLances() as $lance) {
      if ($lance->getValor() > $this->maiorLance){
        $this->maiorLance = $lance->getValor();
      }
    }
  }

  public function getMaiorLance(): float
  {
    return $this->maiorLance;
  }
}