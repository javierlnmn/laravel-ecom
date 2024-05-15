<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">

        <div class="grid grid-cols-2 max-lg:grid-cols-1 gap-5">
            <div class="flex max-lg:flex-col-reverse items-center h-fit gap-3 sticky max-lg:static top-6">
                <div class="w-16 flex flex-col max-lg:flex-row justify-center gap-3" id="images-list">
                    @foreach ($product->images as $image)
                        <img class="transition-shado duration-[500ms] cursor-pointer @if ($loop->first) shadow-lg @endif"  src="{{ $image->image }}" alt="{{ $image->alt }}">
                    @endforeach
                </div>
                <div class="w-full grid grid-cols-1 grid-rows-1 relative" id="showing-images">
                    @if ($product->discount > 0)
                        <p class="text-2xl absolute top-4 right-4 font-black text-red-600 z-30">-{{$product->discount}}%</p>
                    @endif
                    @foreach ($product->images as $image)
                        <img class="object-cover aspect-square w-full h-auto transition-opacity duration-[500ms] col-start-1 row-start-1 opacity-0 @if ($loop->first) !opacity-100  @endif" src="{{ $image->image }}" alt="{{ $image->alt }}">
                    @endforeach
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <h1 class="text-6xl max-lg:text-5xl max-md:text-4xl font-black">{{ $product->name }}</h1>
                <a class="text-amber-600 hover:text-amber-500 w-fit transition-colors font-bold" href="#">{{$product->brand->name}}</a>
                <p class="opacity-50">{{ $product->sku }}</p>
                <p class="whitespace-pre-wrap ">{{ $product->description }}</p>
                <x-common.number-input
                    :name="'product-units'"
                    :initialValue="'1'"
                    :min="'0'"
                    :max="'10'" {{-- available units method --}}
                    :id="$product->id"
                />
                <div class="w-full mt-auto text-right">
                    @if ($product->discount > 0)
                    <span class="opacity-60 relative">
                        <span class="absolute h-[2px] w-full bg-red-700 top-2"></span>
                        <span class="font-extrabold text-2xl">{{$product->price}}</span>
                        <span class="font-light text-lg text-zinc-500">$</span>
                    </span>
                    @endif
                    <span class="ml-3 font-extrabold text-4xl">{{$product->priceWithDiscount()}}</span><span class="font-light text-lg text-zinc-500">$</span>
                </div>
                <x-common.simple-button
                    :link="'#'"
                    :additionalClasses="'text-xl font-extrabold'"
                    :text="'Add to Cart'"
                />
            </div>
        </div>

        <script>
            const imagesContainer = document.getElementById('images-list');
            const showingImages = document.getElementById('showing-images');
            const selectedImageClassesList = ['shadow-lg'];

            const toggleSelectedImageClassesList = (clickedImage) => {
                for (let image of imagesContainer.children) {
                    if (image.src === clickedImage.src) {
                        clickedImage.classList.add(...selectedImageClassesList);
                        continue;
                    }
                    image.classList.remove(...selectedImageClassesList);
                }
            }

            imagesContainer.addEventListener('click', function(event) {
                const clickedImage = event.target;

                if (!clickedImage.src) return;

                toggleSelectedImageClassesList(clickedImage);

                for (let image of showingImages.children) {
                    if (image.src == clickedImage.src) {
                        image.classList.add('!opacity-100');
                        continue;
                    }
                    image.classList.remove('!opacity-100');
                }
            });

        </script>

    </div>

</x-app-layout>
