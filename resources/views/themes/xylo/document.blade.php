@extends('themes.xylo.layouts.master')

@section('title', 'Tài liệu kỹ thuật')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h1>Tài liệu kỹ thuật</h1>
            </div>

            <div class="document-table-container">
                <table class="document-table">
                    <thead>
                        <tr>
                            <th width="120">STT</th>
                            <th width="100">Ngày đăng</th>
                            <th width="250">Tên tài liệu</th>
                            <th width="80">Tải về</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($documents as $index => $document)
                            <tr class="{{ $index % 2 === 0 ? 'even-row' : 'odd-row' }}">
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td class="text-center">{{ $document->date }}</td>
                                <td>
                                    <a href="{{ $document->download_url }}" class="document-link" title="{{ $document->name }}">
                                        {{ $document->name }}
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{ $document->download_url }}" class="download-btn" title="Tải về">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.page-header h1 {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 30px;
    color: #333;
    border-bottom: 2px solid #1a356a;
    padding-bottom: 10px;
}

.document-table-container {
    background: #fff;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    padding: 20px;
}

.document-table {
    width: 100%;
    border-collapse: collapse;
}

.document-table thead {
    background: #1a356a;
    color: #fff;
}

.document-table th {
    padding: 12px;
    text-align: center;
    font-weight: 600;
    font-size: 14px;
}

.document-table td {
    padding: 12px;
    border-bottom: 1px solid #e0e0e0;
    vertical-align: middle;
}

.even-row {
    background: #f9f9f9;
}

.odd-row {
    background: #e2e2e2;
}

.document-link {
    color: #333;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s;
}

.document-link:hover {
    color: #1a356a;
    text-decoration: underline;
}

.download-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    background: #1a356a;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
    transition: background 0.3s;
}

.download-btn:hover {
    background: #2a458a;
}

.download-btn i {
    font-size: 16px;
}
</style>
@endsection
