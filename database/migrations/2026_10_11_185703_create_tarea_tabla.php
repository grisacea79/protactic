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
              $table->String("name");
                  $table->String("description");
            $table->String("status");
             $table->string('priority')->default('media');
             $table->date("due_date");

             $table->foreign('proyect_id')
                     ->references('id')
                     ->on('proyecto_tabla')
                     ->onDelete('cascade');
          
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarea_tabla');
    }
};
