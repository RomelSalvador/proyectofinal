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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('imagen');
            $table->string('titulo');
            $table->text('descripcion');
            $table->enum('tipo', ['cultural', 'deportivo', 'social']);
            $table->date('fecha');
            $table->time('hora');
            $table->string('ubicacion');
            $table->integer('aforo');
            $table->decimal('precio', 8, 2)->default(0); 
            $table->enum('estado', ['activo', 'inactivo']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
