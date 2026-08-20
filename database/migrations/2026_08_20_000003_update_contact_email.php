<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('site_settings')
            ->where('contact_email', 'tuannm180220@gmail.com')
            ->update(['contact_email' => 'gicovn186@gmail.com']);

        if (! DB::table('users')->where('email', 'gicovn186@gmail.com')->exists()) {
            DB::table('users')
                ->where('email', 'tuannm180220@gmail.com')
                ->update(['email' => 'gicovn186@gmail.com']);
        }
    }

    public function down(): void
    {
        DB::table('site_settings')
            ->where('contact_email', 'gicovn186@gmail.com')
            ->update(['contact_email' => 'tuannm180220@gmail.com']);

        DB::table('users')
            ->where('email', 'gicovn186@gmail.com')
            ->update(['email' => 'tuannm180220@gmail.com']);
    }
};
