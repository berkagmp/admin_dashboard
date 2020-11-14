<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailQueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_queue', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('recipient', 100);
            $table->string('cc')->nullable();
            $table->string('subject', 150);
            $table->string('body');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });

        Schema::create('email_queue_log', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('recipient', 100);
            $table->string('cc')->nullable();
            $table->string('subject', 150);
            $table->string('body');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_queue_log');
        Schema::dropIfExists('email_queue');
    }
}
