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

  private $evaluator;

  protected function setUp(): void
  {
    $this->evaluator = new Evaluator();
  }

  /**
   * @dataProvider auctionInAscendingOrder
   * @dataProvider auctionInDescendingOrder
   * @dataProvider auctionInRandomOrder
   */
  public function testEvaluatorMustFindTheHighestBid(Auction $auction): void 
  { 

    $this->evaluator->evaluates($auction);

    $highestBid = $this->evaluator->getHighestBid();

    self::assertEquals(2500, $highestBid);
  }

  /**
   * @dataProvider auctionInAscendingOrder
   * @dataProvider auctionInDescendingOrder
   * @dataProvider auctionInRandomOrder
   */
  public function testEvaluatorMustFindThelowestBid(Auction $auction): void {

    $this->evaluator->evaluates($auction);

    $lowestBid = $this->evaluator->getLowestBid();

    self::assertEquals(200, $lowestBid);
  }

  /**
   * @dataProvider auctionInAscendingOrder
   * @dataProvider auctionInDescendingOrder
   * @dataProvider auctionInRandomOrder
   */
  public function testevaluatorMustFind3HighestBids(Auction $auction): void {


    $this->evaluator->evaluates($auction);

    $highestBids = $this->evaluator->getHighestBids();
    self::assertCount(3, $highestBids);
    self::assertEquals(2500, $highestBids[0]->getValue());
    self::assertEquals(2000, $highestBids[1]->getValue());
    self::assertEquals(1500, $highestBids[2]->getValue());
  }

  public function auctionInAscendingOrder(): array 
  {
    $auction = new Auction('New car');
    
    $user1 = new User("User1");
    $user2 = new User("User2");
    $user3 = new User("User3");
    $user4 = new User("User3");

    $auction->receivesBid(new Bid($user4, 200));
    $auction->receivesBid(new Bid($user3, 1500));
    $auction->receivesBid(new Bid($user2, 2000));
    $auction->receivesBid(new Bid($user1, 2500)); 

    return [
      [$auction]
    ];
  }

  public function auctionInDescendingOrder(): array
  {
    $auction = new auction('New car');

    $user1 = new User("User1");
    $user2 = new User("User2");
    $user3 = new User("User3");
    $user4 = new User("User3");

    $auction->receivesBid(new Bid($user1, 2500));
    $auction->receivesBid(new Bid($user2, 2000));
    $auction->receivesBid(new Bid($user3, 1500));
    $auction->receivesBid(new Bid($user4, 200));

    return [
      [$auction]
    ];
  }

  public function auctionInRandomOrder(): array
  {
    $auction = new auction('New car');

    $user1 = new User("User1");
    $user2 = new User("User2");
    $user3 = new User("User3");
    $user4 = new User("User3");
    
    
    $auction->receivesBid(new Bid($user2, 2000));
    $auction->receivesBid(new Bid($user1, 2500));
    $auction->receivesBid(new Bid($user4, 200));
    $auction->receivesBid(new Bid($user3, 1500));
    

    return [
      [$auction]
    ];
  }
}