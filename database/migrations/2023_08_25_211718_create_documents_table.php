<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('advocate_id');
            $table->string('document_name');
            $table->string('document_type')->nullable();
            $table->string('status')->nullable();
            $table->text('notes')->nullable();
            $table->string('file_path'); // This should store the path to the uploaded file
            $table->dateTime('upload_date');
            $table->string('document_file'); // Add the upload_date column
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('advocate_id')->references('id')->on('advocates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
}
