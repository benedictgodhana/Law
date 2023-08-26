<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvocatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advocates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name');
            $table->string('contact_info');
            $table->string('specialization');
            $table->integer('experience_years');
            $table->string('bar_association_membership')->nullable();
            $table->string('education')->nullable();
            $table->string('license_number')->nullable();
            $table->string('languages_spoken')->nullable();
            $table->string('office_address')->nullable();
            $table->decimal('billing_rate', 10, 2)->nullable();
            $table->text('biography')->nullable();
            $table->string('profile_picture')->nullable(); // New profile picture field
            $table->string('social_media_links')->nullable();
            // Add other advocate-related fields as needed
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
        Schema::dropIfExists('advocates');
    }
}
