<?php

namespace App\Jobs;

use App\Models\TicketsAbiertosModel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;


class ProcessTicketsServiciosAbiertos implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $file)
    {
        Log::info("ProcessTicketsServiciosAbiertos executed!");
        $this->file = $file;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        Log::info("ProcessTicketsServiciosAbiertos param file = ".$this->file);
        //TicketsAbiertosModel::process_tickets_servicios_abiertos($file);   
    }
}
