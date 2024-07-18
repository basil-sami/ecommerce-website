<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTimestampsToProductViewsTable extends Migration
{
    public function up()
    {
        Schema::table('product_views', function (Blueprint $table) {
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('product_views', function (Blueprint $table) {
            $table->dropTimestamps();
        });
    }
}


