<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            //Leave Type ,from , to, numberofdays,RemainingDays ,LeaveReason,Status
            $table->bigInteger('emp_id')->unsigned();
            $table->foreign('emp_id')->references('id')->on('employees')->onDelete('cascade');
            $table->bigInteger('leave_type')->unsigned();
            $table->date('from');
            $table->date('to');

            $table->bigInteger('numberofdays')->unsigned();
            $table->bigInteger('status')->default('0')->unsigned(); // 0 that mean the employee is Pending
           // $table->tinyInteger('status')->default('1'); 
            //$table->bigInteger('remainingDays')->unsigned();
            $table->string('leave_reason')->nullable();
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
        Schema::dropIfExists('leaves');
    }
}
