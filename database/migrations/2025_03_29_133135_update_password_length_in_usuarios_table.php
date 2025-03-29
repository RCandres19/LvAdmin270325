<?php       //Se ha cambiado el tamaño del campo password de 8 a 255 caracteres para permitir contraseñas más largas y seguras

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('password', 255)->change(); // Asegurar que tenga 255 caracteres
        });
    }
    
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('password', 8)->change(); // Volver a 8 si es necesario
        });
    }
    
};
