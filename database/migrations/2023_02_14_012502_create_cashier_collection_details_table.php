<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cashier_collection_details', function (Blueprint $table) {
            $table->increments('cd_id');
            $table->integer('account_id');
            $table->integer('fee_id');
            $table->integer('fee_type_id');
            $table->integer('balance_id');
            $table->integer('collection_id');
            $table->double('amount');
            $table->tinyInteger('is_active');
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
        Schema::dropIfExists('cashier_collection_details');
    }
};
