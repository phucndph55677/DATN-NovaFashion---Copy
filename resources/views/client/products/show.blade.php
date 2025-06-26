@extends('client.layouts.app')

@section('title', $product->name)

@section('content')
    <div class="container py-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white px-0">
                <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="row g-5">
            <!-- Hình ảnh sản phẩm -->
            <div class="col-md-6">
                <img src="{{ asset('storage/' . $product->image) }}" class="img-fluid border rounded w-100"
                    style="height: 495px; object-fit: cover;" alt="{{ $product->name }}">
            </div>

            <!-- Thông tin sản phẩm -->
            <div class="col-md-6">
                <h2 class="fw-bold text-dark" style="font-size: 28px;">{{ $product->name }}</h2>

                <p class="text-muted mb-2">
                    SKU: {{ $product->product_code }} &nbsp;|&nbsp; (0 đánh giá)
                </p>

                <!-- Giá sản phẩm -->
                <div class="d-flex align-items-center gap-3 mb-3">
                    @if ($sale && $sale < $price)
                        {{-- Giá sau giảm --}}
                        <span class="text-danger fs-4 fw-bold">{{ number_format($sale) }}đ</span>

                        {{-- Giá gốc (gạch ngang) --}}
                        <span class="text-muted text-decoration-line-through fs-6" style="margin-left: 10px;">
                            {{ number_format($price) }}đ
                        </span>

                        {{-- Phần trăm giảm giá --}}
                        <span class="badge fs-6 px-2 py-1" style="background-color: #ff5722; margin-left: 10px;">
                            -{{ floor((($price - $sale) / $price) * 100) }}%
                        </span>
                    @else
                        {{-- Nếu không có giá sale --}}
                        <span class="text-danger fs-4 fw-bold">{{ number_format($price) }}đ</span>
                    @endif
                </div>


                <div class="mb-3">
                    <label class="form-label fw-bold">Màu sắc:</label>
                    <div class="btn-group flex-wrap" role="group">
                        @foreach ($colors as $color)
                            <input type="radio" class="btn-check" name="color" id="color-{{ $color->id }}"
                                autocomplete="off">
                            <label class="btn btn-outline-dark mb-2" for="color-{{ $color->id }}">
                                {{ ucfirst($color->name) }}
                            </label>
                        @endforeach
                    </div>
                </div>


                <div class="mb-4">
                    <label class="form-label fw-bold">Chọn size:</label>
                    <div class="btn-group flex-wrap" role="group" aria-label="Size selector">
                        @foreach ($sizes as $size)
                            <input type="radio" class="btn-check" name="size" id="size-{{ $size->id }}"
                                autocomplete="off">
                            <label class="btn btn-outline-dark mb-2" for="size-{{ $size->id }}">
                                {{ strtoupper($size->name) }}
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="mb-4 d-flex align-items-center gap-3">
                    <label class="form-label fw-bold mb-0">Số lượng:</label>
                    <div class="input-group" style="width: 140px;">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(-1)">−</button>
                        <input type="number" id="quantityInput" class="form-control text-center" value="1"
                            min="1">
                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(1)">+</button>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-4">
                    <button class="btn btn-dark px-4 py-2">🛒 Thêm vào giỏ</button>
                    <button class="btn btn-outline-dark px-4 py-2">Mua ngay</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeQuantity(delta) {
            const input = document.getElementById('quantityInput');
            let val = parseInt(input.value) || 1;
            val += delta;
            if (val < 1) val = 1;
            input.value = val;
        }
    </script>
@endsection
