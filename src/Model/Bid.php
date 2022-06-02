<?php

namespace Auction\Model;

class Bid
{
    /** @var User */
    private $user;
    /** @var float */
    private $value;

    public function __construct(User $User, float $value)
    {
        $this->User = $User;
        $this->value = $value;
    }

    public function getUser(): User
    {
        return $this->User;
    }

    public function getValue(): float
    {
        return $this->value;
    }
}
