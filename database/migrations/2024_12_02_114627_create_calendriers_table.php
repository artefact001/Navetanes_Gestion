<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendriersTable extends Migration
{
    public function up()
    {
        Schema::create('calendriers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('matche_id')->constrained()->onDelete('cascade'); // Relation avec la table des matchs
            $table->dateTime('date_heure'); // Date et heure du match
            $table->string('lieu');         // Lieu du match
            $table->unsignedBigInteger('zone_id');  // Clé étrangère vers la table 'zones'
            $table->timestamps();



            // Clé étrangère pour la Zone
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('calendriers');
    }
}
