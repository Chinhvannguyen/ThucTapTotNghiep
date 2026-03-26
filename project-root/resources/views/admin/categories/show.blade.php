@extends('admin.layouts.app')

@section('title', 'Chi tiết danh mục')

@section('content')
<div class="admin-card">
    <h2 class="admin-card-title">{{ $category->name }}</h2>
    <div class="admin-detail-list">
        <div><strong>ID:</strong> {{ $category->id }}</div>
        <div><strong>Slug:</strong> {{ $category->slug }}</div>
        <div><strong>Trạng thái:</strong> {{ $category->status }}</div>
        <div><strong>Mô tả:</strong> {{ $category->description ?: '—' }}</div>
    </div>
</div>
@endsection