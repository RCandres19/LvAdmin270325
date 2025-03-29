<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // ID autoincremental
            $table->unsignedBigInteger('id_finca')->nullable();
            $table->string('nombre', 60);
            $table->string('apellido', 60);
            $table->string('tipo_documento', 20);
            $table->string('documento', 255)->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('correo', 100)->unique();
            $table->text('token')->nullable();
            $table->string('password', 255); // Se ha cambiado el tamaño del campo password a 255 caracteres
            $table->integer('intentos_fallidos')->default(0);
            $table->string('bloqueado_hasta', 100)->nullable();
            $table->string('codigo_verificacion', 100)->nullable();
            $table->timestamps(); // Campos created_at y updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios'); // Elimina la tabla en caso de rollback
    }
};
