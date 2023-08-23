<?php

use App\Models\Order;
use App\Models\Client;
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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            // $table->boolean('status')->comment('1 accepted - 0 rejected');
            $table->string('status');
            $table->foreignIdFor(MaintenanceTechnician::class, 'maintenance_technician_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(Client::class, 'client_id');
            $table->foreignIdFor(Order::class, 'order_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
