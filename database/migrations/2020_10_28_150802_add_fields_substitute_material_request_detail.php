<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsSubstituteMaterialRequestDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('wpx_ligas_sustitutos', function (Blueprint $table) {
            $table->string('modelo', 25)->nullable();
            $table->string('taller', 25)->nullable();
            $table->string('no_dispatch', 25)->nullable();
            $table->string('proveedor', 25)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('wpx_ligas_sustitutos', function (Blueprint $table) {
            $table->dropColumn('modelo');
            $table->dropColumn('taller');
            $table->dropColumn('no_dispatch');
            $table->dropColumn('proveedor');
        });
    }
}
