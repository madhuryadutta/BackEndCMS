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
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_category_id');
            $table->foreign('fk_category_id')->references('id')->on('categories');
            $table->string('title');
            $table->longText('content_text');
            $table->string('content_tags')->nullable();
            $table->unsignedinteger('user_id');
            $table->enum('status', ['Published', 'Draft', 'Deleted'])->default('Draft');
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
        Schema::dropIfExists('contents');
    }
};
