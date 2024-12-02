<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id(); // Identificador único de la sesión
            $table->unsignedBigInteger('psicologa_id'); // ID del usuario que es la psicóloga/terapeuta
            $table->unsignedBigInteger('usuario_id');   // ID del usuario que recibe la terapia o participa en la reunión
            $table->string('tipo_sesion');              // Tipo de sesión (terapia, reunión, etc.)
            $table->text('descripcion')->nullable();    // Descripción de la sesión o reunión (opcional)
            $table->dateTime('fecha_hora');             // Fecha y hora programada de la sesión
            $table->boolean('completada')->default(false); // Indica si la sesión ya ha ocurrido
            $table->timestamps();                      // Timestamps para saber cuándo se creó y actualizó la sesión

            // Definir las claves foráneas con las tablas relacionadas
            $table->foreign('psicologa_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
