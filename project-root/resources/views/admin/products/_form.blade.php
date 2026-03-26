@csrf

<div class="admin-form-grid">

    <!-- CATEGORY -->
    <div class="admin-form-group">
        <label>Danh mục</label>
        <select name="category_id" required>
            <option value="">-- Chọn danh mục --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- NAME -->
    <div class="admin-form-group">
        <label>Tên sản phẩm</label>
        <input type="text" name="name"
               value="{{ old('name', $product->name ?? '') }}" required>
    </div>

    <!-- SLUG -->
    <div class="admin-form-group">
        <label>Slug</label>
        <input type="text" name="slug"
               value="{{ old('slug', $product->slug ?? '') }}"
               placeholder="Tự tạo nếu bỏ trống">
    </div>

    <!-- SKU -->
    <div class="admin-form-group">
        <label>SKU</label>
        <input type="text" name="sku"
               value="{{ old('sku', $product->sku ?? '') }}">
    </div>

    <!-- PRICE -->
    <div class="admin-form-group">
        <label>Giá</label>
        <input type="number" name="price"
               value="{{ old('price', $product->price ?? 0) }}"
               required>
    </div>

    <!-- SALE PRICE -->
    <div class="admin-form-group">
        <label>Giá sale</label>
        <input type="number" name="sale_price"
               value="{{ old('sale_price', $product->sale_price ?? '') }}">
    </div>

    <!-- STOCK -->
    <div class="admin-form-group">
        <label>Tồn kho</label>
        <input type="number" name="stock"
               value="{{ old('stock', $product->stock ?? 0) }}"
               required>
    </div>

    <!-- IMAGE -->
    <div class="admin-form-group">
        <label>Ảnh (URL)</label>
        <input type="text" name="thumbnail"
               value="{{ old('thumbnail', $product->thumbnail ?? '') }}"
               placeholder="https://...">
    </div>

    <!-- SHORT DESC -->
    <div class="admin-form-group admin-form-group-full">
        <label>Mô tả ngắn</label>
        <textarea name="short_description" rows="3">
            {{ old('short_description', $product->short_description ?? '') }}
        </textarea>
    </div>

    <!-- DESC -->
    <div class="admin-form-group admin-form-group-full">
        <label>Mô tả chi tiết</label>
        <textarea name="description" rows="5">
            {{ old('description', $product->description ?? '') }}
        </textarea>
    </div>

    <!-- CARE -->
    <div class="admin-form-group admin-form-group-full">
        <label>Hướng dẫn chăm sóc</label>
        <textarea name="care_instructions" rows="4">
            {{ old('care_instructions', $product->care_instructions ?? '') }}
        </textarea>
    </div>

</div>

<!-- CHECKBOX -->
<div class="admin-checkbox-row">

    <label>
        <input type="checkbox" name="is_featured"
            {{ old('is_featured', $product->is_featured ?? false) ? 'checked' : '' }}>
        Nổi bật
    </label>

    <label>
        <input type="checkbox" name="is_active"
            {{ old('is_active', $product->is_active ?? true) ? 'checked' : '' }}>
        Đang bán
    </label>

</div>

<!-- ACTION -->
<div class="admin-form-actions">
    <a href="{{ route('admin.products.index') }}" class="admin-btn">Quay lại</a>

    <button type="submit" class="admin-btn admin-btn-primary">
        {{ isset($product) ? 'Cập nhật' : 'Thêm mới' }}
    </button>
</div>