<?php

namespace Auction\Model;

class Auction
{
    /** @var Bid[] */
    private $bids;
    /** @var string */
    private $description;

    public function __construct(string $description)
    {
        $this->description = $description;
        $this->bids = [];
    }

    public function receivesBid(Bid $bid)
    {
      if (!empty($this->bids) && $this->isLastBidFromSameUser($bid)) {
        return;
      }

      if ($this->userHasMoreThan5Bids($bid)) {
        return;
      }
        $this->bids[] = $bid;
    }

    /**
     * @return Bid[]
     */
    public function getBids(): array
    {
        return $this->bids;
    }

    private function isLastBidFromSameUser(Bid $bid): bool
    {
      $lastBid = $this->bids[array_key_last($this->bids)];
      return $bid->getUser() == $lastBid->getUser();
    }

    private function userHasMoreThan5Bids(Bid $bid): bool
    {
      $user = $bid->getUser();
      $totalBids = 0;
      foreach ($this->getBids() as $bid) {
        if($user->getName() == $bid->getUser()->getName()) {
          $totalBids++;
        }
      } 
      
      return $totalBids >= 5;
    }
}
