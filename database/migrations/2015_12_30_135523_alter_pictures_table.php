<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // modifier le structure de la table
        Schema::table('pictures', function (Blueprint $table) {
            $table->enum('type', ['png', 'jpg', 'gif'])->after('size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pictures', function (Blueprint $table) {
            $table->dropColumn('type'); // supprimer la colonne type
        });
    }
}
