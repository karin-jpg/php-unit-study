<?php

namespace Leilao\testes\Service;

use PHPUnit\Framework\TestCase;
use Leilao\Model\Lance;
use Leilao\Model\Leilao;
use Leilao\Model\Usuario;
use Leilao\Service\Avaliador;

require 'vendor/autoload.php';

class AvaliadorTest extends TestCase
{
  public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemCrescente(): void 
  {
    $leilao = new Leilao('Carro novo');

    $user1 = new Usuario("João");
    $user2 = new Usuario("Maria");

    $leilao->recebeLance(new Lance($user1, 2000));
    $leilao->recebeLance(new Lance($user2, 2500));

    $avaliador = new Avaliador();

    $avaliador->avalia($leilao);

    $maiorValor = $avaliador->getMaiorLance();

    self::assertEquals(2500, $maiorValor);
  }
  
  public function testAvaliadorDeveEncontrarOMaiorValorDeLancesEmOrdemDecrescente(): void {

    $leilao = new Leilao('Carro novo');

    $user1 = new Usuario("João");
    $user2 = new Usuario("Maria");

    $leilao->recebeLance(new Lance($user2, 2500));
    $leilao->recebeLance(new Lance($user1, 2000));

    $avaliador = new Avaliador();

    $avaliador->avalia($leilao);

    $maiorValor = $avaliador->getMaiorLance();

    self::assertEquals(2500, $maiorValor);
  }  
}