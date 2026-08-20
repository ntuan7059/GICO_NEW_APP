<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function index()
    {
        $documents = Document::query()
            ->where('status', true)
            ->where(function ($query) {
                $query->whereNull('published_at')->orWhereDate('published_at', '<=', today());
            })
            ->orderBy('sort_order')
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(20);

        return view('themes.xylo.document', compact('documents'));
    }

    public function download(Document $document)
    {
        abort_unless($document->status && (! $document->published_at || $document->published_at->isToday() || $document->published_at->isPast()), 404);
        abort_unless(Storage::disk('local')->exists($document->file_path), 404);

        return Storage::disk('local')->download($document->file_path, $document->original_name, [
            'Content-Type' => $document->mime_type ?: 'application/octet-stream',
        ]);
    }
}
