<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {

            $table->string('category')->nullable();
            $table->text('product_service')->nullable();
            $table->integer('rating')->nullable();

            $table->string('tax_id')->nullable();

            $table->string('payment_method')->nullable();
            $table->string('payment_terms')->nullable();

            $table->decimal('contract_value',10,2)->nullable();

            $table->text('billing_address')->nullable();
            $table->string('shipping_terms')->nullable();
            $table->text('shipping_address')->nullable();

            $table->string('primary_contact')->nullable();
            $table->string('email')->nullable();
            $table->string('vendor_location')->nullable();

            $table->date('contract_start')->nullable();
            $table->date('contract_end')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'product_service',
                'rating',
                'tax_id',
                'payment_method',
                'payment_terms',
                'contract_value',
                'billing_address',
                'shipping_terms',
                'shipping_address',
                'primary_contact',
                'email',
                'vendor_location',
                'contract_start',
                'contract_end'
            ]);
        });
    }
};