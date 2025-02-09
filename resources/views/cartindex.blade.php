@extends('layouts.app')
@section('cart')
    <a href="{{ route('cart.index') }}" class="position-relative me-4 my-auto">
        <i class="fa fa-shopping-bag fa-2x"></i>
        <span
            class="position-absolute bg-secondary rounded-circle d-flex align-items-center justify-content-center text-dark px-1"
            style="top: -5px; left: 15px; height: 20px; min-width: 20px;">{{ $cartCount }}</span>
    </a>
@endsection

@section('content')
    <!-- Cart Page Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Products</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Handle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cartItems as $item)
                            <tr>
                                <th scope="row">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $item->image }}" class="img-fluid me-5 rounded-circle"
                                            style="width: 80px; height: 80px;" alt="">
                                    </div>
                                </th>
                                <td>
                                    <p class="mb-0 mt-4">{{ $item->name }}</p>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">Rp {{ number_format($item->price, 2) }}</p>
                                </td>
                                <td>
                                    <div class="input-group quantity mt-4" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-minus rounded-circle bg-light border">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm text-center border-0"
                                            value="{{ $item->quantity }}" data-id="{{ $item->id }}">
                                        <div class="input-grosup-btn">
                                            <button class="btn btn-sm btn-plus rounded-circle bg-light border">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <p class="mb-0 mt-4">Rp {{ number_format($item->price * $item->quantity, 2) }}</p>
                                </td>
                                <td>
                                    <button class="btn btn-md rounded-circle bg-light border mt-4 btn-delete"
                                        data-id="{{ $item->id }}">
                                        <i class="fa fa-times text-danger"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row g-4 justify-content-end">
                <div class="col-8"></div>
                <div class="col-sm-8 col-md-7 col-lg-6 col-xl-4">
                    <div class="bg-light rounded">
                        <div class="p-4">
                            <h1 class="display-6 mb-4">Cart <span class="fw-normal">Total</span></h1>
                            <div class="d-flex justify-content-between mb-4">
                                <h5 class="mb-0 me-4">Subtotal:</h5>
                                <p class="mb-0">Rp {{ number_format($cartSubtotal, 2) }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h5 class="mb-0 me-4">Shipping</h5>
                                <div class="">
                                    <p class="mb-0">Flat rate: 0</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-4 mb-4 border-top border-bottom d-flex justify-content-between">
                            <h5 class="mb-0 ps-4 me-4">Total</h5>
                            <p class="mb-0 pe-4">Rp {{ number_format($cartSubtotal, 2) }}</p>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="btn border-secondary rounded-pill px-4 py-3 text-primary text-uppercase mb-4 ms-4"
                            type="button">Proceed Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart Page End -->
@endsection
@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            document.querySelectorAll('.btn-delete').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const cartItemId = this.getAttribute('data-id');
                    fetch('/cart/' + cartItemId, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.closest('tr').remove();
                                alert('Product removed from cart');
                                location.reload();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            document.querySelectorAll('.btn-plus').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    var input = this.closest('.input-group').querySelector('input');
                    var currentVal = parseInt(input.value);
                    if (!isNaN(currentVal)) {
                        var newVal = currentVal;
                        input.value = newVal;
                        updateCartItem(input.dataset.id, newVal);
                    }
                });
            });

            document.querySelectorAll('.btn-minus').forEach(function(button) {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    var input = this.closest('.input-group').querySelector('input');
                    var currentVal = parseInt(input.value);
                    if (!isNaN(currentVal) && currentVal > 1) {
                        var newVal = currentVal;
                        input.value = newVal;
                        updateCartItem(input.dataset.id, newVal);
                    }
                });
            });

            function updateCartItem(cartItemId, quantity) {
                fetch('/cart/update/' + cartItemId, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            quantity: quantity
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('Quantity updated');
                            alert('Quantity updated successfully. Quantity : ' + data.quantity);
                            location.reload();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    </script>
@endpush
