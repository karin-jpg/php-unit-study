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
    
    $user1 = new User("User1");
    $user2 = new User("User2");
    $user3 = new User("User3");
    $user4 = new User("User3");

    $Auction->receivesBid(new Bid($user4, 200));
    $Auction->receivesBid(new Bid($user3, 1500));
    $Auction->receivesBid(new Bid($user2, 2000));
    $Auction->receivesBid(new Bid($user1, 2500));
    
    $Evaluator = new Evaluator();

    $Evaluator->evaluates($Auction);

    $highestBid = $Evaluator->getHighestBid();

    self::assertEquals(2500, $highestBid);
  }
  
  public function testEvaluatorMustFindTheHighestBidInDescendingOrder(): void {

    $Auction = new Auction('New car');


    $user1 = new User("User1");
    $user2 = new User("User2");
    $user3 = new User("User3");
    $user4 = new User("User3");

    $Auction->receivesBid(new Bid($user1, 2500));
    $Auction->receivesBid(new Bid($user2, 2000));
    $Auction->receivesBid(new Bid($user3, 1500));
    $Auction->receivesBid(new Bid($user4, 200));

    $Evaluator = new Evaluator();

    $Evaluator->evaluates($Auction);

    $highestBid = $Evaluator->getHighestBid();

    self::assertEquals(2500, $highestBid);
  }  

  public function testEvaluatorMustFindThelowestBidInDescendingOrder(): void {

    $Auction = new Auction('New car');

    $user1 = new User("User1");
    $user2 = new User("User2");
    $user3 = new User("User3");
    $user4 = new User("User3");

    $Auction->receivesBid(new Bid($user1, 2500));
    $Auction->receivesBid(new Bid($user2, 2000));
    $Auction->receivesBid(new Bid($user3, 1500));
    $Auction->receivesBid(new Bid($user4, 200));

    $Evaluator = new Evaluator();

    $Evaluator->evaluates($Auction);

    $lowestBid = $Evaluator->getLowestBid();

    self::assertEquals(200, $lowestBid);
  }

  public function testEvaluatorMustFindThelowestBidInAscendingOrder(): void {

    $Auction = new Auction('New car');


    $user1 = new User("User1");
    $user2 = new User("User2");
    $user3 = new User("User3");
    $user4 = new User("User3");

    $Auction->receivesBid(new Bid($user4, 200));
    $Auction->receivesBid(new Bid($user3, 1500));
    $Auction->receivesBid(new Bid($user2, 2000));
    $Auction->receivesBid(new Bid($user1, 2500));

    $Evaluator = new Evaluator();

    $Evaluator->evaluates($Auction);

    $lowestBid = $Evaluator->getLowestBid();

    self::assertEquals(200, $lowestBid);
  }
  
  public function testevaluatorMustFind3HighestBids(): void {
    $auction = new Auction("New car");

    $user1 = new User("user1");
    $user2 = new User("user2");
    $user3 = new User("user3");
    $user4 = new User("user4");

    $auction->receivesBid(new Bid($user1, 1500));
    $auction->receivesBid(new Bid($user2, 3000));
    $auction->receivesBid(new Bid($user3, 500));
    $auction->receivesBid(new Bid($user4, 1000));

    $evaluator = new Evaluator();

    $evaluator->evaluates($auction);

    $highestBids = $evaluator->getHighestBids();
    self::assertCount(3, $highestBids);
    self::assertEquals(3000, $highestBids[0]->getValue());
    self::assertEquals(1500, $highestBids[1]->getValue());
    self::assertEquals(1000, $highestBids[2]->getValue());
  }
}