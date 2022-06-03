<?php

namespace Auction\Service;

use Auction\Model\Auction;

class Evaluator
{
  private $highestBid;

  public function __construct()
  {
    $this->highestBid = -INF;
    $this->lowestBid = INF;
  }

  public function evaluates(Auction $auction): void
  {
    foreach ($auction->getBids() as $bid) {
      if ($bid->getValue() > $this->highestBid){
        $this->highestBid = $bid->getValue();
      } 
      
      if ($bid->getValue() < $this->lowestBid) {
        $this->lowestBid = $bid->getValue();
      }
    }
  }

  public function getHighestBid(): float
  {
    return $this->highestBid;
  }

  public function getLowestBid(): float
  {
    return $this->lowestBid;
  }
}