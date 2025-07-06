<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('main_branch_name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('landline')->nullable();
            $table->string('logo')->nullable();
            $table->string('currency');
            $table->text('address')->nullable();
            $table->string('license_number')->unique();
            $table->string('commercial_record')->unique();
            $table->string('tax_number')->unique();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive', 'suspended'])->default('active');
            $table->date('license_expiry_date');
            $table->date('subscription_start_date')->nullable(); 
            $table->date('subscription_end_date')->nullable();   
            $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('agencies');
    }
};
