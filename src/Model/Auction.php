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

    public function recebeBid(Bid $Bid)
    {
        $this->bids[] = $Bid;
    }

    /**
     * @return Bid[]
     */
    public function getbids(): array
    {
        return $this->bids;
    }
}