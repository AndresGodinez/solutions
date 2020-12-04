<?php

namespace App\Jobs;

use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ExecuteByConnection implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    public $selectedDB;
    protected $query;

    /**
     * Create a new job instance.
     *
     * @param  string  $query
     * @param  string  $selectedDB
     */
    public function __construct(string $query, string $selectedDB)
    {
        $this->query = $query;
        $this->selectedDB = $selectedDB;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            DB::connection($this->selectedDB)->getPdo()
                ->exec($this->query);
        } catch( Exception $e){
            report($e);
        }

    }
}
