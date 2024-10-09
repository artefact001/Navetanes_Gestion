<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReclamationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reclamations', function (Blueprint $table) {
            $table->id();  // Clé primaire auto-incrémentée
            $table->unsignedBigInteger('equipe_id');  // Clé étrangère vers la table 'equipes'
            $table->text('description');  // Description de la réclamation
            $table->enum('statut', ['en_attente', 'traitee', 'rejete'])->default('en_attente');  // Statut de la réclamation
            $table->foreign('equipe_id')->references('id')->on('equipes')->onDelete('cascade');  // Si l'équipe est supprimée, les réclamations associées le sont aussi
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
        Schema::dropIfExists('reclamations');
    }
}
