<?php

namespace Leilao\Service;

use Leilao\Model\Leilao;

class Avaliador
{
  private $maiorLance;

  public function avalia(Leilao $leilao): void
  {
    $lances = $leilao->getLances();
    $ultimoLance = $lances[count($lances) - 1];
    $this->maiorLance = $ultimoLance->getValor();
  }

  public function getMaiorLance(): float
  {
    return $this->maiorLance;
  }
}