<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->integer('numcontra')->unique();
            $table->string('cedula');
            $table->date('fecha_contrato');
            $table->date('fecha_vencimiento');
            $table->date('fecha_interes');
            $table->boolean('cancelado');
            $table->double('prestamo', 8, 2);
            $table->boolean('vencido');
            $table->text('descripcion');
            $table->boolean('anulado');
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
        Schema::dropIfExists('contratos');
    }
};
