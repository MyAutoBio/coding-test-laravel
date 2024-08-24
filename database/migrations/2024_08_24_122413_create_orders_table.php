<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Order\OrderStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->ulid('id')
                ->primary();

            $table->foreignUlid('customer_id');
            $table->foreignUlid('address_id');

            $table->string('reference')
                ->index()
                ->unique();
            $table->enum('status', collect(OrderStatus::cases())->pluck('name')->toArray())
                ->default(OrderStatus::pending->name);
            $table->decimal('total')
                ->default(0);
            $table->string('note')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
