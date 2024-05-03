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
        Schema::create('vat_rates', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->char('country_id', 2)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('type', 13);
            $table->unsignedTinyInteger('value');
            $table->unique(['country_id', 'type', 'value']);
            $table->datetimes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vat_rates');
    }
};
