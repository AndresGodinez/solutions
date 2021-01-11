<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\TicketsAbiertosModel;
use App\Usuario;
use Mail;

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
        
        $usuario = Usuario::where('username', '=', $this->username)->first();
        Log::info("TicketsServiciosAbiertosJob - path_file = ".$this->path_file.' - '.$this->username.' - inicia proceso ');
        TicketsAbiertosModel::process_tickets_servicios_abiertos($this->path_file, $this->username);   
        Log::info("TicketsServiciosAbiertosJob - path_file = ".$this->path_file.' - '.$this->username.' - termina proceso ');
        
        Mail::send('mailing.tickets-abiertos-servicios-abiertos',
                        ['usuario' => $usuario], 
                        function ($mailing) use ($usuario) {
            $mailing->from("no-responder@whirlpool.com", "Centro de Soluciones");
            $mailing->to($usuario->mail);
            $mailing->subject('CS - Carga de Servicios Abiertos Finalizada');
        });
        Log::info("TicketsServiciosAbiertosJob - path_file = ".$this->path_file.' - '.$this->username.' - correo enviado a '.$usuario->mail);
        
    }

}
