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
            Schema::create('reports', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('session_id')->unsigned();
                $table->bigInteger('generated_by')->unsigned(); // ID del usuario que generó el reporte
                $table->text('content');
                $table->timestamps();
    
                // Relaciones
                $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
                $table->foreign('generated_by')->references('id')->on('users')->onDelete('cascade');
            });
        }
    
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down()
        {
            Schema::dropIfExists('reports');
        }
};

    
