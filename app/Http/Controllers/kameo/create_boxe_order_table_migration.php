<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoxeOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('boxe_orders', function (Blueprint $table) {
            // Columns
            $table->id();
            $table->decimal('installation_price', 10, 2);
            $table->decimal('amount', 10, 2);
            $table->date('estimated_delivery_date')
                ->nullable();
            $table->enum('status', ['new', 'confirmed', 'done'])
                ->default('new');
            $table->unsignedBigInteger('boxes_id')
                ->nullable();
            $table->unsignedBigInteger('boxes_catalog_id');
            $table->unsignedBigInteger('grouped_orders_id');
            $table->timestamps();
            // Keys
            $table->foreign('boxes_id')
                ->references('id')
                ->on('boxes')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('boxes_catalog_id')
                ->references('id')
                ->on('boxes_catalog')
                ->onDelete('restrict')
                ->onUpdate('restrict');
            $table->foreign('grouped_orders_id')
                ->references('id')
                ->on('grouped_orders')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('boxe_orders');
    }
}
