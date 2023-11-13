<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_card', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('percentage_id');
            $table->string('transaction_id');
            $table->enum('status' , [ 1, 2])->default(1);
            $table->string('email');
            $table->double('amount' , 8 , 2);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('percentage_id')->references('id')->on('selling_percentage')->onDelete('cascade');
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
        Schema::dropIfExists('selling_card');
    }
}
