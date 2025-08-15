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
        Schema::create('usulans', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->text('deskripsi');
            $table->string('pengusul', 100);
            $table->string('kode_wilayah', 50);
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->foreignId('skpd_id')->constrained('skpds')->cascadeOnDelete();
            $table->foreignId('periode_id')->constrained('periodes')->cascadeOnDelete();
            $table->foreignId('status_id')->constrained('status_usulans')->cascadeOnDelete();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('usulans', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
