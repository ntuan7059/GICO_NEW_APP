<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $banners = [
            [
                'key' => 'gico-default-banner-1',
                'image' => 'gicobanner1.png',
                'sort_order' => 10,
                'vi_title' => 'Dây đồng chất lượng cho sản xuất',
                'vi_description' => 'Nguồn vật tư ổn định, tư vấn đúng quy cách.',
                'en_title' => 'Quality copper wire for manufacturing',
                'en_description' => 'Reliable supply with specification-focused advice.',
            ],
            [
                'key' => 'gico-default-banner-2',
                'image' => 'gicobanner2.jpg',
                'sort_order' => 20,
                'vi_title' => 'Vật liệu kim loại công nghiệp',
                'vi_description' => 'Giải pháp phù hợp cho nhà máy và công trình.',
                'en_title' => 'Industrial metal materials',
                'en_description' => 'Practical solutions for factories and construction projects.',
            ],
            [
                'key' => 'gico-default-banner-3',
                'image' => 'gicobanner3.jpg',
                'sort_order' => 30,
                'vi_title' => 'Đồng công nghiệp đa dạng quy cách',
                'vi_description' => 'Hồ sơ minh bạch, giao hàng trên toàn quốc.',
                'en_title' => 'Industrial copper in a wide range of specifications',
                'en_description' => 'Transparent documentation and nationwide delivery.',
            ],
        ];

        foreach ($banners as $item) {
            if (DB::table('banners')->where('title', $item['key'])->exists()) {
                continue;
            }

            $bannerId = DB::table('banners')->insertGetId([
                'title' => $item['key'],
                'status' => 1,
                'type' => 'featured',
                'sort_order' => $item['sort_order'],
                'link_url' => '/product',
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('banner_translations')->insert([
                [
                    'banner_id' => $bannerId,
                    'language_code' => 'vi',
                    'title' => $item['vi_title'],
                    'description' => $item['vi_description'],
                    'image_url' => $item['image'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'banner_id' => $bannerId,
                    'language_code' => 'en',
                    'title' => $item['en_title'],
                    'description' => $item['en_description'],
                    'image_url' => $item['image'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }

    public function down(): void
    {
        $bannerIds = DB::table('banners')
            ->whereIn('title', ['gico-default-banner-1', 'gico-default-banner-2', 'gico-default-banner-3'])
            ->pluck('id');

        DB::table('banner_translations')->whereIn('banner_id', $bannerIds)->delete();
        DB::table('banners')->whereIn('id', $bannerIds)->delete();
    }
};
