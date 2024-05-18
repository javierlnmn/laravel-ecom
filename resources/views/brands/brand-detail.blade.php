<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">


        <div class="flex justify-between items-center">
            <div class="flex flex-col gap-3">
                <h3 class="font-extrabold uppercase text-4xl">{{$brand->name}}</h3>
                <p class="opacity-50">{{$brand->description}}</p>
            </div>
            <img class="mix-blend-multiply w-[100px] h-[100px] object-contain" src="{{$brand->image}}" alt="{{$brand->name}}">
        </div>

        <div class="flex flex-col gap-5">
            <div class="grid grid-cols-4 justify-center max-lg:grid-cols-2 max-sm:grid-cols-1 gap-6 gap-y-12 pt-3 pb-6">
                @foreach ($brandProducts as $product)
                    <x-products.product-card :product="$product" />
                @endforeach
            </div>
            {{$brandProducts->links()}}
        </div>

    </div>

</x-app-layout>
