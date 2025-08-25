<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('account_number')->unique()->nullable(false);
            $table->enum('currency', ['USD', 'EUR', 'GBP', 'JPY', 'AUD']);
            $table->decimal('interest', 8, 2)->nullable(false);
            $table->decimal('balance', 15, 2)->nullable(false);
            $table->bigInteger('client_id')->unsigned();
            $table->foreign('client_id')->references('id')->on('users');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
