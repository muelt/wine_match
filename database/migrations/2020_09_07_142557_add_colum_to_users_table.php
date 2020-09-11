<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('age');
            $table->string('married');
            $table->string('address');
            $table->string('type_of_wine');
            $table->string('verify_of_wine');
            $table->string('producing_area');
            $table->string('favorite_food');
            $table->string('price_range');
            $table->string('favorite_restaurant');
            $table->string('image')->default('');
            $table->string('self_introduction', 500)->nullable();

            // プロフィールとしてテーブルを分けた方がいいか検討。ここを変えたらモデルのfillable(記載されているカラムのみ新規登録できる)も修正する。
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
            $table->dropColumn('age');
            $table->dropColumn('married');
            $table->dropColumn('address');
            $table->dropColumn('type_of_wine');
            $table->dropColumn('verify_of_wine');
            $table->dropColumn('producing_area');
            $table->dropColumn('favorite_food');
            $table->dropColumn('price_range');
            $table->dropColumn('favorite_restaurant');
            $table->dropColumn('image')->default('');
            $table->dropColumn('self_introduction', 500)->nullable();
        });
    }
}
