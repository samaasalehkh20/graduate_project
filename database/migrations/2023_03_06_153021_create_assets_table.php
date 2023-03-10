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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('asset_number');
            $table->string('code_gis');
            $table->string('quantity');

            // Foreign Keys
            $table->foreignId('category_id')->nullable()->constrained('categories')->cascadeOnDelete();
            $table->foreignId('subdivision_id')->nullable()->constrained('subdivisions')->cascadeOnDelete();
            $table->foreignId('group_id')->nullable()->constrained('groups')->cascadeOnDelete();
            $table->foreignId('asset_type_id')->nullable()->constrained('asset_types')->cascadeOnDelete();
            $table->foreignId('asset_name_id')->nullable()->constrained('asset_names')->cascadeOnDelete();
            $table->foreignId('asset_location_id')->nullable()->constrained('asset_locations')->cascadeOnDelete();
            $table->foreignId('measurement_unit_id')->nullable()->constrained('measurement_units')->cascadeOnDelete();

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
        Schema::dropIfExists('assets');
    }
};
