<?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support5\Facades\Schema;

   return new class extends Migration
   {
       public function up(): void
       {
           Schema::table('users', function (Blueprint $table) {
               // Mengubah tipe enum agar mengizinkan role constructor
               $table->enum('role', ['user', 'admin', 'constructor'])->default('user')->change();
           });
       }

       public function down(): void
       {
           Schema::table('users', function (Blueprint $table) {
               $table->enum('role', ['user', 'admin'])->default('user')->change();
           });
       }
   };