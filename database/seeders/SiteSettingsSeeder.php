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
        ]);
    }
}
