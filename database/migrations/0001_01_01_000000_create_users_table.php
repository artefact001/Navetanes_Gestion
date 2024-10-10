<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('users', function (Blueprint $table) {
    $table->id(); // Clé primaire auto-incrémentée
    $table->string('nom'); // Champ pour le nom
    $table->string('email')->unique(); // Champ pour l'email (unique)
    $table->string('password'); // Champ pour le mot de passe haché
    $table->enum('role', ['admin', 'zone', 'equipe'])->default('zone'); // Champ pour le rôle avec énumération
    $table->timestamp('email_verified_at')->nullable(); // Champ pour la date de vérification de l'email
    $table->string('remember_token')->nullable(); // Token pour la fonction "remember me"
    $table->string('photo_profile')->nullable(); // Champ pour la photo de profil (nullable)
    $table->timestamps(); // Champs 'created_at' et 'updated_at'
});

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
