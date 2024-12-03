<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\Address\AddressType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->ulid('id')
                ->primary();

            $table->ulidMorphs('addressable');

            $table->enum('type', collect(AddressType::cases())->pluck('name')->toArray());
            $table->string('city')
                ->nullable();
            $table->string('region')
                ->nullable();
            $table->string('street')
                ->nullable();
            $table->string('full_address')
                ->nullable();
            $table->string('zip_code')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
