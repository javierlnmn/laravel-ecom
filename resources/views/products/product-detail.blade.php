<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">

        <div class="grid grid-cols-2 max-lg:grid-cols-1 gap-5">
            <x-products.product-image-carousel
                :uniqueId="uniqid()"
                :responsive="true"
                :sticky="true"
                :product="$product"
                :imageList="$product->images"
            />
            <div class="flex flex-col gap-3">
                <h1 class="text-6xl max-lg:text-5xl max-md:text-4xl font-black">{{ $product->name }}</h1>
                <p class="opacity-50">{{ $product->sku }}</p>
                <x-common.rose-link :link="'#'" :text="$product->brand->name" />
                <div class="flex gap-2 items-center">
                    @foreach ($product->category->parentList() as $category)
                        <x-common.rose-link :link="route('category.show', ['categorySlug' => $category->slug])" :text="$category->name" />
                        @if(!$loop->last) <span class="font-bold">&gt;</span> @endif
                    @endforeach
                </div>
                <p class="whitespace-pre-wrap ">{{ $product->description }}</p>
                @if ($product->getTotalStock() > 0)
                <form method="POST" action="{{ route('cart.store', ['productId' => $product->id]) }}" class="flex flex-col gap-3">
                    @csrf
                    <div class="flex gap-4 items-center">
                        <x-common.number-input
                            :required="'true'"
                            :name="'product-units'"
                            :initialValue="'1'"
                            :min="'1'"
                            :max="$product->getTotalStock()"
                            :id="$product->id"
                        />
                        <x-products.product-size-select-input
                            :required="'true'"
                            :name="'product-size'"
                            :product="$product"
                        />
                    </div>
                    <div class="w-full mt-auto text-right">
                        @if ($product->discount > 0)
                        <span class="opacity-60 relative">
                            <span class="absolute h-[2px] w-full bg-red-700 top-2"></span>
                            <span class="font-extrabold text-2xl">{{$product->price}}</span>
                            <span class="font-light text-lg text-zinc-500">$</span>
                        </span>
                        @endif
                        <span class="ml-3 font-extrabold text-4xl">{{$product->formattedPriceWithDiscount()}}</span><span class="font-light text-lg text-zinc-500">$</span>
                    </div>
                    <x-common.simple-button
                        :submitButton="true"
                        :additionalClasses="'text-xl font-extrabold'"
                        :text="'Add to Cart'"
                    />
                </form>
                @else
                    <p class="text-zinc-700/50 text-xl font-bold mt-auto">Out of stock</p>
                    <x-common.rose-link :link="route('category.show', ['categorySlug' => $product->category->slug])" :text="'See more ' . strtolower($product->category->name)" />
                @endif
            </div>
        </div>

    </div>

</x-app-layout>
