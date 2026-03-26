@csrf

<div class="admin-form-grid">
    <div class="admin-form-group">
        <label>Tên danh mục</label>
        <input type="text" name="name" value="{{ old('name', $category->name ?? '') }}" required>
        @error('name') <div class="admin-error">{{ $message }}</div> @enderror
    </div>

    <div class="admin-form-group">
        <label>Slug</label>
        <input type="text" name="slug" value="{{ old('slug', $category->slug ?? '') }}" placeholder="Để trống sẽ tự tạo">
        @error('slug') <div class="admin-error">{{ $message }}</div> @enderror
    </div>

    <div class="admin-form-group admin-form-group-full">
        <label>Mô tả</label>
        <textarea name="description" rows="5">{{ old('description', $category->description ?? '') }}</textarea>
        @error('description') <div class="admin-error">{{ $message }}</div> @enderror
    </div>

    <div class="admin-form-group">
        <label>Trạng thái</label>
        <select name="status" required>
            <option value="active" {{ old('status', $category->status ?? 'active') === 'active' ? 'selected' : '' }}>active</option>
            <option value="inactive" {{ old('status', $category->status ?? 'active') === 'inactive' ? 'selected' : '' }}>inactive</option>
        </select>
        @error('status') <div class="admin-error">{{ $message }}</div> @enderror
    </div>
</div>

<div class="admin-form-actions">
    <a href="{{ route('admin.categories.index') }}" class="admin-btn admin-btn-light">Quay lại</a>
    <button type="submit" class="admin-btn admin-btn-primary">
        {{ isset($category) ? 'Cập nhật danh mục' : 'Thêm danh mục' }}
    </button>
</div>