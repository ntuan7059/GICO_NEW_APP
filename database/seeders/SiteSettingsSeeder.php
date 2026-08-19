<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('site_settings')->insert([
            'site_name' => 'Công ty Cổ phần Gia Hưng',
            'tagline' => 'Giải pháp dây đồng và cáp điện cho công trình Việt',
            'meta_title' => 'Gia Hưng JSC - Dây đồng và cáp điện',
            'meta_description' => 'Cung cấp dây đồng, cáp điện và vật tư công nghiệp cho nhà thầu, đại lý và nhà máy trên toàn quốc.',
            'meta_keywords' => 'dây đồng, cáp điện, cáp điện lực, dây tiếp địa, báo giá cáp điện',
            'logo' => 'favicon.png',
            'favicon' => 'favicon.png',
            'contact_email' => 'tuannm180220@gmail.com',
            'contact_phone' => '0906 23 6863',
            'address' => '186 Nguyễn Tuân, Thanh Xuân, Hà Nội',
            'footer_text' => '© Công ty Cổ phần Gia Hưng. Mọi quyền được bảo lưu.',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
