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
                'meta_title' => 'Gia Hưng JSC - Dây đồng và cáp điện',
                'meta_description' => 'Cung cấp dây đồng, cáp điện và vật tư công nghiệp cho nhà thầu, đại lý và nhà máy trên toàn quốc.',
                'meta_keywords' => 'dây đồng, cáp điện, cuộn dây đồng, báo giá cáp điện',
                'logo' => 'favicon.png',
                'favicon' => 'favicon.png',
                'contact_email' => 'tuannm180220@gmail.com',
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
