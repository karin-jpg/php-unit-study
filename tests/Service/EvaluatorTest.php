<?php

namespace Auction\tests\Service;

use PHPUnit\Framework\TestCase;
use Auction\Model\Bid;
use Auction\Model\Auction;
use Auction\Model\User;
use Auction\Service\Evaluator;

require 'vendor/autoload.php';

class EvaluatorTest extends TestCase
{
  public function testEvaluatorMustFindTheHighestBidInAscendingOrder(): void 
  {
    $Auction = new Auction('New car');

    $user1 = new User("João");
    $user2 = new User("Maria");

    $Auction->recebeBid(new Bid($user1, 2000));
    $Auction->recebeBid(new Bid($user2, 2500));

    $Evaluator = new Evaluator();

    $Evaluator->evaluates($Auction);

    $highestBid = $Evaluator->getHighestBid();

    self::assertEquals(2500, $highestBid);
  }
  
  public function testEvaluatorMustFindTheHighestBidInDescendingOrder(): void {

    $Auction = new Auction('New car');

    $user1 = new User("João");
    $user2 = new User("Maria");

    $Auction->recebeBid(new Bid($user2, 2500));
    $Auction->recebeBid(new Bid($user1, 2000));

    $Evaluator = new Evaluator();

    $Evaluator->evaluates($Auction);

    $highestBid = $Evaluator->getHighestBid();

    self::assertEquals(2500, $highestBid);
  }  
}