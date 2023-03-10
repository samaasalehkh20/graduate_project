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
        Schema::create('system_constants', function (Blueprint $table) {
            $table->id();
            $table->integer('main_cd');
            $table->integer('sub_cd');
            $table->string('name_ar');
            $table->string('name_en');
            $table->boolean('status')->default(1);

            // Foreign Key For Same Table
            $table->foreignId('parent_id')->nullable()->constrained('system_constants')->nullOnDelete();

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
        Schema::dropIfExists('system_constants');
    }
};
