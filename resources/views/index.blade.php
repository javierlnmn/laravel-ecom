<x-app-layout>

    <div class="flex flex-col gap-12 pb-4">
        <div class="min-h-[600px] grid grid-cols-5 overflow-hidden max-md:relative">
            <div
                class="overflow-hidden col-span-3 max-md:absolute max-md:top-0 max-md:left-0 w-full h-full [clip-path:polygon(0%_0%,100%_15%,50%_300%)]">
                <img class="filter brightness-75 hover:brightness-50 hover:scale-110 transition-all h-full w-full object-cover"
                    src="{{ url('/assets/images/index_wallpaper.png') }}" alt="Index wallpaper">
            </div>

            <div class="p-12 col-span-2 flex flex-col justify-center md:-ml-24 max-md:col-span-5 relative z-30">
                <h1 class="select-none font-germania-one-regular text-[10rem] leading-[130px] max-md:text-zinc-200">JIJA
                </h1>
                <p class="select-none w-fit px-2 py-1 rounded-md text-rose-600">From skaters, for skaters</p>
                <a class="mt-5 uppercase text-xs text-zinc-300 bg-zinc-800 transition-colors hover:bg-zinc-700 w-fit px-4 py-2 rounded-md font-semibold"
                    href="{{route('product.index')}}">Show Me</a>
            </div>
        </div>

        @if (sizeOf($latestProducts) > 0)
            <div class="max-w-7xl w-11/12 mx-auto">
                <h3 class="font-extrabold uppercase text-4xl">Latest Releases</h3>

                <div class="grid grid-cols-4 justify-center max-lg:grid-cols-2 max-sm:grid-cols-1 gap-6 py-12">
                    @foreach ($latestProducts as $product)
                        <x-products.product-card :product="$product" />
                    @endforeach
                </div>

            </div>
        @endif

    </div>

</x-app-layout>
