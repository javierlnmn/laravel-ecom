<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">


        <div class="flex flex-col gap-3">
            <h3 class="font-extrabold uppercase text-4xl">{{$category->name}}</h3>
            <p class="opacity-50">{{$category->description}}</p>
        </div>

        <div class="flex flex-col gap-5">
            <div class="grid grid-cols-4 justify-center max-lg:grid-cols-2 max-sm:grid-cols-1 gap-6 gap-y-12 pt-3 pb-6">
                @foreach ($category->allProducts() as $product)
                    <x-products.product-card :product="$product" />
                @endforeach
            </div>
        </div>

    </div>

</x-app-layout>
