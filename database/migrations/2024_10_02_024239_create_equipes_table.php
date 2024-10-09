<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipes', function (Blueprint $table) {
            $table->id();  // Clé primaire auto-incrémentée
            $table->string('nom');  // Nom de l'équipe
            $table->string('logo')->nullable();  // Logo de l'équipe, peut être nul
            $table->date('date_creer');  // Date de création de l'équipe
            $table->unsignedBigInteger('zone_id');  // Clé étrangère vers la table 'zones'
            $table->unsignedBigInteger('user_id')->nullable();  // Clé étrangère vers la table 'users', gestionnaire de l'équipe, peut être nul
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');  // Clé étrangère liée à 'zones', suppression en cascade
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');  // Clé étrangère liée à 'users', met à null en cas de suppression de l'utilisateur
            $table->timestamps();  // Dates de création et de mise à jour
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('equipes');
    }
}
