@extends('layouts.admin')

@section('content')
<div id="app" class="flex flex-col items-center justify-start gap-2.5 p-5">
    <!-- Header -->
    <div class="flex items-center justify-between w-full mb-10">
        <div>
            <div class="self-stretch text-2xl font-bold leading-normal tracking-wide text-gray-800">
                Product List
            </div>
        </div>
        <div>
            <a href="/products/create" class="bg-primary px-4 py-2 rounded font-semibold hover:bg-primary-dark">New Product</a>
        </div>
    </div>

    <!-- Stats -->
    <div class="w-full grid gap-6 md:grid-cols-3 mb-8">
        <div class="p-6 border rounded bg-white">
            <div><span class="font-medium">Total Products</span></div>
            <div class="text-3xl font-semibold" id="total-products">0</div>
        </div>
        <div class="p-6 border rounded bg-white">
            <div><span class="font-medium">Product Inventory</span></div>
            <div class="text-3xl font-semibold" id="total-quantity">0</div>
        </div>
        <div class="p-6 border rounded bg-white">
            <div><span class="font-medium">Average Price</span></div>
            <div class="text-3xl font-semibold" id="average-price">0.00</div>
        </div>
    </div>

    <!-- Product Table -->
    <div class="flex flex-col items-start justify-start gap-2.5 self-stretch rounded border border-divider bg-white py-5 shadow">
        <!-- Search -->
        <div class="flex items-center justify-center gap-4 self-stretch px-4">
            <form id="search-form" class="relative flex w-full">
                <input
                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-4 text-sm"
                    id="search-input"
                    type="search"
                    placeholder="Search..."
                />
            </form>
        </div>

        <!-- Product List -->
        <div class="w-full overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr>
                        <td class="w-[30px] px-6 py-4 text-left font-bold text-gray-600">#</td>
                        <td class="w-2/5 px-6 py-4 text-left font-bold text-gray-600">Product</td>
                        <td class="px-6 py-4 text-left font-bold text-gray-600">Price</td>
                        <td class="px-6 py-4 text-left font-bold text-gray-600">Quantity</td>
                        <td class="px-6 py-4 text-center font-bold text-gray-600">Actions</td>
                    </tr>
                </thead>
                <tbody id="product-list">
                    <!-- Products will be dynamically inserted here -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const apiEndpoint = '/api/product';
    const app = document.getElementById('app');
    const productList = document.getElementById('product-list');
    const totalProductsEl = document.getElementById('total-products');
    const totalQuantityEl = document.getElementById('total-quantity');
    const averagePriceEl = document.getElementById('average-price');

    // Fetch products from API
    async function fetchProducts() {
        try {
            const response = await fetch(apiEndpoint);
            if (!response.ok) throw new Error('Failed to fetch products');
            const data = await response.json();

            const products = data.products || [];
            // Update stats
            totalProductsEl.textContent = products.length;
            totalQuantityEl.textContent = products.reduce((sum, product) => sum + product.quantity, 0);
            averagePriceEl.textContent = (
                products.reduce((sum, product) => sum + product.price, 0) / (products.length || 1)
            ).toFixed(2);

            // Update product list
            productList.innerHTML = products.map((product, index) => `
                <tr>
                    <td class="border-b px-6 py-4">${index + 1}</td>
                    <td class="border-b px-6 py-4">${product.name}</td>
                    <td class="border-b px-6 py-4">${product.price}₫</td>
                    <td class="border-b px-6 py-4">${product.quantity}</td>
                    <td class="border-b px-6 py-4 text-center">
                        <a href="/products/edit/${product.id}" class="text-blue-500">Edit</a>
                        <button onclick="deleteProduct(${product.id})" class="text-red-500">Delete</button>
                    </td>
                </tr>
            `).join('');
        } catch (error) {
            console.error('Error fetching products:', error);
        }
    }

    // Delete product
    async function deleteProduct(id) {
        if (confirm('Are you sure you want to delete this product?')) {
            try {
                const response = await fetch(`/api/product/${id}`, { method: 'DELETE' });
                if (!response.ok) throw new Error('Failed to delete product');
                fetchProducts();
            } catch (error) {
                console.error('Error deleting product:', error);
            }
        }
    }

    // Initial load
    fetchProducts();
</script>
