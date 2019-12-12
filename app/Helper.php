<?php


namespace App;

use Carbon\Carbon;


class Helper
{

    public static function getRandomRegisterDate()
    {
        $randomCreatedAt = Carbon::now();
        $randomCreatedAt
            ->subDays(rand(2,144))
            ->setHours(rand(0,23))
            ->setMinutes(rand(0,59))
            ->setSeconds(rand(0,59));
        $randomVerifiedAt = $randomCreatedAt->copy()->addMinutes(rand(2,30));
        return [
            'created' => $randomCreatedAt,
            'verified' => $randomVerifiedAt
        ];
    }

}
