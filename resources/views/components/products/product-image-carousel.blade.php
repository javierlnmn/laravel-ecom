<div class="
        flex w-full items-center gap-3
        @if(isset($sticky)) sticky top-6 max-lg:static @endif
        @if(isset($responsive)) flex-row max-lg:flex-col-reverse @else flex-col-reverse @endif
    "
>

    <div class="
            flex justify-center gap-3
            @if(isset($responsive)) flex-col  lg:w-[13%] max-lg:flex-row max-lg:h-20 @else flex-row h-20 @endif
        "
        id="images-list-{{$product->id}}"
    >

        @foreach ($product->images as $image)
            <img class="transition-shadow duration-[500ms] cursor-pointer h-full w-auto aspect-square object-cover @if ($loop->first) shadow-lg @endif"  src="{{ $image->image }}" alt="{{ $image->alt }}">
        @endforeach
    </div>
    <div class="w-full grid grid-cols-1 grid-rows-1 relative" id="showing-images-{{$product->id}}">
        @foreach ($product->images as $image)
            <img class="object-cover aspect-square w-full transition-opacity duration-[500ms] col-start-1 row-start-1 opacity-0 @if ($loop->first) !opacity-100  @endif" src="{{ $image->image }}" alt="{{ $image->alt }}">
        @endforeach
    </div>
    <script>
        const imagesContainer{{$product->id}} = document.getElementById('images-list-{{$product->id}}');
        const showingImages{{$product->id}} = document.getElementById('showing-images-{{$product->id}}');
        const selectedImageClassesList{{$product->id}} = ['shadow-lg'];

        const toggleSelectedImageClassesList{{$product->id}} = (clickedImage) => {
            for (let image of imagesContainer{{$product->id}}.children) {
                if (image.src === clickedImage.src) {
                    clickedImage.classList.add(...selectedImageClassesList{{$product->id}});
                    continue;
                }
                image.classList.remove(...selectedImageClassesList{{$product->id}});
            }
        }

        imagesContainer{{$product->id}}.addEventListener('click', function(event) {
            const clickedImage = event.target;

            if (!clickedImage.src) return;

            toggleSelectedImageClassesList{{$product->id}}(clickedImage);

            for (let image of showingImages{{$product->id}}.children) {
                if (image.src == clickedImage.src) {
                    image.classList.add('!opacity-100');
                    continue;
                }
                image.classList.remove('!opacity-100');
            }
        });

    </script>
</div>
