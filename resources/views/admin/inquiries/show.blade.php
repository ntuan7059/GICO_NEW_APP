@extends('admin.layouts.admin')

@section('content')
<div class="row mt-4 g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header card-header-bg text-white"><h6 class="mb-0">Trao đổi với {{ $inquiry->name }}</h6></div>
            <div class="card-body" style="max-height:520px;overflow:auto;background:#f7f7f8">
                @foreach($inquiry->messages as $message)
                    <div class="d-flex mb-3 {{ $message->sender === 'admin' ? 'justify-content-end' : '' }}">
                        <div class="p-3 rounded-3 {{ $message->sender === 'admin' ? 'bg-primary text-white' : 'bg-white border' }}" style="max-width:78%">
                            <div>{{ $message->message }}</div>
                            <small class="opacity-75">{{ $message->sender === 'admin' ? 'Gia Hưng' : $inquiry->name }} · {{ $message->created_at->format('H:i d/m/Y') }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="card-footer">
                <form action="{{ route('admin.inquiries.reply', $inquiry) }}" method="POST" class="d-flex gap-2">@csrf
                    <textarea name="message" class="form-control" rows="2" required placeholder="Nhập phản hồi cho khách hàng..."></textarea>
                    <button class="btn btn-primary px-4">Gửi</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card"><div class="card-body">
            <h5>Thông tin yêu cầu</h5>
            <p><strong>Sản phẩm:</strong><br>{{ optional(optional($inquiry->product)->translation)->name ?? 'Yêu cầu chung' }}</p>
            <p><strong>Điện thoại:</strong> {{ $inquiry->phone ?: '—' }}<br><strong>Email:</strong> {{ $inquiry->email ?: '—' }}<br><strong>Công ty:</strong> {{ $inquiry->company ?: '—' }}</p>
            <form action="{{ route('admin.inquiries.status', $inquiry) }}" method="POST">@csrf @method('PATCH')
                <select name="status" class="form-select mb-2">
                    <option value="open" @selected($inquiry->status === 'open')>Đang mở</option>
                    <option value="waiting_customer" @selected($inquiry->status === 'waiting_customer')>Chờ khách hàng</option>
                    <option value="closed" @selected($inquiry->status === 'closed')>Đã đóng</option>
                </select>
                <button class="btn btn-outline-secondary w-100">Cập nhật trạng thái</button>
            </form>
        </div></div>
    </div>
</div>
@endsection
