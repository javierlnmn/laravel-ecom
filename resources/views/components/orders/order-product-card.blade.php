<div class="flex w-full gap-4 max-md:gap-6 relative">
    <div class="w-1/4">
        <x-products.product-image-carousel
            :uniqueId="uniqid()"
            :product="$cartProduct->product"
            :imageList="$cartProduct->product->images"
        />
    </div>
    <div class="w-3/4 flex flex-col gap-4">
        <h3 class="text-3xl max-md:text-2xl font-black">{{ $cartProduct->product->name }}</h3>
        <p class="text-xl font-bold">{{ $cartProduct->quantity }} units, {{ $cartProduct->getSizeName() }} size</p>
        @if ($cartProduct->product->discount <= 0)
            <p><span class="font-extrabold text-2xl mt-auto">{{$cartProduct->product->price}}</span><span class="font-light text-md text-zinc-500">$</span></p>
        @else
            <div class="w-full">
                <span class="opacity-60 relative">
                    <span class="absolute h-[2px] w-full bg-red-700 top-2"></span>
                    <span class="font-extrabold text-xl">{{$cartProduct->product->price}}</span>
                    <span class="font-light text-md text-zinc-500">$</span>
                </span>
                <span class="ml-3 font-extrabold text-2xl">{{$cartProduct->product->priceWithDiscount()}}</span><span class="font-light text-md text-zinc-500">$</span>
            </div>
        @endif
        <x-common.rose-link :additionalClasses="'self-end mt-auto'" :link="route('product.show', ['productSlug' => $cartProduct->product->slug])" :text="'See Item'" />
    </div>
</div>
