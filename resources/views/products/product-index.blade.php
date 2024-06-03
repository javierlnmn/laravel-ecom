<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">

        <h1 class="font-extrabold uppercase text-4xl">All of our products</h1>

        <form action="{{ route('product.index') }}" method="GET">
            <div class="flex gap-4 items-center my-4 max-md:flex-col">
                <div class="w-full">
                    <x-breeze.input-label for="search-by" :value="'Type something to search by...'" />
                    <x-breeze.text-input id="search-by" value="{{request('searchBy')}}" placeholder="Type something to search by..." name="searchBy" type="text" class="mt-1 block w-full disabled:opacity-50" />
                </div>
                <div class="w-full">
                    <x-breeze.input-label for="order-by" :value="'Select an option to order by...'" />
                    <select
                        class="border-zinc-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm mt-1 block w-full cursor-pointer"
                        name="orderBy"
                        id="order-by"
                    >
                        <option value="" selected disabled>Select an option to order by</option>
                        <option value="created_at-desc" {{ request('orderBy') == 'created_at-desc' ? 'selected' : '' }}>Latest Products</option>
                        <option value="created_at-asc" {{ request('orderBy') == 'created_at-asc' ? 'selected' : '' }}>Oldest products</option>
                        <option value="discount-desc" {{ request('orderBy') == 'discount-desc' ? 'selected' : '' }}>Discount (descending)</option>
                        <option value="discount-asc" {{ request('orderBy') == 'discount-asc' ? 'selected' : '' }}>Discount (ascending)</option>
                        <option value="brand_id-desc" {{ request('orderBy') == 'brand_id-desc' ? 'selected' : '' }}>Brand (descending)</option>
                        <option value="brand_id-asc" {{ request('orderBy') == 'brand_id-asc' ? 'selected' : '' }}>Brand (ascending)</option>
                    </select>
                </div>
                <x-common.simple-button :text="'Search'" :additionalClasses="'md:!py-2 !mt-auto !w-[20%] max-md:!w-full'" :submitButton="true" />
            </div>
        </form>

        <div class="flex flex-col gap-5">
            <div class="grid grid-cols-4 justify-center max-lg:grid-cols-2 max-sm:grid-cols-1 gap-6 gap-y-12 pt-3 pb-6">
                @foreach ($products as $product)
                    <x-products.product-card :product="$product" />
                @endforeach
            </div>
        </div>

        {{ $products->appends(request()->query())->links() }}

    </div>

</x-app-layout>
