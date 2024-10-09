<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resultats', function (Blueprint $table) {
            $table->id();  // Clé primaire auto-incrémentée
            $table->unsignedBigInteger('matche_id');  // Clé étrangère vers la table 'matchs'
            $table->integer('carton_jaune')->default(0);  // Nombre de cartons jaunes, par défaut 0
            $table->integer('carton_rouge')->default(0);  // Nombre de cartons rouges, par défaut 0
            $table->json('detail_but');  // Détails des buteurs sous forme de JSON
            $table->integer('score_local');  // Score de l'équipe locale
            $table->integer('score_visiteur');  // Score de l'équipe visiteuse
            $table->foreign('matche_id')->references('id')->on('matches')->onDelete('cascade');  // Si le match est supprimé, les résultats le sont aussi
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
        Schema::dropIfExists('resultats');
    }
}
