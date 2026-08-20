@if ($errors->any())
    <div class="alert alert-danger"><ul class="mb-0">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
@endif

<div class="row g-3">
    <div class="col-md-8">
        <label class="form-label" for="title">Tên tài liệu</label>
        <input class="form-control" id="title" name="title" value="{{ old('title', $document->title ?? '') }}" maxlength="255" required>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="published_at">Ngày đăng</label>
        <input class="form-control" id="published_at" name="published_at" type="date" value="{{ old('published_at', isset($document) && $document->published_at ? $document->published_at->format('Y-m-d') : now()->format('Y-m-d')) }}">
    </div>
    <div class="col-12">
        <label class="form-label" for="description">Mô tả ngắn</label>
        <textarea class="form-control" id="description" name="description" rows="3" maxlength="2000">{{ old('description', $document->description ?? '') }}</textarea>
    </div>
    <div class="col-md-8">
        <label class="form-label" for="file">Tệp tài liệu {{ isset($document) ? '(để trống nếu không thay đổi)' : '' }}</label>
        <input class="form-control" id="file" name="file" type="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt,.csv,.zip" {{ isset($document) ? '' : 'required' }}>
        <div class="form-text">PDF, Word, Excel, PowerPoint, TXT, CSV hoặc ZIP; tối đa 20 MB.</div>
        @isset($document)<div class="mt-2"><i class="fas fa-paperclip me-1"></i>{{ $document->original_name }} ({{ $document->formatted_size }})</div>@endisset
    </div>
    <div class="col-md-2">
        <label class="form-label" for="sort_order">Thứ tự</label>
        <input class="form-control" id="sort_order" name="sort_order" type="number" min="0" max="65535" value="{{ old('sort_order', $document->sort_order ?? 0) }}" required>
    </div>
    <div class="col-md-2">
        <label class="form-label" for="status">Trạng thái</label>
        <select class="form-select" id="status" name="status" required>
            <option value="1" @selected((string) old('status', isset($document) ? (int) $document->status : 1) === '1')>Hiển thị</option>
            <option value="0" @selected((string) old('status', isset($document) ? (int) $document->status : 1) === '0')>Ẩn</option>
        </select>
    </div>
</div>

<div class="mt-4">
    <button class="btn btn-primary" type="submit"><i class="fas fa-save me-1"></i>Lưu tài liệu</button>
    <a class="btn btn-outline-secondary" href="{{ route('admin.documents.index') }}">Quay lại</a>
</div>
