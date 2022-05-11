<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            //   $table->morphs('tokenable');
               $table->string('title');
           //    $table->string('token', 64)->unique();
               $table->double('price',8,2);
               $table->string('image');
            //   $table->text('abilities')->nullable();
            //   $table->timestamp('last_used_at')->nullable();
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
        Schema::dropIfExists('products');
    }
}
