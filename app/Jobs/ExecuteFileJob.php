<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use function exec;
use function php_uname;
use function substr;

class ExecuteFileJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $pathToFile;

    /**
     * Create a new job instance.
     *
     * @param  string  $pathToFile
     */
    public function __construct(string $pathToFile)
    {
        $this->pathToFile = $pathToFile;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::debug('Entra al handle del job');
        if (substr(php_uname(), 0, 7) == "Windows") {
            Log::debug('ejecutando '.$this->pathToFile);
            $result = exec($this->pathToFile);
            Log::debug($result);
        } else {
            Log::debug('asigna el exec');

            exec($this->pathToFile." > /dev/null &");
        }
    }
}
