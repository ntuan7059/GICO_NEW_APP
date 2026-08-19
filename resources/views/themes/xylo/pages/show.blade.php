@extends('themes.xylo.layouts.master')

@section('title', $translation ? $translation->title : 'Page')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            @if($translation)
                <h1 class="mb-4">{{ $translation->title }}</h1>
                @if($translation->image_url)
                    <img src="{{ asset('storage/' . $translation->image_url) }}" alt="{{ $translation->title }}" class="img-fluid mb-4">
                @endif
                <div class="page-content">
                    {!! $translation->content !!}
                </div>
            @else
                <p>No content available for this page.</p>
            @endif
        </div>
    </div>
</div>
@endsection
