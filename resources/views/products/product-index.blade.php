<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">

        <h1 class="font-extrabold uppercase text-4xl">All of our products</h1>

        <form action="{{ route('product.index') }}" method="GET">
            <div class="flex gap-4 items-center my-4">
                <x-common.text-input
                    :id="uniqId()"
                    :name="'searchBy'"
                    :value="request('searchBy')"
                    :placeholder="'Type something to search by...'"
                />
                <div class="w-full">
                    <div class="w-full h-10 !cursor-pointer rounded-full hover:bg-zinc-300/30 border-zinc-900/50 border-[1px] border-solid grid place-items-center">
                        <select
                            class="outline-none !cursor-pointer !ring-0 !focus:outline-none border-none bg-transparent w-full p-0 text-center"
                            name="orderBy"
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
                </div>
                <x-common.simple-button :text="'Search'" :additionalClasses="'!py-2 !w-[20%]'" :submitButton="true" />
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
