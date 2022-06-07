<?php

namespace Auction\tests\Model;

use Auction\Model\Auction;
use Auction\Model\User;
use Auction\Model\Bid;
use PHPUnit\Framework\TestCase;

require 'vendor/autoload.php';

class AuctionTest extends TestCase
{

  public function testAuctionMustNotReceiveRepeatedBids()
  {
    $auction = new Auction("New game");
    $user1 = new User("user1");

    $auction->receivesBid(new Bid($user1, 1500));
    $auction->receivesBid(new Bid($user1, 2000));

    self::assertCount(1, $auction->getBids());
    self::assertEquals(1500, $auction->getBids()[0]->getValue());
  }

  public function testAuctionMustNotReceiveMoreThan5BidsFromTheSameUser()
  {
    $auction = new Auction("new game");
    $user1 = new User("user1");
    $user2 = new User("user2");

    $auction->receivesBid(new Bid($user1, 1000));
    $auction->receivesBid(new Bid($user2, 1500));
    $auction->receivesBid(new Bid($user1, 2000));
    $auction->receivesBid(new Bid($user2, 2500));
    $auction->receivesBid(new Bid($user1, 3000));
    $auction->receivesBid(new Bid($user2, 3500));
    $auction->receivesBid(new Bid($user1, 4000));
    $auction->receivesBid(new Bid($user2, 4500));
    $auction->receivesBid(new Bid($user1, 5000));
    $auction->receivesBid(new Bid($user2, 5500));

    $auction->receivesBid(new Bid($user1, 6000));

    
    self::assertCount(10, $auction->getBids());
    self::assertEquals(5500, $auction->getBids()[array_key_last($auction->getBids())]->getValue());

  }

  /**
   * @dataProvider createBids
   */
  public function testAuctionMustReceiveBids(int $numberOfBids, Auction $auction, array $values)
  {

    self::assertCount($numberOfBids, $auction->getBids());

    foreach ($values as $key => $value) {
      self::assertEquals($value, $auction->getBids()[$key]->getValue());
    }
    
  }


  public function createBids()
  {
    $user1 = new User("user1");
    $user2 = new User("user2");

    $auctionWith2Bids = new Auction("Playstation 5");
    $auctionWith2Bids->receivesBid(new Bid($user1, 1000));
    $auctionWith2Bids->receivesBid(new Bid($user2, 2000));


    $auctionWith1Bid = new Auction("Xbox One");
    $auctionWith1Bid->receivesBid(new Bid($user1, 4000));

    return [
      "2-bids-auction" => [2, $auctionWith2Bids, [1000, 2000]],
      "1-bid-auction" => [1, $auctionWith1Bid, [4000]]
    ];
  }
}