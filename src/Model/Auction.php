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
      if(!empty($this->bids) && $this->isLastBidFromSameUser($bid)) {
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
      $lastBid = $this->bids[count($this->bids) - 1];
      return $bid->getUser() == $lastBid->getUser();
    }
}
