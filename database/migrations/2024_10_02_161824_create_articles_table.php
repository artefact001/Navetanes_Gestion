<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_articles_table.php

public function up()
{
    Schema::create('articles', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('contenu');
        $table->unsignedBigInteger('user_id'); // Référence à l'utilisateur (auteur du commentaire)
        $table->unsignedBigInteger('zone_id'); // Référence à la Zone
        $table->string('file_path'); // Nouveau champ pour le chemin du fichier
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
