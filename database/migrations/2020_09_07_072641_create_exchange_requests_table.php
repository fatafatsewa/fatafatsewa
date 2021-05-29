<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('contact_number');
            $table->string('citizenship_front', 500);
            $table->string('citizenship_back', 500);
            $table->integer('users_phone_id')->nullable();
            $table->string('phone_model')->nullable();
            $table->string('imei_number');
            $table->string('purchased_at', 20)->nullable();
            // $table->string('phone_condition')->nullable();
            $table->string('purchase_price')->nullable();
            $table->string('phone_condition')->nullable();
            $table->string('phone_problems')->nullable();
            $table->integer('exchange_product_id');
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
        Schema::dropIfExists('exchange_requests');
    }
}
