<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">

        <h1 class="font-extrabold uppercase text-4xl">Your order <span class="text-green-600">has been confirmed</span>!</h1>
        <p class="text-zinc-700 mt-6">The provided address is <span class="bg-zinc-300 italic shadow-sm rounded-lg px-2">{{$order->userAddress->getCompleteAddress()}}</span>. Please confirm it is correct or <span class="underline">otherwise contact us</span>.</p>
        <p class="text-zinc-700">We will be sending this products soon:</p>

        <div class="grid grid-cols-2 gap-6 max-md:grid-cols-1 mt-6">
            @foreach ($order->orderProducts as $orderProduct)
                <x-payments.payment-product-card :orderProduct="$orderProduct" />
            @endforeach
        </div>

        <p class="mt-6">You can check all you orders, including the <span class="font-bold">pending ones</span>, on your <span class="underline">order's page</span> in your profile.</p>

    </div>

</x-app-layout>
