<?php

namespace App\Jobs;

use App\InventarioLX02;
use App\InventarioLX02Dev;
use App\StockBasicoTecnico;
use App\Surtimiento;
use App\SurtimientoConcentrado;
use App\SurtimientoReserva;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateLX02Job implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string
     */
    protected $planta;

    /**
     * Create a new job instance.
     *
     * @param  string  $planta
     */
    public function __construct(string $planta)
    {
        $this->planta = $planta;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        InventarioLX02::updateDescription($this->planta);

        Surtimiento::deletePlanta($this->planta);

        SurtimientoReserva::deletePlanta($this->planta);

        SurtimientoReserva::updatePlantaStock($this->planta);

        SurtimientoReserva::markAsBorrar($this->planta);

        SurtimientoReserva::markAsBorrarReserva($this->planta);

        SurtimientoReserva::consolidarReserva();

        Surtimiento::insertConsolidado($this->planta);

        StockBasicoTecnico::actualizarStock($this->planta);

        StockBasicoTecnico::updateStockTecnico($this->planta);

        Surtimiento::insertSBSurtimiento($this->planta);

        SurtimientoConcentrado::eliminacionPorPlanta($this->planta);

        SurtimientoConcentrado::insercionConcentrado($this->planta);

        SurtimientoConcentrado::binesParaPicking($this->planta);

        InventarioLX02Dev::deletePlanta($this->planta);

        InventarioLX02Dev::insertData($this->planta);

    }
}
