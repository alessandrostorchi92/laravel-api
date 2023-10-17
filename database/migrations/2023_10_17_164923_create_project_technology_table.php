<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */

    public function up(): void {
        Schema::create('project_technology', function (Blueprint $table) {

            //FK projects

            // Il nome della FK deve essere il nome della tabella a cui fa riferimento al singolare seguito dalla parola _id

            $table->unsignedBigInteger('project_id')->nullable();

            //Rendo questa colonna una FK
            $table->foreign('project_id')
            ->references("id")
            ->on("projects")
            ->onDelete("set null");

            //FK technologies

            $table->unsignedBigInteger("technology_id")->nullable();
            $table->foreign("technology_id")
            ->references("id")
            ->on("technologies")
            ->onDelete("set null");

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */

    public function down(): void {
        Schema::dropIfExists('project_technology');
    }
};
