<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('boletines', function (Blueprint $table) {
            $table->id();
            $table->string('asunto');
            $table->text('mensaje');
            $table->date('fecha_envio');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('boletines');
    }
};

