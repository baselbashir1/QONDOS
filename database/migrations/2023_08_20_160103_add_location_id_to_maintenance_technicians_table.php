<?php

use App\Models\Location;
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
        Schema::table('maintenance_technicians', function (Blueprint $table) {
            $table->foreignIdFor(Location::class, 'location_id')->after('is_verified')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('maintenance_technicians', function (Blueprint $table) {
            $table->dropColumn('location_id');
        });
    }
};
