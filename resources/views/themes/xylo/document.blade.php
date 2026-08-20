@extends('themes.xylo.layouts.master')

@section('title', 'Tài liệu kỹ thuật | Gia Hưng JSC')

@section('content')
<section class="document-hero">
    <div class="container">
        <span class="section-label">Thư viện kỹ thuật</span>
        <h1>Tài liệu sản phẩm</h1>
        <p>Tải xuống catalogue, thông số kỹ thuật và hồ sơ sản phẩm chính thức từ Gia Hưng.</p>
    </div>
</section>

<section class="document-library section-space">
    <div class="container">
        <div class="document-list">
            @forelse ($documents as $document)
                <article class="document-item">
                    <div class="document-icon"><i class="fa-regular fa-file-lines"></i></div>
                    <div class="document-copy">
                        <div class="document-meta">
                            <span>{{ optional($document->published_at)->format('d/m/Y') ?: $document->created_at->format('d/m/Y') }}</span>
                            <span>{{ $document->formatted_size }}</span>
                            <span>{{ strtoupper(pathinfo($document->original_name, PATHINFO_EXTENSION)) }}</span>
                        </div>
                        <h2>{{ $document->title }}</h2>
                        @if ($document->description)<p>{{ $document->description }}</p>@endif
                    </div>
                    <a class="document-download" href="{{ route('document.download', $document) }}" aria-label="Tải xuống {{ $document->title }}">
                        <span>Tải xuống</span><i class="fa-solid fa-arrow-down"></i>
                    </a>
                </article>
            @empty
                <div class="document-empty"><i class="fa-regular fa-folder-open"></i><h2>Chưa có tài liệu</h2><p>Tài liệu kỹ thuật đang được cập nhật. Vui lòng quay lại sau hoặc liên hệ bộ phận tư vấn.</p></div>
            @endforelse
        </div>
        <div class="mt-4">{{ $documents->links() }}</div>
    </div>
</section>
@endsection
