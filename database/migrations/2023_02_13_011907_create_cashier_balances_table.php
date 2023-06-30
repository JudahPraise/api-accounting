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
        Schema::create('cashier_balances', function (Blueprint $table) {
            $table->increments('bal_id');
            $table->integer('account_id');
            $table->tinyInteger('account_type')->comment('1 = College 2 = SHS 3 = Faculty 4 = Others');
            $table->integer('fee_id');
            $table->integer('fee_type_id');
            $table->integer('sem_id');
            $table->integer('ay_id');
            $table->double('cost');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('cashier_balances');
    }
};
