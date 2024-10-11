<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = "InnoDB";

            $table->bigIncrements('id');
            $table->string('prefixname', 255);
            $table->string('firstname', 255);
            $table->string('middlename', 255);
            $table->string('lastname', 255);
            $table->string('suffixname', 255);
            $table->string('username')->index();
            $table->string('email')->unique()->index();
            $table->text('password');
            $table->text('photo');
            $table->string('type', 255);
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
