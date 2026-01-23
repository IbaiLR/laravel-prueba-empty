<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Añadimos los campos que pide el examen 
            $table->string('lastname')->after('name'); 
            $table->string('biography')->nullable()->after('lastname');
            $table->string('website')->nullable()->after('biography');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Muy importante: definir cómo deshacer el cambio
            $table->dropColumn(['lastname', 'biography', 'website']);
        });
    }
};
