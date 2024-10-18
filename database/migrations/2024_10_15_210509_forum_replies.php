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
    Schema::create('forum_replies', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('forum_id');  // Referencia al foro
    $table->unsignedBigInteger('user_id');  // Usuario que publicó el mensaje
    $table->text('responder');  // Contenido del mensaje
    $table->boolean('es_anonimo')->default(false);  // Opción de anonimato
    $table->timestamps();

    // Relaciones
    $table->foreign('forum_id')->references('id')->on('forums')->onDelete('cascade');
    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
