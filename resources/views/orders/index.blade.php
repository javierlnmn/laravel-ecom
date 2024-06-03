<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">

        <h1 class="font-extrabold uppercase text-4xl">My orders</h1>

        @if (count($userOrders) > 0)

        <div class="grid grid-cols-2 max-lg:grid-cols-1 gap-6 mt-6">
            @foreach ($userOrders as $order)
                <div class="grid grid-cols-2 max-md:grid-cols-1 w-full gap-4 max-md:gap-6 relative p-4 shadow-md">
                    <div class="grid grid-cols-2 gap-3">
                        @foreach ($order->orderProducts->slice(0, 4) as $orderProduct)
                            @if ($loop->index == 3 && count($order->orderProducts) > 3)
                                <div class="w-full h-auto aspect-square object-cover relative">
                                    <span class="absolute top-0 left-0 w-full h-full bg-black bg-opacity-30 text-zinc-200 grid place-items-center text-5xl">+{{(count($order->orderProducts)-4)}}</span>
                                    <img class="w-full h-auto aspect-square object-cover" src="{{$orderProduct->product->images[0]->image}}" alt="{{$orderProduct->product->images[0]->alt}}">
                                </div>
                            @else
                                <img class="w-full h-auto aspect-square object-cover" src="{{$orderProduct->product->images[0]->image}}" alt="{{$orderProduct->product->images[0]->alt}}">
                            @endif
                        @endforeach
                        @if (count($order->orderProducts)<= 2)
                            <div class="w-full h-auto aspect-square"></div>
                            <div class="w-full h-auto aspect-square"></div>
                        @endif
                    </div>
                    <div class="w-full flex flex-col gap-4">
                        <h3 class="text-3xl max-md:text-4xl font-black">Realized {{date('d/m/Y', strtotime($order->created_at))}}</h3>
                        <p><span class="text-xl mt-auto font-thin">Total price: {{$order->total_price}}</span><span class="font-light text-md text-zinc-500">$</span></p>
                        <p class="text-xl font-thin">Order status: {{$order->status}}</p>
                        @if ($order->status == 'payment_pending')
                        <div class="flex flex-wrap gap-3 items-center">
                            <x-common.simple-button
                                :link="'#'"
                                :additionalClasses="'text-lg font-extrabold w-full mt-auto'"
                                :text="'Proceed to payment'"
                            />
                            <form class="w-full mt-auto" action="{{route('order.destroy', ['orderId' => $order->id])}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <x-common.simple-button
                                    :submitButton="true"
                                    :additionalClasses="'text-lg font-extrabold w-full !bg-red-600/90 hover:!bg-red-600/70'"
                                    :text="'Cancel order'"
                                />
                            </form>
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            {{ $userOrders->links() }}
        </div>

        @else

        <p class="opacity-50 mt-6">You have no orders yet...</p>

        @endif

    </div>

</x-app-layout>
