<div class="flex w-full max-md:flex-col gap-4 max-md:gap-6 relative">
    <div class="w-1/3 max-md:w-full max-lg:w-1/2">
        <x-products.product-image-carousel
            :uniqueId="uniqid()"
            :responsive="true"
            :product="$cartProduct->product"
            :imageList="$cartProduct->product->images"
        />
    </div>
    <div class="w-2/3 max-md:w-full max-lg:w-1/2 flex flex-col gap-4">
        <h3 class="text-3xl max-lg:text-5xl max-md:text-4xl font-black">{{ $cartProduct->product->name }}</h3>
        <p class="text-2xl font-bold">{{ $cartProduct->quantity }} units, {{ $cartProduct->getSizeName() }} size</p>
        <p class="opacity-50">{{ Str::words($cartProduct->product->description, 20) }}</p>
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
        <div class="mt-auto max-w-[500px] w-full self-end flex justify-items-end gap-4 items-center max-md:max-w-none max-md:mt-6 max-sm:flex-col">
            <x-common.simple-button :additionalClasses="'w-full h-full'" :link="route('product.show', ['productSlug' => $cartProduct->product->slug])" :text="'See Item'" />
            <form class="w-full" action="{{route('cart.delete', ['cartProductId' => $cartProduct->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <x-common.simple-button :additionalClasses="'w-full h-full !bg-red-600/90 hover:!bg-red-600/70'" :text="'Delete from cart'" :submitButton="true" />
            </form>
        </div>
    </div>
</div>
