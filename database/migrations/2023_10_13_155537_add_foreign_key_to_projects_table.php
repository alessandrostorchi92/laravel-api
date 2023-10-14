<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Run the migrations.
     */

    public function up(): void
    {

        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger("type_id")->nullable()->after("id");;

            $table->foreign("type_id")
            ->references("id")
            ->on("types")
            //Quando il type viene cancellato, il project rimane ma la type viene settata al valore null
            ->onDelete("set null");

        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void
    {

        Schema::table('projects', function (Blueprint $table) {

            //Per prima cosa rimuovo la FK
            $table->dropForeign("projects_type_id_foreign");

            //Dopo rimuovo la colonna
            $table->dropColumn("type_id");

        });
    }
};
