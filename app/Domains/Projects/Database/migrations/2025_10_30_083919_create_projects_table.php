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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->unsignedBigInteger('owner_id');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('budget_allocated')->default(0);
            $table->string('spent_amount')->default(0);
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Check on what are softDeletes 
            $table->unique(['tenant_id','slug']);
        });
    }

    /**
     * Reverse the migrations.
    */

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
