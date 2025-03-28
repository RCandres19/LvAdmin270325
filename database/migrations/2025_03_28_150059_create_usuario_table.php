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
            $table->enum('tipo_documento', ['CC', 'TI', 'PPT', 'PEP']);
            $table->string('documento', 255)->unique();
            $table->string('telefono', 20)->nullable();
            $table->string('correo', 100)->unique();
            $table->text('token')->nullable();
            $table->string('contraseña', 500);
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
