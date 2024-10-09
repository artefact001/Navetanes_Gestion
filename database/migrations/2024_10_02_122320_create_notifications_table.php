<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();  // Clé primaire auto-incrémentée
            $table->unsignedBigInteger('user_id');  // Clé étrangère vers la table 'users'
            $table->string('type');  // Type de notification (par exemple, message, alerte, etc.)
            $table->text('data');  // Contenu de la notification
            $table->timestamp('read_at')->nullable();  // Date et heure de lecture de la notification (nullable)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Si l'utilisateur est supprimé, ses notifications le sont aussi
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
        Schema::dropIfExists('notifications');
    }
}
