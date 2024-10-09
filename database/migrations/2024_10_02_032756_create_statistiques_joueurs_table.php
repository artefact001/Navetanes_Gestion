<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatistiquesJoueursTable extends Migration
{
    /**
     * Exécuter la migration pour créer la table 'statistiques_joueurs'.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistiques_joueurs', function (Blueprint $table) {
            $table->id();  // Identifiant unique pour chaque statistique
            $table->unsignedBigInteger('joueur_id');  // Clé étrangère vers la table des joueurs
            $table->unsignedBigInteger('matche_id');  // Clé étrangère vers la table des matchs
            $table->integer('buts')->default(0);  // Nombre de buts marqués
            $table->integer('passeurs')->default(0);  // Nombre de passes décisives
            $table->integer('cartons_jaunes')->default(0);  // Nombre de cartons jaunes reçus
            $table->integer('cartons_rouges')->default(0);  // Nombre de cartons rouges reçus
            $table->integer('minutes_jouees')->default(0);  // Nombre de minutes jouées
            $table->timestamps();  // Champs pour enregistrer les dates de création et de mise à jour

            // Clés étrangères vers les tables des joueurs et des matchs
            $table->foreign('joueur_id')->references('id')->on('joueurs')->onDelete('cascade');
            $table->foreign('matche_id')->references('id')->on('matches')->onDelete('cascade');
        });
    }

    /**
     * Inverser la migration (suppression de la table 'statistiques_joueurs').
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statistiques_joueurs');
    }
}
