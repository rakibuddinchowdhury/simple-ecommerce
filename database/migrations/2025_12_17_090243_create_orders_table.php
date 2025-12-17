<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id'); // Connect to User
        $table->string('tracking_no');
        $table->string('fullname');
        $table->string('email')->nullable(); // <--- Added this
        $table->string('phone');
        $table->mediumText('address');
        $table->string('city')->nullable();     // Ensure this exists
        $table->string('zipcode')->nullable();  // Ensure this exists
        $table->string('status_message')->nullable(); // <--- Added this
        $table->string('payment_mode');
        $table->string('payment_id')->nullable();
        $table->tinyInteger('status')->default(0)->comment('0=Pending,1=Completed,2=Cancelled');
        $table->integer('total_price');
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
