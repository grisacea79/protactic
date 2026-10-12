<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
       Schema::create('tarea_tabla', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('proyect_id');
        $table->string('name');
        $table->string('status');
        $table->string('priority')->default('media'); // <- Agrégalo así, normal
        $table->timestamps();

        $table->foreign('proyect_id')
              ->references('id')
              ->on('proyecto_tabla')
              ->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_tabla');
    }

 

};
