<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">

        <h1 class="font-extrabold uppercase text-4xl">Your payment <span class="text-red-600">wasn't completed</span></h1>
        <p class="text-zinc-700 mt-6">Oops! There was an error with your order payment. The items in this order are:</p>

        <div class="grid grid-cols-2 max-md:grid-cols-1 mt-6">
            @foreach ($order->orderProducts as $orderProduct)
                <x-payments.payment-product-card :orderProduct="$orderProduct" />
            @endforeach
        </div>

        <p class="mt-6">You can check all you orders, including the <span class="font-bold">pending ones</span>, on your <span class="underline">order's page</span> in your profile.</p>

    </div>

</x-app-layout>
