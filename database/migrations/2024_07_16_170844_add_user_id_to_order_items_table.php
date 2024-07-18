<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalQuantityAndUserIdToOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Add total_quantity column
            $table->integer('total_quantity')->default(0);

            // Add user_id foreign key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            // Drop total_quantity column
            $table->dropColumn('total_quantity');

            // Drop user_id foreign key
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}

