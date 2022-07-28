<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AccountInfo', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string("user_name",20)->unique()->comment("帳號");
            $table->string("password")->comment("密碼");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('AccountInfo');
    }
}
