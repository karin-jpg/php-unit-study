<?php

namespace Auction\Service;

use Auction\Model\Auction;

class Evaluator
{
  private $highestBid;
  private $lowestBid;
  private $highestBids;

  public function __construct()
  {
    $this->highestBid = -INF;
    $this->lowestBid = INF;
    $this->highestBids = array();
  }

  public function evaluates(Auction $auction): void
  {

    if (empty($auction->getBids())) {
      throw new \DomainException('It\'s not possible to evaluate a empty auction');
    }

    if ($auction->isFinalized()) {
      throw new \DomainException('A finalized auction cannot be evaluated');
    }

    foreach ($auction->getBids() as $bid) {
      if ($bid->getValue() > $this->highestBid){
        $this->highestBid = $bid->getValue();
      } 
      
      if ($bid->getValue() < $this->lowestBid) {
        $this->lowestBid = $bid->getValue();
      }
    }

    $this->highestBids = $auction->getBids(); 
    rsort($this->highestBids);
    $this->highestBids = array_splice($this->highestBids, 0, 3);
  }

  public function getHighestBid(): float
  {
    return $this->highestBid;
  }

  public function getLowestBid(): float
  {
    return $this->lowestBid;
  }

  public function getHighestBids(): array
  {
    return $this->highestBids;
  }
}