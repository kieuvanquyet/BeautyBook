@extends('layouts.cashier')

@section('css')
@endsection

@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
                <h1 class="flex-grow-1 fs-3 fw-semibold my-2 my-sm-3">Tạo hóa đơn</h1>
                <nav class="flex-shrink-0 my-2 my-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('cashier.invoices.index') }}" style="color: inherit;">Hóa đơn</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Tạo hóa đơn</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->
    <div class="content">
        <form id="invoice-form" action="{{ route('cashier.invoices.store') }}" method="POST">
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Dịch vụ sử dụng</h3>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-lg-12 col-xl-8 offset-xl-2">
                            <div id="service-list" class="mb-4">
                                @if ($booking)
                                    @foreach ($booking->details as $service)
                                        <div class="product-item mb-3" data-service-id="{{ $service->service_id }}">
                                            <input type="hidden" name="services[{{ $service->service_id }}][id]"
                                                value="{{ $service->service_id }}">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <input type="text" name="services[{{ $service->service_id }}][name]"
                                                        class="form-control" value="{{ $service->service->name }}" readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number" name="services[{{ $service->service_id }}][price]"
                                                        class="form-control service-price" value="{{ $service->price }}"
                                                        readonly>
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="number"
                                                        name="services[{{ $service->service_id }}][quantity]"
                                                        class="form-control service-quantity" value="1" min="1">
                                                </div>
                                                <div class="col-md-3">
                                                    <input type="number"
                                                        name="services[{{ $service->service_id }}][total_price]"
                                                        class="form-control service-total-price"
                                                        value="{{ $service->price }}" readonly>
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button"
                                                        class="btn btn-danger btn-sm remove-service">Xóa</button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <select id="service-select" class="form-select">
                                        <option value="">Chọn sản phẩm</option>
                                        @foreach ($services as $service)
                                            <option value="{{ $service->id }}" data-name="{{ $service->name }}"
                                                data-price="{{ $service->price }}">
                                                {{ $service->name }} - {{ number_format($service->price) }} VNĐ
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <input type="number" id="service-quantity" class="form-control" placeholder="Số lượng"
                                        min="1" value="1">
                                </div>
                                <div class="col-md-3">
                                    <button type="button" id="add-service" class="btn btn-primary">Thêm dịch vụ</button>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end gap-3">
                                <p class="fw-bold">Tổng tiền: <span id="total-amount" class="text-danger">0 đ</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block block-rounded">
                <div class="block-content">
                    <h2 class="content-heading pt-0">Thông tin hóa đơn</h2>

                    <div class="row">
                        <div class="col-lg-12 col-xl-8 offset-xl-2">
                            <div class="mb-3">
                                <label class="form-label" for="name">Tên khách hàng</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger mt-2" id="name-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="phone">Số điện thoại</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="text-danger mt-2" id="phone-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="phone">Phương thức thanh toán</label>
                                <div class="d-flex gap-3">
                                    <label for="cash"><input id="cash" type="radio" name="payment_method"
                                            value="cash" {{ old('payment_method', 'cash') == 'cash' ? 'checked' : '' }}>
                                        Tiền mặt</label>
                                    <label for="transfer"><input id="transfer" type="radio" name="payment_method"
                                            value="transfer" {{ old('payment_method') == 'transfer' ? 'checked' : '' }}>
                                        Chuyển khoản</label>
                                </div>

                                @error('payment_method')
                                    <div class="text-danger mt-2" id="phone-error">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end gap-3">
                                <a href="{{ route('cashier.invoices.index') }}" class="btn btn-danger mb-3">Hủy giao
                                    dịch</a>
                                <button type="submit" class="btn btn-primary mb-3">Thanh toán</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const serviceSelect = document.getElementById('service-select');
            const serviceQuantityInput = document.getElementById('service-quantity');
            const addServiceButton = document.getElementById('add-service');
            const serviceListContainer = document.getElementById('service-list');
            const totalAmountSpan = document.getElementById('total-amount');
            const invoiceForm = document.getElementById('invoice-form');

            addServiceButton.addEventListener('click', addService);
            invoiceForm.addEventListener('submit', submitForm);

            function addService() {
                const selectedOption = serviceSelect.options[serviceSelect.selectedIndex];
                const quantity = parseInt(serviceQuantityInput.value, 10);

                if (selectedOption.value && quantity > 0) {
                    const product = {
                        id: selectedOption.value,
                        name: selectedOption.dataset.name,
                        price: parseFloat(selectedOption.dataset.price)
                    };

                    const totalPrice = product.price * quantity;

                    const existingItem = serviceListContainer.querySelector(`[data-service-id="${product.id}"]`);
                    if (existingItem) {
                        updateExistingService(existingItem, quantity);
                    } else {
                        addServiceToList(product, quantity, totalPrice);
                    }
                    updateTotalAmount();
                    resetInputs();
                } else {
                    alert('Vui lòng chọn sản phẩm và nhập số lượng hợp lệ.');
                }
            }

            function updateExistingService(serviceItem, additionalQuantity) {
                const quantityInput = serviceItem.querySelector('.service-quantity');
                const totalPriceInput = serviceItem.querySelector('.service-total-price');
                const priceInput = serviceItem.querySelector('.service-price');

                const currentQuantity = parseInt(quantityInput.value, 10);
                const newQuantity = currentQuantity + additionalQuantity;
                const price = parseFloat(priceInput.value);
                const newTotalPrice = price * newQuantity;

                quantityInput.value = newQuantity;
                totalPriceInput.value = newTotalPrice;
            }

            function addServiceToList(service, quantity, totalPrice) {
                const serviceItem = document.createElement('div');
                serviceItem.className = 'product-item mb-3';
                serviceItem.dataset.serviceId = service.id;
                serviceItem.innerHTML = `
            <input type="hidden" name="services[${service.id}][id]" value="${service.id}">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" name="services[${service.id}][name]" class="form-control" value="${service.name}" readonly>
                </div>
                <div class="col-md-2">
                    <input type="number" name="services[${service.id}][price]" class="form-control service-price" value="${service.price}" readonly>
                </div>
                <div class="col-md-2">
                    <input type="number" name="services[${service.id}][quantity]" class="form-control service-quantity" value="${quantity}" min="1">
                </div>
                <div class="col-md-3">
                    <input type="number" name="services[${service.id}][total_price]" class="form-control service-total-price" value="${totalPrice}" readonly>
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger btn-sm remove-service">Xóa</button>
                </div>
            </div>
        `;

                serviceListContainer.appendChild(serviceItem);

                const removeButton = serviceItem.querySelector('.remove-service');
                removeButton.addEventListener('click', () => removeProduct(serviceItem));

                const quantityInput = serviceItem.querySelector('.service-quantity');
                quantityInput.addEventListener('change', () => updateProductTotal(serviceItem));
            }

            function removeProduct(serviceItem) {
                serviceItem.remove();
                updateTotalAmount();
            }

            function updateProductTotal(serviceItem) {
                const priceInput = serviceItem.querySelector('.service-price');
                const quantityInput = serviceItem.querySelector('.service-quantity');
                const totalPriceInput = serviceItem.querySelector('.service-total-price');

                const price = parseFloat(priceInput.value);
                const quantity = parseInt(quantityInput.value, 10);
                const totalPrice = price * quantity;

                totalPriceInput.value = totalPrice;
                updateTotalAmount();
            }

            function updateTotalAmount() {
                const totalPriceInputs = document.querySelectorAll('.service-total-price');
                const total = Array.from(totalPriceInputs).reduce((sum, input) => sum + parseFloat(input.value), 0);
                totalAmountSpan.textContent = formatCurrency(total);
            }

            function resetInputs() {
                serviceSelect.selectedIndex = 0;
                serviceQuantityInput.value = '1';
            }

            function formatCurrency(amount) {
                return new Intl.NumberFormat('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                }).format(amount);
            }

            function submitForm(event) {
                event.preventDefault();
                // Thực hiện xác thực nếu cần
                // Nếu hợp lệ, gửi form
                this.submit();
            }

            updateTotalAmount();
        });
    </script>
@endsection
