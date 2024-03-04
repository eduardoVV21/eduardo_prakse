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
        Schema::create('shared_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Lietotāja ID, kas dalās ar sarakstu
            $table->unsignedBigInteger('shared_with_user_id'); // Lietotāja ID, ar kuru saraksts tiek dalīts
            $table->unsignedBigInteger('todo_id'); // Saraksta ID
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('shared_with_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('todo_id')->references('id')->on('todos')->onDelete('cascade');
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('todo_id'); // Saraksta ID
            $table->string('task_name');
            $table->boolean('completed')->default(false);
            $table->timestamps();

            $table->foreign('todo_id')->references('id')->on('todos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('shared_lists');
    }
}
