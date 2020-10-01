<?php

namespace App\Jobs;

use App\Ciclicos;
use App\CiclosTemp;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCiclicosJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

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
        Ciclicos::delPlanta($this->planta);

        Ciclicos::copyTempToCiclicos($this->planta);

        CiclosTemp::deletePlanta($this->planta);

        Ciclicos::delNullPlanta($this->planta);

        Ciclicos::updateCiclicosInfo();

        Ciclicos::updateDescription();

    }
}
