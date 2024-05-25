<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\text;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('email')->unique();
            $table->text('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->text('tel')->nullable();
            $table->text('cel')->nullable();
            $table->tinyInteger('doc_type')->nullable();
            $table->text('doc_number')->nullable();
            $table->tinyInteger('status'); // 0: inactivo, 1:activo
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Artisan::call('db:seed', [
            '--class' => 'EmployeeSeeder',
            '--force' => true
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
