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
        Schema::create('canceled_orders', function (Blueprint $table) {
            $table->id();
            $table->string('notes')->nullable();
            $table->foreignIdFor(Client::class, 'client_id')->constrained()->onDelete('cascade');
            $table->boolean('is_scheduled')->comment('0 unscheduled - 1 scheduled');
            $table->timestamp('visit_time')->nullable();
            $table->boolean('payment_type')->comment('0 cash - 1 electronic');
            $table->string('payment_method')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canceled_orders');
    }
};
