<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sender_id");
            $table->unsignedBigInteger("product_id");
            $table->integer('status');
            $table->string("recipient_email");
            $table->string("recipient_phone");
            $table->string("recipient_country_code");
            $table->integer("quantity");
            $table->double("unit_price" , 8 , 2);
            $table->double("payed_amount" , 8 ,2);
            $table->timestamps();
            $table->foreign("sender_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing');
    }
}
