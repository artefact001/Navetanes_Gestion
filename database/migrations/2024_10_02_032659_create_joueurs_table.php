<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJoueursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('joueurs', function (Blueprint $table) {
            $table->id();  // Clé primaire auto-incrémentée
            $table->string('nom');  // Nom du joueur
            $table->integer('age');  // Âge du joueur
            $table->string('licence')->unique();  // Numéro de licence unique du joueur
            $table->unsignedBigInteger('equipe_id');  // Clé étrangère vers la table 'equipes'
            $table->unsignedBigInteger('categorie_id');  // Clé étrangère vers la table 'categories'
            $table->foreign('equipe_id')->references('id')->on('equipes')->onDelete('cascade');  // Si l'équipe est supprimée, tous les joueurs associés le seront aussi
            $table->foreign('categorie_id')->references('id')->on('categories')->onDelete('cascade');  // Suppression en cascade si la catégorie est supprimée
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
        Schema::dropIfExists('joueurs');
    }
}
