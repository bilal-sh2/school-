<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     *
            * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('passoward');

            $table->string('Accuracy')->nullable(); // نوع الشهادة الحاصل عليها
            $table->string('birthdate')->nullable(); // العمر وتاريخ الميلاد
            $table->string('adress')->nullable(); // العنوان
            $table->string('parent_phone1')->nullable(); // رقم التواصل الاول
            $table->string('parent_phone2')->nullable(); // رقم التواصل الثاني

            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
