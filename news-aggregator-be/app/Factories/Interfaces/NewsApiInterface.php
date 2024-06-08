<?php

namespace App\Factories\Interfaces;

interface NewsApiInterface
{
    public function all($params = []);
    public function headlines($params = []);
}