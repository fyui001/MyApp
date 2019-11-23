<?php

namespace App\Library;

use Illuminate\Support\Facades\DB;

class Libraries
{
    public function tokenGen(int $length) {
        $charSet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $token = '';
        $randMax = strlen($charSet) - 1;
        for ($i=0; $i<$length; $i++) {
            $token .= $charSet[rand(0, $randMax)];
        }
        return $token;
    }
}
