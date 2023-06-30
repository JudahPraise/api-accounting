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
        Schema::create('cashier_fee_types', function (Blueprint $table) {
            $table->increments('fee_type_id');
            $table->string('name');
            $table->tinyInteger('account_type')->comment('1 = College 2 = SHS 3 = Faculty 4 = Others');
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
        Schema::dropIfExists('cashier_fee_types');
    }
};
