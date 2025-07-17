<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('nom_entreprise')->nullable()->after('name'); 
        // ou après un autre champ que tu souhaites, et nullable si c'est facultatif
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('nom_entreprise');
    });
}

};
