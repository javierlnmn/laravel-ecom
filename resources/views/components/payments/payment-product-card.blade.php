<div class="grid grid-cols-2 w-full gap-4 max-md:gap-6 relative p-4 shadow-md">
    <div class="w-full">
        <x-products.product-image-carousel
            :uniqueId="uniqid()"
            :responsive="true"
            :product="$orderProduct->product"
            :imageList="$orderProduct->product->images"
        />
    </div>
    <div class="w-full flex flex-col gap-4">
        <h3 class="text-3xl max-lg:text-5xl max-md:text-4xl font-black">{{ $orderProduct->product->name }}</h3>
        <p class="text-2xl font-bold">{{ $orderProduct->quantity }} units, {{ $orderProduct->getSizeName() }} size</p>
        <p class="opacity-50">{{ Str::words($orderProduct->product->description, 15) }}</p>
        <p><span class="font-extrabold text-2xl mt-auto">{{$orderProduct->price}}</span><span class="font-light text-md text-zinc-500">$</span></p>
    </div>
</div>
