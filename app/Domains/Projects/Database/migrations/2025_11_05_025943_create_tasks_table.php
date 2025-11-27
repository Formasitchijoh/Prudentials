<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domains\Projects\Models\Project
;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('milestone_id')->nullable();
            $table->string('title');
            $table->string('description');
            $table->string('type')->default('task');
            $table->foreignId('assignee_id')->nullable();
            $table->foreignId('reporter_id')->nullable();
            $table->enum('status', ['todo', 'in_progress', 'blocked', 'review', 'done'])->default('done');
            $table->string('priority');
            $table->decimal('estimated_hours')->nullable();
            $table->decimal('actual_hours')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
