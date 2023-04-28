<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('country')->nullable();
            $table->string('street_address')->nullable();
            $table->string('street_address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();

            $table->string('total_price')->nullable();
            $table->string('paid')->nullable();
            $table->string('mpesa_message')->nullable();
            $table->string('bank_message')->nullable();
            $table->string('purchase_phone')->nullable();

            $table->string('shipped')->nullable();
            $table->string('received')->nullable();
            $table->string('pay_type')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('mpesa_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();

            $table->foreign('user_id')->references('id')->on('dineusers')->onUpdate('cascade');
            $table->foreign('mpesa_id')->references('id')->on('lnmo_api_response')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('payment_details')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase');
    }
};
