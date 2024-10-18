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
        Schema::create('forums', function (Blueprint $table) {
            $table->id();
            $table->string('tema');  // Título del hilo
            $table->text('descripcion');  // Descripción del hilo
            $table->unsignedBigInteger('creado_por');  // Referencia al usuario que creó el hilo
            $table->timestamps();
        
            // Relaciones
            $table->foreign('creado_por')->references('id')->on('users')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
