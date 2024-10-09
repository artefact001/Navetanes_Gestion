<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriqueJoueurEquipeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historique_joueur_equipe', function (Blueprint $table) {
            $table->id();  // Clé primaire auto-incrémentée
            $table->unsignedBigInteger('joueur_id');  // Clé étrangère vers la table 'joueurs'
            $table->unsignedBigInteger('equipe_id');  // Clé étrangère vers la table 'equipes'
            $table->date('date_debut');  // Date de début d'affiliation du joueur à l'équipe
            $table->date('date_fin')->nullable();  // Date de fin d'affiliation (nullable)
            $table->foreign('joueur_id')->references('id')->on('joueurs')->onDelete('cascade');  // Si le joueur est supprimé, son historique l'est aussi
            $table->foreign('equipe_id')->references('id')->on('equipes')->onDelete('cascade');  // Si l'équipe est supprimée, l'historique l'est aussi
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
        Schema::dropIfExists('historique_joueur_equipe');
    }
}
