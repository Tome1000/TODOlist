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
        Schema::create('tag_task', function (Blueprint $table) {
           
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('task_id');

            $table->foreign('tag_id')
                ->references('id')->on('tags')
                ->onDelete('CASCADE');

            $table->foreign('task_id')
                ->references('id')->on('tasks')
                ->onDelete('CASCADE');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_task');
    }
};
