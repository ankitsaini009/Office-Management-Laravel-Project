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
        Schema::create('attendence_deatails', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('salary_id')->nullable()->constrained('salaries')->onDelete('cascade');
            $table->string('month', 7);
            $table->integer('working_days')->default(0);
            $table->integer('leave_days')->default(0);
            $table->integer('half_days')->default(0);
            $table->decimal('total_salary', 10,2)->default(0);
            $table->string('pay_status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendence_deatails');
    }
};
