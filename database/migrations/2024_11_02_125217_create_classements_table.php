<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassementsTable extends Migration
{
    public function up()
    {
        Schema::create('classements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('zone_id'); // Référence à la Zone
            $table->foreignId('equipe_id')->constrained()->onDelete('cascade');
            $table->integer('matches_joues')->default(0);
            $table->integer('gagne')->default(0);
            $table->integer('nul')->default(0);
            $table->integer('perdu')->default(0);
            $table->integer('buts_marques')->default(0);
            $table->integer('buts_encaisses')->default(0);
            $table->integer('diff_buts')->default(0);
            $table->integer('points')->default(0);
            $table->timestamps();

            // Clé étrangère pour la Zone
            $table->foreign('zone_id')->references('id')->on('zones')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('classements');
    }
}
