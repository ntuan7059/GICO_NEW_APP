<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProductionSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(LanguageSeeder::class);

        foreach ([
            ['name' => 'US Dollar', 'code' => 'USD', 'symbol' => '$', 'exchange_rate' => 1.0000],
            ['name' => 'Vietnamese Đồng', 'code' => 'VND', 'symbol' => '₫', 'exchange_rate' => 25000.0000],
        ] as $currency) {
            DB::table('currencies')->updateOrInsert(
                ['code' => $currency['code']],
                [...$currency, 'created_at' => now(), 'updated_at' => now()]
            );
        }

        DB::table('store_settings')->updateOrInsert(
            ['key' => 'default_currency'],
            ['value' => 'VND', 'created_at' => now(), 'updated_at' => now()]
        );

        DB::table('site_settings')->updateOrInsert(
            ['id' => 1],
            [
                'site_name' => 'Công ty Cổ phần Gia Hưng',
                'tagline' => 'Giải pháp dây đồng và cáp điện cho công trình Việt',
                'meta_title' => 'Dây đồng, dây điện từ & vật liệu cách điện | Gia Hưng JSC',
                'meta_description' => 'Gia Hưng cung cấp dây đồng, dây điện từ, dây đồng enamel và vật liệu cách điện có hồ sơ kỹ thuật, giao hàng toàn quốc.',
                'meta_keywords' => 'dây đồng, dây điện từ, dây đồng enamel, copper wire, magnet wire, vật liệu cách điện',
                'logo' => 'favicon.png',
                'favicon' => 'favicon.png',
                'contact_email' => 'gicovn186@gmail.com',
                'contact_phone' => '0906 23 6863',
                'address' => '186 Nguyễn Tuân, Thanh Xuân, Hà Nội',
                'footer_text' => '© Công ty Cổ phần Gia Hưng. Mọi quyền được bảo lưu.',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        $this->call(CopperCatalogSeeder::class);

        $adminEmail = env('ADMIN_EMAIL');
        $adminPassword = env('ADMIN_PASSWORD');
        if ($adminEmail && $adminPassword) {
            User::query()->updateOrCreate(
                ['email' => $adminEmail],
                ['name' => 'Gia Hưng Admin', 'password' => Hash::make($adminPassword), 'email_verified_at' => now()]
            );
        }
    }
}
