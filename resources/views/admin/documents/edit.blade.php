@extends('admin.layouts.admin')
@section('title', 'Chỉnh sửa tài liệu')
@section('content')
<div class="card mt-4">
    <div class="card-header card-header-bg text-white"><h6 class="mb-0">Chỉnh sửa tài liệu</h6></div>
    <div class="card-body">
        <form action="{{ route('admin.documents.update', $document) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.documents._form')
        </form>
    </div>
</div>
@endsection
