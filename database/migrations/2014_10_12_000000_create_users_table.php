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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->unique();
            $table->string('iso_code', 10);
            $table->string('country_code', 10);
            $table->enum('role', ['Super', 'Admin', 'Tentor', 'Student']);
            $table->enum('status', ['Pending', 'Active', 'Banned', 'Deleted']);
            $table->enum('gender', ['Male', 'Female']);
            $table->bigInteger('rating_score')->default(0);
            $table->bigInteger('balance')->default(0);
            $table->boolean('is_online')->default(false);
            $table->boolean('is_verified')->default(false);
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
