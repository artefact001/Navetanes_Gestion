<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table->id();  // Clé primaire auto-incrémentée
            $table->unsignedBigInteger('equipe_local');  // Clé étrangère vers l'équipe locale
            $table->unsignedBigInteger('equipe_visiteur');  // Clé étrangère vers l'équipe visiteuse
            $table->dateTime('date');  // Date et heure du match
            $table->string('lieu');  // Lieu du match
            $table->foreign('equipe_local')->references('id')->on('equipes')->onDelete('cascade');  // Si l'équipe locale est supprimée, le match est supprimé
            $table->foreign('equipe_visiteur')->references('id')->on('equipes')->onDelete('cascade');  // Si l'équipe visiteuse est supprimée, le match est supprimé
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
        Schema::dropIfExists('matches');
    }
}
