<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->foreignId('company_id')->references('company_id')->on('companies');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email_address');
            $table->string('position');
            $table->string('city');
            $table->string('country');
            $table->string('image')->nullable();
            $table->enum('status', ['Active', 'Inactive']);
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
