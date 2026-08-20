@extends('admin.layouts.admin')
@section('title', 'Quản lý tài liệu')
@section('content')
<div class="card mt-4">
    <div class="card-header card-header-bg text-white d-flex align-items-center justify-content-between">
        <h6 class="mb-0">Quản lý tài liệu kỹ thuật</h6>
        <a class="btn btn-light btn-sm" href="{{ route('admin.documents.create') }}"><i class="fas fa-upload me-1"></i>Tải tài liệu mới</a>
    </div>
    <div class="card-body">
        @if (session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead><tr><th>Thứ tự</th><th>Tài liệu</th><th>Ngày đăng</th><th>Dung lượng</th><th>Trạng thái</th><th class="text-end">Thao tác</th></tr></thead>
                <tbody>
                @forelse ($documents as $document)
                    <tr>
                        <td>{{ $document->sort_order }}</td>
                        <td><strong>{{ $document->title }}</strong><small class="d-block text-muted">{{ $document->original_name }}</small></td>
                        <td>{{ optional($document->published_at)->format('d/m/Y') ?: 'Ngay lập tức' }}</td>
                        <td>{{ $document->formatted_size }}</td>
                        <td><span class="badge {{ $document->status ? 'bg-success' : 'bg-secondary' }}">{{ $document->status ? 'Hiển thị' : 'Ẩn' }}</span></td>
                        <td class="text-end">
                            <a class="btn btn-sm btn-outline-primary" href="{{ route('admin.documents.download', $document) }}" title="Tải xuống"><i class="fas fa-download"></i></a>
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('admin.documents.edit', $document) }}" title="Chỉnh sửa"><i class="fas fa-pen"></i></a>
                            <form class="d-inline" action="{{ route('admin.documents.destroy', $document) }}" method="POST" onsubmit="return confirm('Xóa tài liệu này? Tệp đã tải lên cũng sẽ bị xóa.');">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" type="submit" title="Xóa"><i class="fas fa-trash"></i></button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td class="text-center text-muted py-5" colspan="6">Chưa có tài liệu. Hãy tải tài liệu đầu tiên.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
        {{ $documents->links() }}
    </div>
</div>
@endsection
