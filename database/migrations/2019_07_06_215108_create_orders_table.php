<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('set null');
                  
            $table->string('billing_email');
            $table->string('billing_name');
            $table->string('billing_address');
            $table->string('billing_phone');
            $table->string('billing_name_on_card');
            $table->string('billing_discount_code');
            $table->integer('billing_discount');
            $table->integer('billing_subtotal');
            $table->integer('billing_tax');
            $table->integer('billing_total');
            $table->string('payment_method')->default('stripe');
            $table->boolean('shipped')->default(false);
            $table->string('error')->nullable();

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
        Schema::dropIfExists('orders');
    }
}
