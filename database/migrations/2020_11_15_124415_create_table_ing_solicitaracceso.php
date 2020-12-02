<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableIngSolicitaracceso extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     *
     */
    public function up()
    {
        Schema::create('table_ing_solicitaracceso', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre_comercial', 125);
            $table->string('nombre_del_dueno', 125);
            $table->string('email', 125);
            $table->string('telefono_dueno',45);
            $table->string('telefono_centro_servicio', 45);
            $table->string('dir_taller_calle', 45);
            $table->string('dir_taller_colonia', 45);
            $table->string('dir_taller_ciudad', 45);
            $table->string('dir_taller_estado', 45);
            $table->string('dir_taller_codigopostal', 45);
            $table->integer('multimarca');
            $table->string('multimarca_marcas_atiende', 100);
            $table->text('espacializa_producto');
            $table->string('marcas_atiende', 100);
            $table->string('zona_cobertura', 60);
            $table->string('num_tecnicos', 45);
            $table->string('promedio_mes', 45);
            $table->string('formacion_tenica', 45);
            $table->integer('garantia_marca', 45);
            $table->text('garantia_cual_marca');
            $table->integer('red_whirlpool');
            $table->integer('personal_administrativo');
            $table->string('donde_opera', 45);
            $table->integer('status');
            $table->string('password', 45);
            $table->string('time_expire', 45);
            $table->string('_token', 45);
            $table->date('fecha_expire');
            $table->text('recibodepago');
            $table->text('motivo_rechazo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_ing_solicitaracceso');
    }
}
