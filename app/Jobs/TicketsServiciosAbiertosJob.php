<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\TicketsAbiertosModel;


class TicketsServiciosAbiertosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    private $path_file;
    private $username;

    /**
     * Create a new job instance.
     *
     * @path_file  string  $path_file
     */
    public function __construct(string $path_file, string $username)
    {
        Log::info("TicketsServiciosAbiertosJob executed!");
        $this->path_file = $path_file;
        $this->username = $username;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        Log::info("TicketsServiciosAbiertosJob - path_file = ".$this->path_file.' - inicia proceso ');
        TicketsAbiertosModel::process_tickets_servicios_abiertos($this->path_file, $this->username);   
        Log::info("TicketsServiciosAbiertosJob - path_file = ".$this->path_file.' - termina proceso ');
    }

}
