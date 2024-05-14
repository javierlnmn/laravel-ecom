<div class="flex flex-col gap-4 relative">

    @if ($product->discount > 0)
        @if ($product->discount < 25)
            <span class="p-1 absolute z-20 right-2 top-2 bg-cyan-500 rounded-full text-zinc-100 text-xs font-semibold">-{{$product->discount}}%</span>
        @elseif ($product->discount < 50)
            <span class="p-1 absolute z-20 right-2 top-2 bg-rose-500 rounded-full text-zinc-100 text-xs font-semibold">-{{$product->discount}}%</span>
        @elseif ($product->discount < 75)
            <span class="p-1 absolute z-20 right-2 top-2 bg-emerald-500 rounded-full text-zinc-100 text-xs font-semibold">-{{$product->discount}}%</span>
        @else
            <span class="p-1 absolute z-20 right-2 top-2 bg-amber-500 rounded-full text-zinc-100 text-xs font-semibold">-{{$product->discount}}%</span>
        @endif
    @endif

    <x-products.product-image-carousel :product="$product" :imageList="$product->images" />

    <div class="mt-6 flex flex-col gap-3 h-full">
        <p class="font-extrabold text-2xl">{{$product->name}}</p>
        <p class="font-light text-sm">{{Str::words($product->description, 12)}}</p>
        <a class="text-amber-600 font-bold" href="#">{{$product->brand->name}}</a>

        @if ($product->discount <= 0)
            <p><span class="font-extrabold text-2xl">{{$product->price}}</span><span class="font-light te text-zinc-500">$</span></p>
        @else
            <div class="w-full">
                <span class="opacity-60 relative">
                    <span class="absolute h-[2px] w-full bg-red-700 top-2"></span>
                    <span class="font-extrabold text-xl">{{$product->price}}</span>
                    <span class="font-light te text-zinc-500">$</span>
                </span>
                <span class="ml-3 font-extrabold text-2xl">{{$product->priceWithDiscount()}}</span><span class="font-light te text-zinc-500">$</span>
            </div>
        @endif

        <a class="cursor-pointer mt-auto text-center text-zinc-200 bg-zinc-800 hover:bg-zinc-700 py-4 transition-colors">See Item</a>

    </div>

</div>
