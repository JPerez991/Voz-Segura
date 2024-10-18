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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('envia_id'); // Usuario que envía el mensaje
            $table->unsignedBigInteger('recibe_id'); // Usuario que recibe el mensaje
            $table->text('mensaje'); // Contenido del mensaje
            $table->boolean('es_anonimo')->default(false); // Opción de anonimato
            $table->timestamps();
        
            // Claves foráneas
            $table->foreign('envia_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recibe_id')->references('id')->on('users')->onDelete('cascade');
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
