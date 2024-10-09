<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentairesTable extends Migration
{
    /**
     * Exécute la migration pour créer la table `commentaires`.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id(); // Clé primaire
            $table->text('contenu'); // Contenu du commentaire
            $table->unsignedBigInteger('article_id'); // Référence à l'article
            $table->unsignedBigInteger('user_id'); // Référence à l'utilisateur (auteur du commentaire)
            $table->timestamps(); // Horodatage de la création et mise à jour

            // Clé étrangère pour l'article
            $table->foreign('article_id')->references('id')->on('articles')->onDelete('cascade');
            // Clé étrangère pour l'utilisateur
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Revert la migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
}
