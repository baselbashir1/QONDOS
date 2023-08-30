<?php

use App\Models\MaintenanceTechnician;
use App\Models\SubCategory;
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
        Schema::create('maintenance_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(MaintenanceTechnician::class, 'maintenance_technician_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(SubCategory::class, 'sub_category_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_sub_categories');
    }
};
