<?php

namespace App\Components;

use Illuminate\Support\Facades\DB;
use function is_null;

class CheckLogs
{

    public function check( $table = null, $processName = null, $connection = null)
    {
        $d = DB::table($table)->where('process_name', $processName)->select('start_proc')->max('start_proc');

        return is_null($d);
    }
}
