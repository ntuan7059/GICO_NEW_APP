<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BannerTranslation extends Model
{
    use HasFactory;

    // Define the fillable attributes
    protected $fillable = ['banner_id', 'language_code', 'title', 'description', 'image_url', 'type'];

    // Relationship with Banner
    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }

    public function getResolvedImageUrlAttribute(): ?string
    {
        if (! $this->image_url) {
            return null;
        }

        if (Str::startsWith($this->image_url, ['http://', 'https://'])) {
            return $this->image_url;
        }

        $bundledPath = ltrim($this->image_url, '/');
        if (is_file(public_path($bundledPath))) {
            return asset($bundledPath);
        }

        return Storage::disk('public')->url($this->image_url);
    }
}
