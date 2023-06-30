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
        Schema::create('cashier_fees', function (Blueprint $table) {
            $table->increments('fee_id');
            $table->integer('fee_type_id');
            $table->string('name');
            $table->string('description');
            $table->double('cost');
            $table->integer('cabs');
            $table->tinyInteger('coverage')->comment('1 = Per Unit 2 = Per Student 3 = Per Subject 4 = Per Hour');
            $table->tinyInteger('frequency')->comment('Per AY (1 or 2)');
            $table->tinyInteger('year_level')->comment('1 = All year levels 2 = First year only');
            $table->integer('type')->comment('1 = Assessment 2 = Others');
            $table->integer('is_unifast')->default(0);
            $table->string('reference_number');
            $table->date('date_of_approval');
            $table->integer('account_type')->comment('1 = College 2 = SHS 3 = Faculty 4 = Others');
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
        Schema::dropIfExists('cashier_fees');
    }
};
