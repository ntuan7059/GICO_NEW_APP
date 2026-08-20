<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class DocumentController extends Controller
{
    public function index(): View
    {
        $documents = Document::query()->orderBy('sort_order')->orderByDesc('published_at')->orderByDesc('id')->paginate(20);

        return view('admin.documents.index', compact('documents'));
    }

    public function create(): View
    {
        return view('admin.documents.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request, true);
        $file = $request->file('file');
        $path = $file->storeAs('documents', Str::uuid().'.'.$file->getClientOriginalExtension(), 'local');

        Document::create(array_merge($data, [
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]));

        return redirect()->route('admin.documents.index')->with('success', 'Tài liệu đã được tải lên.');
    }

    public function edit(Document $document): View
    {
        return view('admin.documents.edit', compact('document'));
    }

    public function download(Document $document)
    {
        abort_unless(Storage::disk('local')->exists($document->file_path), 404);

        return Storage::disk('local')->download($document->file_path, $document->original_name, [
            'Content-Type' => $document->mime_type ?: 'application/octet-stream',
        ]);
    }

    public function update(Request $request, Document $document): RedirectResponse
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $newPath = $file->storeAs('documents', Str::uuid().'.'.$file->getClientOriginalExtension(), 'local');
            $oldPath = $document->file_path;
            $data = array_merge($data, [
                'file_path' => $newPath,
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'file_size' => $file->getSize(),
            ]);
            $document->update($data);
            Storage::disk('local')->delete($oldPath);
        } else {
            $document->update($data);
        }

        return redirect()->route('admin.documents.index')->with('success', 'Tài liệu đã được cập nhật.');
    }

    public function destroy(Document $document): RedirectResponse
    {
        Storage::disk('local')->delete($document->file_path);
        $document->delete();

        return redirect()->route('admin.documents.index')->with('success', 'Tài liệu đã được xóa.');
    }

    private function validated(Request $request, bool $fileRequired): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:2000'],
            'file' => [$fileRequired ? 'required' : 'nullable', 'file', 'mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,zip', 'max:20480'],
            'published_at' => ['nullable', 'date'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
            'status' => ['required', 'boolean'],
        ]);
    }
}
