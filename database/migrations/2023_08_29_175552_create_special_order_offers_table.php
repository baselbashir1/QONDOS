<?php

use App\Models\Client;
use App\Models\SpecialServiceOrder;
use App\Models\MaintenanceTechnician;
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
        Schema::create('special_order_offers', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('status');
            $table->foreignIdFor(MaintenanceTechnician::class, 'maintenance_technician_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(Client::class, 'client_id');
            $table->foreignIdFor(SpecialServiceOrder::class, 'special_service_order_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_order_offers');
    }
};
