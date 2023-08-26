<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUserIdFromClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Drop the foreign key constraint
            $table->dropColumn('user_id'); // Drop the user_id column
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id'); // Recreate the user_id column
            $table->foreign('user_id')->references('id')->on('users'); // Recreate the foreign key constraint
        });
    }
}
