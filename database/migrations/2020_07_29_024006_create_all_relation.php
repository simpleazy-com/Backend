<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllRelation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admins', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groups');
        });

        Schema::table('members', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
        });

        Schema::table('set_payment', function(Blueprint $table){
            $table->foreign('group_id')->references('id')->on('groups');
        });

        Schema::table('member_payment_status', function(Blueprint $table){
            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('payment_id')->references('id')->on('set_payment');
        });

        Schema::table('log', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('group_id')->references('id')->on('groups');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admins', function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['group_id']);
        });

        Schema::table('members', function(Blueprint $table){
            $table->dropForeign(['user_id']);
        });

        Schema::table('set_payment', function(Blueprint $table){
            $table->dropForeign(['group_id']);
        });

        Schema::table('member_payment_status', function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['payment_id']);
        });

        Schema::table('log', function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['group_id']);
        });

    }
}
