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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('skill_id')->constrained('skills');
            $table->string('course');
            $table->string('level');
            $table->bigInteger('price');
            $table->integer('time');
            $table->bigInteger('admin_fee');
            $table->bigInteger('total_price');
            $table->enum('status', ['Order', 'Agree', 'Come', 'Process', 'Done', 'PaymentFailed', 'Paid', 'Cancel']);
            $table->string('payment_code')->nullable();
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
        Schema::dropIfExists('transactions');
    }
};
