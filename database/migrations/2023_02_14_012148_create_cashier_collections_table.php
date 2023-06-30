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
        Schema::create('cashier_collections', function (Blueprint $table) {
            $table->increments('col_id');
            $table->string('account_id');
            $table->tinyInteger('account_type')->comment('1 = College 2 = SHS 3 = Faculty 4 = Others');
            $table->integer('sem_id');
            $table->integer('ay_id');
            $table->date('collection_date');
            $table->double('amount');
            $table->integer('scholarship_id');
            $table->string('or_no');
            $table->string('remarks');
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
        Schema::dropIfExists('cashier_collections');
    }
};
