<?php

namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Support\Str;

class MyUtils
{
    public static function getName(string $name, string $extension)
    {
        $date = MyUtils::getDate();

        return $date.Str::slug($name).$extension;
    }

    public static function getDate()
    {
        return Carbon::now()->format('Y-m-d H:i');
    }
}
