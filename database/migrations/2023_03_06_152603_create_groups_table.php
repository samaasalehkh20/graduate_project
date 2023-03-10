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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->boolean('status')->default(1);
            $table->boolean('is_subgroup')->default(0);

            // Foreign Key For Subdivision & Group Itself
            $table->foreignId('subdivision_id')->nullable()->constrained('subdivisions')->nullOnDelete();
            $table->foreignId('parent_id')->nullable()->constrained('groups','id')->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
};
