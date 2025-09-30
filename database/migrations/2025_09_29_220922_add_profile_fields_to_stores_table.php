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
        Schema::table('stores', function (Blueprint $table) {
            $table->renameColumn('name', 'store_name');
            $table->renameColumn('description', 'store_description');
            $table->string('country')->nullable();
            $table->string('full_address')->nullable();
            $table->string('city')->nullable();
            $table->string('store_coverphoto')->nullable();
            $table->string('store_profilephoto')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->text('return_policy')->nullable();
            $table->text('shipping_policy')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->string('store_email')->nullable();
            $table->string('phone_number')->nullable();
            $table->json('business_hours')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->renameColumn('store_name', 'name');
            $table->renameColumn('store_description', 'description');
            $table->dropColumn([
                'country',
                'full_address',
                'city',
                'facebook',
                'twitter',
                'instagram',
                'return_policy',
                'shipping_policy',
                'privacy_policy',
                'store_email',
                'phone_number',
                'business_hours',
            ]);
        });
    }
};
