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
        Schema::table('news', function (Blueprint $table) {
            $table->boolean('is_event')->default(false)->after('content');
            $table->date('event_date')->nullable()->after('is_event');
            $table->string('event_time')->nullable()->after('event_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['is_event', 'event_date', 'event_time']);
        });
    }
};
