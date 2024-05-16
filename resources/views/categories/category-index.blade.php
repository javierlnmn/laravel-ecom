<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">


        <div class="flex flex-col gap-5">

            @foreach ($categories as $category)
            <div class="flex flex-col">
                <div class="flex gap-3 items-center">
                    <h3 class="font-extrabold uppercase text-4xl">{{$category->name}}</h3>
                    <span class="h-[1px] bg-zinc-800/30 flex-1"></span>
                    @if ($category->allProducts()->count() > 0)
                        <x-common.amber-link :link="route('category.show', ['categorySlug' => $category->slug])" :text="'See complete category'" />
                    @endif
                </div>
                @if ($category->allProducts()->count() > 0)
                    <div class="grid grid-cols-4 justify-center max-lg:grid-cols-2 max-sm:grid-cols-1 gap-6 pt-3 pb-6">
                        @foreach ($category->allProducts()->slice(0, 4) as $product)
                            <x-products.product-card :product="$product" />
                        @endforeach
                    </div>
                @else
                    <p class="opacity-50 my-5">We will have products soon...</p>
                @endif
            </div>
            @endforeach

        </div>

    </div>

</x-app-layout>
