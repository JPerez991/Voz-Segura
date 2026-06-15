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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Clave primaria
            $table->string('nombre_usuario')->unique(); // Nombre de usuario único
            $table->string('email')->unique(); // Correo único
            $table->string('password'); // Contraseña
            $table->string('rol')->default('user'); // Rol del usuario, por defecto 'user'
            $table->boolean('es_anonimo')->default(false); // Indica si el usuario es anónimo
            $table->rememberToken(); // Token para recordar sesiones
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
