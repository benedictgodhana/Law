<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('advocate_id');
            $table->unsignedBigInteger('user_id')->unique();
            $table->string('name');
            $table->string('contact_info');
            $table->date('date_of_birth')->nullable();
            $table->text('case_details')->nullable();
            $table->string('case_status')->nullable();
            $table->text('relevant_dates')->nullable();
            $table->text('case_description')->nullable();
            $table->text('notes')->nullable();
            $table->string('image')->nullable(); // New image field
            // Add other client-related fields as needed
            $table->timestamps();

            $table->foreign('advocate_id')->references('id')->on('advocates');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
