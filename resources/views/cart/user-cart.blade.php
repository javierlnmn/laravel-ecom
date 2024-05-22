<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">

        <h1 class="font-extrabold uppercase text-4xl">Your Shopping Cart</h3>

        <div class="flex flex-col gap-5 items-center justify-center mt-6">
            @foreach ($userCart->cartProducts as $cartProduct)
                <x-cart.cart-product-card :cartProduct="$cartProduct" />
                @if (!$loop->last) <span class="h-[1px] bg-zinc-500/20 w-full"></span> @endif
            @endforeach
        </div>

        <div class="mt-16 flex flex-col items-end text-right max-sm:text-center max-sm:items-center">
            <span class="h-[1px] bg-zinc-500/20 w-full mb-4"></span>
            <p class="font-extrabold text-3xl">Total price: {{$userCart->totalPrice()}}<span class="opacity-50 text-xl">$</span></p>
            <p class="opacity-50 text-light">Taxes and shipping calculated at checkout </p>
            <x-common.simple-button :additionalClasses="'mt-4 w-[200px] max-md:w-full'" :link="''" :text="'Checkout'" />
        </div>

    </div>

</x-app-layout>
