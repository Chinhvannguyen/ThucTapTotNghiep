@extends('admin.layouts.app')

@section('title', 'Thêm danh mục')

@section('content')
<div class="admin-card">
    <form method="POST" action="{{ route('admin.categories.store') }}">
        @include('admin.categories._form')
    </form>
</div>
@endsection