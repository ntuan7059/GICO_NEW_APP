<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'file_path', 'original_name', 'mime_type',
        'file_size', 'sort_order', 'status', 'published_at',
    ];

    protected $casts = [
        'status' => 'boolean',
        'published_at' => 'date',
    ];

    public function getFormattedSizeAttribute(): string
    {
        $bytes = max(0, (int) $this->file_size);
        if ($bytes < 1024) {
            return $bytes.' B';
        }
        if ($bytes < 1024 * 1024) {
            return number_format($bytes / 1024, 1).' KB';
        }

        return number_format($bytes / (1024 * 1024), 1).' MB';
    }
}
