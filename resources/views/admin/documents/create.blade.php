@extends('admin.layouts.admin')
@section('title', 'Tải tài liệu mới')
@section('content')
<div class="card mt-4">
    <div class="card-header card-header-bg text-white"><h6 class="mb-0">Tải tài liệu mới</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @include('admin.documents._form')
        </form>
    </div>
</div>
@endsection
