<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatistiquesTable extends Migration
{
    // Méthode pour créer la table des statistiques
    public function up()
    {
        Schema::create('statistiques', function (Blueprint $table) {
            $table->id();
            $table->foreignId('joueur_id')->constrained()->onDelete('cascade'); // Lien avec le joueur
            $table->foreignId('equipe_id')->constrained()->onDelete('cascade'); // Lien avec l'équipe
            // $table->integer('minutes_jouees')->default(0); // Minutes jouées
            $table->unsignedBigInteger('zone_id'); // Référence à la Zone
            $table->integer('buts')->default(0); // Nombre de buts
            $table->integer('passeurs')->default(0); // Passes décisives
            // $table->integer('tirs')->default(0); // Tirs
            // $table->integer('dribbles_reussis')->default(0); // Dribbles réussis
            // $table->integer('interceptions')->default(0); // Interceptions
            // $table->integer('fautes_commises')->default(0); // Fautes commises
            $table->integer('cartons_jaunes')->default(0); // Cartons jaunes
            $table->integer('cartons_rouges')->default(0); // Cartons rouges
            // $table->decimal('distance_parcourue', 5, 2)->default(0.00); // Distance parcourue
            // $table->float('evaluation')->default(0); // Évaluation
            $table->timestamps();


            // Clé étrangère pour la Zone
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
        });
    }

    // Méthode pour supprimer la table des statistiques
    public function down()
    {
        Schema::dropIfExists('statistiques');
    }
}
