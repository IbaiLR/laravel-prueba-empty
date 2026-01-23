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
        Schema::create('label_task', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id'); // tweet_id [cite: 92]
            $table->unsignedBigInteger('label_id'); // hash_tag_id [cite: 93]
            $table->timestamps();

            // Claves foráneas
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('label_id')->references('id')->on('labels')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('label_task');
    }
};
