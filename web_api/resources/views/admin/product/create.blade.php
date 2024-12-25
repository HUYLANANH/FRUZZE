    <div class="flex flex-col items-start justify-start gap-2.5 p-5">
        {{-- heading --}}
        <div class="mb-10">
            <div class="self-stretch text-2xl font-bold leading-normal tracking-wide text-gray-800">
                Create a new freeze-dried fruit product
            </div>
        </div>

        {{-- form --}}
        <form class="flex flex-col md:flex-row w-full gap-6" id="create-product-form">
            {{-- left form --}}
            <div
                class="flex flex-col lg:w-3/4 items-start justify-start gap-2.5 rounded border bg-white border-zinc-200 p-2.5">
                <input class="self-stretch rounded border border-zinc-300 bg-white p-2.5 focus:outline-none" id="name"
                    name="name" placeholder="Product Name (e.g., Freeze-dried Mango)" />
                <div class="text-base font-semibold leading-tight text-gray-400">Description</div>
                <textarea class="h-[200px] self-stretch rounded border border-zinc-300 p-2.5 focus:outline-none" id="description"
                    name="description" placeholder="Write a detailed description of the freeze-dried fruit..."></textarea>
                <div class="text-base font-semibold leading-tight text-gray-400">Images <u>(up to 5 images)</u></div>
                <div class="flex flex-col w-full items-center justify-center">
                    <label
                        class="flex bg-primary hover:bg-primary-light text-white text-base px-5 py-3 outline-none rounded w-max cursor-pointer mx-auto"
                        for="images">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 mr-2 fill-white inline" viewBox="0 0 32 32">
                            <path
                                d="M23.75 11.044a7.99 7.99 0 0 0-15.5-.009A8 8 0 0 0 9 27h3a1 1 0 0 0 0-2H9a6 6 0 0 1-.035-12 1.038 1.038 0 0 0 1.1-.854 5.991 5.991 0 0 1 11.862 0A1.08 1.08 0 0 0 23 13a6 6 0 0 1 0 12h-3a1 1 0 0 0 0 2h3a8 8 0 0 0 .75-15.956z"
                                data-original="#000000" />
                            <path
                                d="M20.293 19.707a1 1 0 0 0 1.414-1.414l-5-5a1 1 0 0 0-1.414 0l-5 5a1 1 0 0 0 1.414 1.414L15 16.414V29a1 1 0 0 0 2 0V16.414z"
                                data-original="#000000" />
                        </svg>
                        Upload
                    </label>
                    <input class="hidden" id="images" name="assets[]" type="file" max="5" min="1" multiple />
                </div>
            </div>
            {{-- right form --}}
            <div
                class="flex flex-col items-start gap-[18px] self-stretch rounded border border-zinc-200 bg-white px-[15px] py-[19px]">
                <div class="text-base font-semibold leading-tight text-gray-400">Weight (grams)</div>
                <input class="self-stretch rounded border border-zinc-300 bg-white p-2.5 focus:outline-none" id="weight"
                    name="weight" type="number" min="0" placeholder="Enter weight in grams" />

                <div class="text-base font-semibold leading-tight text-gray-400">Fruit Type</div>
                <select class="self-stretch rounded border border-zinc-300 bg-white p-2.5 focus:outline-none" id="fruit_type"
                    name="fruit_type">
                    <option value="mango">Mango</option>
                    <option value="pineapple">Pineapple</option>
                    <option value="banana">Banana</option>
                    <option value="strawberry">Strawberry</option>
                    <option value="other">Other</option>
                </select>
                <div class="text-base font-semibold leading-tight text-gray-400">Regular Price (VND)</div>
                <input class="self-stretch rounded border border-zinc-300 bg-white p-2.5 focus:outline-none" id="regular_price"
                    name="regular_price" type="number" min="0" placeholder="Enter regular price" />
                <div class="text-base font-semibold leading-tight text-gray-400">Sale Price (VND)</div>
                <input class="self-stretch rounded border border-zinc-300 bg-white p-2.5 focus:outline-none" id="sale_price"
                    name="sale_price" type="number" min="0" placeholder="Enter sale price (if any)" />
                <button
                    class="inline-flex w-[340px] items-center justify-center gap-2.5 rounded bg-green-600 px-12 py-4 text-base font-semibold leading-tight text-neutral-50"
                    type="button" id="submit-product">
                    Create Product
                </button>
            </div>
        </form>
    </div>

    <script>
        const apiEndpoint = 'http://127.0.0.1:8000/api/product'; // Adjust this if necessary
        document.getElementById('submit-product').addEventListener('click', async () => {
            const formData = new FormData(document.getElementById('create-product-form'));

            const productData = {
                name: formData.get('name'),
                description: formData.get('description'),
                weight: parseInt(formData.get('weight'), 10),
                fruit_type: formData.get('fruit_type'),
                regular_price: parseFloat(formData.get('regular_price')),
                sale_price: parseFloat(formData.get('sale_price')),
            };

            try {
                const response = await fetch(apiEndpoint, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify(productData),
                });

                if (response.ok) {
                    const result = await response.json();
                    alert('Product created successfully!');
                    window.location.href = "{{ route('admin.products.index') }}";
                } else {
                    const error = await response.json();
                    alert('Error: ' + (error.message || 'Unable to create product.'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An unexpected error occurred.');
            }
        });
    </script>

