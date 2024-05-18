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
                    href="">Show Me</a>
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


        {{-- <div class="max-w-7xl w-11/12 mx-auto">
            <h3 class="font-extrabold uppercase text-4xl">About Jija</h3>
            <div class="flex gap-4 items-center my-7 max-md:flex-col">
                <p class="max-lg:w-3/5 max-md:w-full w-1/2">
                    Our skate shop is the culmination of a shared dream among friends who spent countless hours
                    shredding in the same park. What started as a simple passion for skating evolved into a thriving
                    business, fueled by our love for the sport.
                    <br>
                    Driven by our desire to provide fellow skaters with quality gear and apparel, we set out to create a
                    space where the skate community could come together. Our shelves are stocked with a curated
                    selection of decks, hoodies, and skate items that reflect our dedication to the scene.
                    <br>
                    But our shop is more than just a retail space—it's a gathering place for skaters of all levels.
                    Whether you're perfecting your kickflips or just starting out, you'll find a welcoming atmosphere
                    and a supportive community here.
                    <br>
                    From the early days of dreaming big in the park to the reality of running our own shop, our journey
                    has been one of passion, perseverance, and friendship. And we're excited to share that journey with
                    you.
                </p>
                <div class="max-lg:w-2/5 max-md:w-full max-md:my-14 w-1/2 flex max-h-[400px] max-lg:!max-h-none max-lg:scale-125 max-md:scale-100">
                    <img class="object-cover w-4/5 -translate-y-16 translate-x-8" src="{{ url('/assets/images/about_us_1.png') }}" alt="About us image 1">
                    <img class="object-cover w-4/5 -translate-x-6" src="{{ url('/assets/images/about_us_2.png') }}" alt="About us image 2">
                </div>
            </div>
        </div> --}}

    </div>

</x-app-layout>
