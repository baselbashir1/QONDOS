<?php

use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maintenance_technicians', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->unique();
            $table->string('password');
            $table->string('city');
            $table->string('bank');
            $table->string('account_number');
            $table->string('photo')->nullable();
            $table->string('residency_photo')->nullable();
            $table->boolean('is_verified');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            // $table->foreignIdFor(Category::class, 'main_category_id')->comment('main service');
            // $table->foreignIdFor(SubCategory::class, 'sub_category_id')->comment('sub service');
            // $table->foreignIdFor(Service::class, 'service_id')->comment('maintenance technician service');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenance_technicians');
    }
};
