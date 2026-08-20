<?php

namespace App\Repositories\Admin\Banner;

use App\Models\Banner;
use App\Models\BannerTranslation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class BannerRepository implements BannerRepositoryInterface
{
    // Get all banners with translations
    public function getAllBanners(): Collection
    {
        return Banner::with('translations')->orderBy('sort_order')->orderByDesc('created_at')->get();
    }

    // Get a banner by its ID
    public function getBannerById(int $id): Banner
    {
        return Banner::findOrFail($id);
    }

    // Create a new banner
    public function createBanner(array $data): Banner
    {
        return Banner::create([
            'type' => $data['type'],
            'sort_order' => $data['sort_order'] ?? 0,
            'link_url' => $data['link_url'] ?? null,
        ]);
    }

    // Update the banner
    public function updateBanner(Banner $banner, array $data): Banner
    {
        $banner->type = $data['type'];
        $banner->sort_order = $data['sort_order'] ?? 0;
        $banner->link_url = $data['link_url'] ?? null;
        $banner->save();

        return $banner;
    }

    // Delete a banner
    public function deleteBanner(Banner $banner): bool
    {
        // Delete associated images if they exist
        $translations = BannerTranslation::where('banner_id', $banner->id)->get();
        foreach ($translations as $translation) {
            if ($translation->image_url && Storage::disk('public')->exists($translation->image_url)) {
                Storage::disk('public')->delete($translation->image_url);
            }
        }

        // Delete translations
        BannerTranslation::where('banner_id', $banner->id)->delete();

        // Delete the banner
        return $banner->delete();
    }
}
