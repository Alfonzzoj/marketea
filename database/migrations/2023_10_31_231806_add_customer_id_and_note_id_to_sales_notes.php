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
        Schema::table('sales_notes', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->after('id');
            $table->unsignedBigInteger('note_id')->after('customer_id');

            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('note_id')->references('id')->on('notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sales_notes', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['note_id']);
            $table->dropColumn(['customer_id', 'note_id']);
        });
    }
};
