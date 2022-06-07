<?php

namespace Auction\tests\Model;

use Auction\Model\Auction;
use Auction\Model\User;
use Auction\Model\Bid;
use PHPUnit\Framework\TestCase;

require 'vendor/autoload.php';

class AuctionTest extends TestCase
{

  public function testAuctionMustReceiveBids()
  {
    $user1 = new User("user1");
    $user2 = new User("user2");

    $auction = new Auction("Playstation 5");
    $auction->receivesBid(new Bid($user1, 1000));
    $auction->receivesBid(new Bid($user2, 2000));

    self::assertCount(2, $auction->getBids());
    self::assertEquals(1000, $auction->getBids()[0]->getValue());
    self::assertEquals(2000, $auction->getBids()[1]->getValue());
    
  }
}