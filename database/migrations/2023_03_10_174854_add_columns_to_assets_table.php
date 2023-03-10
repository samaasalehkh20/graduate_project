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
        Schema::table('assets', function (Blueprint $table) {
            $table->string('funding_source');
            $table->string('property_type');
            $table->date('year_of_possession');
            $table->string('asset_age');

            // Foreign Keys
            $table->foreignId('first_location_id')->nullable()->constrained('asset_locations')->nullOnDelete();
            $table->foreignId('second_location_id')->nullable()->constrained('asset_locations')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assets', function (Blueprint $table) {
            $table->dropColumn('funding_source');
            $table->dropColumn('property_type');
            $table->dropColumn('year_of_possession');
            $table->dropColumn('asset_age');
            $table->dropConstrainedForeignId('first_location_id');
            $table->dropConstrainedForeignId('second_location_id');
        });
    }
};
