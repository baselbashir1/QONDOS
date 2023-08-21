<?php

use App\Models\Client;
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
        Schema::create('special_service_orders', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_scheduled')->comment('0 unscheduled - 1 scheduled');
            $table->timestamp('visit_time')->nullable();
            $table->string('notes');
            $table->foreignIdFor(Client::class, 'client_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_service_orders');
    }
};
