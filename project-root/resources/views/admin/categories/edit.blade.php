@extends('admin.layouts.app')

@section('title', 'Sửa danh mục')

@section('content')
<div class="admin-card">
    <form method="POST" action="{{ route('admin.categories.update', $category) }}">
        @method('PUT')
        @include('admin.categories._form')
    </form>
</div>
@endsection