<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nom');
            $table->string('email')->unique();
            $table->string('mdp')->nullable();
            $table->enum('type', ['sousAdministrateur', 'investisseur', 'administrateur', 'fondateur']);
            $table->string('numero')->nullable();
            $table->string('image')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
