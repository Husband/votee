<?php
namespace Laravolt\Votee;

class Session
{
    public $id;

    public function __construct()
    {
        $this->id = session()->getId();
    }

    public function getAuthIdentifier()
    {
        return $this->id;
    }
}
