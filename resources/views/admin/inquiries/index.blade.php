@extends('admin.layouts.admin')

@section('content')
<div class="card mt-4">
    <div class="card-header card-header-bg text-white d-flex justify-content-between align-items-center">
        <h6 class="mb-0">Yêu cầu báo giá & trò chuyện</h6>
        <span class="badge bg-light text-dark">{{ $inquiries->total() }} yêu cầu</span>
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead><tr><th>Khách hàng</th><th>Sản phẩm</th><th>Liên hệ</th><th>Tin nhắn</th><th>Trạng thái</th><th>Cập nhật</th><th></th></tr></thead>
            <tbody>
            @forelse($inquiries as $inquiry)
                <tr>
                    <td><strong>{{ $inquiry->name }}</strong><br><small>{{ $inquiry->company }}</small></td>
                    <td>{{ optional(optional($inquiry->product)->translation)->name ?? 'Yêu cầu chung' }}</td>
                    <td>{{ $inquiry->phone ?: $inquiry->email }}</td>
                    <td>{{ $inquiry->messages_count }}</td>
                    <td><span class="badge {{ $inquiry->status === 'closed' ? 'bg-secondary' : 'bg-warning text-dark' }}">{{ $inquiry->status }}</span></td>
                    <td>{{ optional($inquiry->last_message_at)->format('H:i d/m/Y') }}</td>
                    <td><a class="btn btn-sm btn-primary" href="{{ route('admin.inquiries.show', $inquiry) }}">Mở chat</a></td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center py-5">Chưa có yêu cầu nào.</td></tr>
            @endforelse
            </tbody>
        </table>
        {{ $inquiries->links() }}
    </div>
</div>
@endsection
