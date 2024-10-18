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
        // Primero, crear la tabla profiles
        Schema::create('profiles', function (Blueprint $table) {
            $table->id(); // Asegúrate de que el campo 'id' sea la clave primaria
            $table->unsignedBigInteger('user_id')->unique(); // Llave foránea para users
            $table->string('nombre_completo')->nullable(); // Otros campos
            $table->text('descripcion')->nullable();
            $table->string('nombre_anonimo')->nullable();
            $table->timestamps(); // Incluye 'created_at' y 'updated_at'
        });

        // Después, asegurarte que 'user_id' esté definido como clave foránea
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
