<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">

        <h1 class="font-extrabold uppercase text-4xl">Checkout</h1>

        <div class="grid grid-cols-2 gap-8 max-lg:grid-cols-1 my-6">

            <form action="{{ route('stripe.payment') }}" method="POST">
                @csrf
                <div class="flex flex-col w-full gap-3 h-fit sticky top-6">
                    <p class="font-extrabold uppercase text-xl text-zinc-700">Delivery and Contact</p>
                    <p class="opacity-50 -mt-3 text-sm">Fields marked with * are required.</p>
                    @if (count($userAddresses) > 0)
                        <x-breeze.input-label for="user_address_id_select" :value="'You can pick an address from here'" />
                        <select
                            class="border-zinc-300 focus:border-rose-500 focus:ring-rose-500 rounded-md shadow-sm -mt-1 block w-full cursor-pointer"
                            name="user_address_id"
                            id="user_address_id_select"
                            onchange="toggleAddressFields()"
                        >
                            <option value="" selected>Add new address</option>
                            @foreach ($userAddresses as $userAddress)
                            <option value="{{ $userAddress->id }}">{{ $userAddress->getCompleteAddress() }}</option>
                            @endforeach
                        </select>
                    @endif
                    <div class="grid grid-cols-2 gap-3 max-md:grid-cols-1">
                        <div>
                            <x-breeze.input-label for="first_name" :value="'First Name *'" />
                            <x-breeze.text-input required id="first_name" placeholder="First Name *" name="first_name" type="text" class="mt-1 block w-full disabled:opacity-50" />
                            @error('first_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-breeze.input-label for="last_name" :value="'Last Name *'" />
                            <x-breeze.text-input required id="last_name" placeholder="Last Name *" name="last_name" type="text" class="mt-1 block w-full disabled:opacity-50" />
                            @error('last_name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div>
                        <x-breeze.input-label for="phone" :value="'Phone *'" />
                        <x-breeze.text-input required id="phone" placeholder="Phone *" name="phone" type="text" class="mt-1 block w-full disabled:opacity-50" />
                        @error('phone')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-breeze.input-label for="address" :value="'Address *'" />
                        <x-breeze.text-input required id="address" placeholder="Address *" name="address" type="text" class="mt-1 block w-full disabled:opacity-50" />
                        @error('address')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <x-breeze.input-label for="address_additional" :value="'Apartment, suite, etc.'" />
                        <x-breeze.text-input id="address_additional" placeholder="Apartment, suite, etc." name="address_additional" type="text" class="mt-1 block w-full disabled:opacity-50" />
                        @error('address_additional')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-3 max-md:grid-cols-1">
                        <div>
                            <x-breeze.input-label for="postal_code" :value="'Postal Code *'" />
                            <x-breeze.text-input required id="postal_code" placeholder="Postal Code *" name="postal_code" type="text" class="mt-1 block w-full disabled:opacity-50" />
                            @error('postal_code')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-breeze.input-label for="city" :value="'City *'" />
                            <x-breeze.text-input required id="city" placeholder="City *" name="city" type="text" class="mt-1 block w-full disabled:opacity-50" />
                            @error('city')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <p class="text-sm opacity-50">Your shipping information will be saved for future orders.</p>

                    <span class="h-[1px] bg-zinc-500/20 w-full my-4"></span>
                    <div class="flex flex-col gap-2 items-start max-sm:text-center max-sm:items-center">
                        <p class="font-extrabold text-3xl">{{ $userCart->totalPrice() }}<span class="opacity-50 text-xl">$</span></p>
                        <p class="opacity-50">Taxes and shipping included.</p>
                        <x-common.simple-button :additionalClasses="'mt-4 w-full'" id="pollas" :submitButton="true" :text="'Pay'" />
                        <p class="opacity-50 text-light text-sm">By clicking in the pay button you agree with our <span class="underline">terms & services</span>.</p>
                        <div class="flex items-center max-sm:mr-0 text-sm">
                            <span class="opacity-50 -mr-3">Payment powered by</span>
                            <x-common.stripe-vector />
                        </div>
                    </div>
                </div>
            </form>

            <div class="flex flex-col gap-5 items-center">
                @foreach ($userCart->cartProducts as $cartProduct)
                    <x-orders.order-product-card :cartProduct="$cartProduct" />
                    @if (!$loop->last) <span class="h-[1px] bg-zinc-500/20 w-full"></span> @endif
                @endforeach
                <p class="opacity-50 self-end text-right mt-6">If you want to modify your shopping cart, click <a class="underline hover:opacity-60 transition-all" href="{{ route('cart.show') }}">here</a>.</p>
            </div>
        </div>

    </div>

    <script>
        const addressSelect = document.getElementById('user_address_id_select');

        function toggleAddressFields() {

            const isDisabled = addressSelect.value !== "";

            document.getElementById('first_name').disabled = isDisabled;
            document.getElementById('last_name').disabled = isDisabled;
            document.getElementById('phone').disabled = isDisabled;
            document.getElementById('address').disabled = isDisabled;
            document.getElementById('address_additional').disabled = isDisabled;
            document.getElementById('postal_code').disabled = isDisabled;
            document.getElementById('city').disabled = isDisabled;

        }

        toggleAddressFields();
    </script>

</x-app-layout>
