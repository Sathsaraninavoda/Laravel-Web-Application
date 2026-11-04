<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (! Schema::hasTable('vendors')) {
            Schema::create('vendors', function (Blueprint $table) {
                $table->id();
                $table->timestamps();
                $table->string('name');
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->text('address')->nullable();
                $table->string('city')->nullable();
                $table->string('country')->nullable();
                $table->enum('status', ['active', 'pending', 'inactive'])->default('pending');
                $table->string('contact_person')->nullable();
                $table->string('business_type')->nullable();
                $table->string('tax_number')->nullable();
            });

            return;
        }

        Schema::table('vendors', function (Blueprint $table) {
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->enum('status', ['active', 'pending', 'inactive'])->default('pending');
            $table->string('contact_person')->nullable();
            $table->string('business_type')->nullable();
            $table->string('tax_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('vendors')) {
            return;
        }

        Schema::table('vendors', function (Blueprint $table) {
            $table->dropColumn([
                'name', 'email', 'phone', 'address', 'city', 'country',
                'status', 'contact_person', 'business_type', 'tax_number'
            ]);
        });
    }
};
