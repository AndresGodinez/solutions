<?php

namespace App\Utils;

use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use function date;
use function time;

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

    public static function saveAndReturnCompleteNameFile(UploadedFile $file)
    {
        $name = time().'-'.$file->hashName();
        $path = 'public/uploads/'.date('Y/m/');
        $file->move($path, $name);
        $public_path = addslashes(public_path()).'/';
        return $public_path.$path.$name;
    }


    public static function deleteFiles( str $name)
    {
//        TODO implements service
    }
}
