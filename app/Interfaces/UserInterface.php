<?php

namespace App\Interfaces;

interface UserInterface
{
    public function save(array $data, $user = null);
}
