<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('informacion', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('contenido');
            $table->string('imagen')->nullable();
            $table->date('fecha_actualizacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('informacion');
    }
};

