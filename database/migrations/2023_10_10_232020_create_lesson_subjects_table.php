<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lesson_subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('lesson_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->unsignedTinyInteger('status')->nullable()->comment('0: active, 1: inactive');
            $table->integer('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lesson_subjects');
    }
};
