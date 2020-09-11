<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeUsersColumNotNullToNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('age')->nullable()->change();
            $table->string('married')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('type_of_wine')->nullable()->change();
            $table->string('verify_of_wine')->nullable()->change();
            $table->string('producing_area')->nullable()->change();
            $table->string('favorite_food')->nullable()->change();
            $table->string('price_range')->nullable()->change();
            $table->string('favorite_restaurant')->nullable()->change();
            $table->string('image')->default('')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('age')->nullable(false)->change();
            $table->string('married')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('type_of_wine')->nullable(false)->change();
            $table->string('verify_of_wine')->nullable(false)->change();
            $table->string('producing_area')->nullable(false)->change();
            $table->string('favorite_food')->nullable(false)->change();
            $table->string('price_range')->nullable(false)->change();
            $table->string('favorite_restaurant')->nullable(false)->change();
            $table->string('image')->default('')->nullable(false)->change();
        });
    }
}
