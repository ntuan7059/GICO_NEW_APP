<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('site_settings')->update([
            'meta_title' => 'Dây đồng, dây điện từ & vật liệu cách điện | Gia Hưng JSC',
            'meta_description' => 'Gia Hưng cung cấp dây đồng, dây điện từ, dây đồng enamel và vật liệu cách điện có hồ sơ kỹ thuật, giao hàng toàn quốc.',
            'meta_keywords' => 'dây đồng, dây điện từ, dây đồng enamel, copper wire, magnet wire, vật liệu cách điện',
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        // SEO copy changes are intentionally retained on rollback.
    }
};
