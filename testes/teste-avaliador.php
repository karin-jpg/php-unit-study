<?php

use Leilao\Model\Lance;
use Leilao\Model\Leilao;
use Leilao\Model\Usuario;
use Leilao\Service\Avaliador;

require 'vendor/autoload.php';

$leilao = new Leilao('Carro novo');

$user1 = new Usuario("João");
$user2 = new Usuario("Maria");
$user3 = new Usuario("José");

$leilao->recebeLance(new Lance($user1, 2000));
$leilao->recebeLance(new Lance($user2, 2500));
$leilao->recebeLance(new Lance($user3, 1780));

$avaliador = new Avaliador();

$avaliador->avalia($leilao);

$maiorValor = $avaliador->getMaiorLance();