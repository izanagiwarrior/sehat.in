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
            $table->increments('id');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_category');

            $table->string('title');
            $table->string('photo');
            $table->text('description');

            // kandungan gizi
            $table->string('energy')->default(0);
            $table->string('protein')->default(0);
            $table->string('fat')->default(0);
            $table->string('carbohydrate')->default(0);
            $table->string('calorie')->default(0);
            $table->string('fiber')->default(0);
            $table->string('sodium')->default(0);
            $table->string('sugar')->default(0);
            $table->string('vitamin_a')->default(0);
            $table->string('vitamin_c')->default(0);
            $table->string('vitamin_d')->default(0);
            $table->string('vitamin_e')->default(0);
            $table->string('vitamin_k')->default(0);
            $table->string('calcium')->default(0);
            $table->string('magnesium')->default(0);
            $table->string('zinc')->default(0);
            $table->string('water')->default(0);
            $table->string('mineral')->default(0);

            $table->timestamps();

            $table->foreign('id_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('id_category')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade')->onUpdate('cascade');
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
