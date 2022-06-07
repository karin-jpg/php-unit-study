<?php

namespace Auction\Model;

use DomainException;

class Auction
{
    /** @var Bid[] */
    private $bids;
    /** @var string */
    private $description;
    /** @var bool */
    private $finalized;

    public function __construct(string $description)
    {
        $this->finalized = false;
        $this->description = $description;
        $this->bids = [];
    }

    public function receivesBid(Bid $bid)
    {
      if (!empty($this->bids) && $this->isLastBidFromSameUser($bid)) {
        throw new DomainException('User cannot make 2 bids in a row');
      }

      if ($this->userHasMoreThan5Bids($bid)) {
        throw new DomainException('User cannot make more than 5 bids per auction');
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

    public function finalize(): void
    {
      $this->finalized = true;
    }

    public function isFinalized(): bool
    {
      return $this->finalized;
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
