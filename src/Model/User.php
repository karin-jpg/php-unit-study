<?php

namespace Auction\Model;

class User
{
    /** @var string */
    private $Name;

    public function __construct(string $Name)
    {
        $this->Name = $Name;
    }

    public function getName(): string
    {
        return $this->Name;
    }
}
