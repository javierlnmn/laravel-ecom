<div class="
        flex w-full items-center gap-3
        @if(isset($sticky)) sticky top-6 max-lg:static @endif
        @if(isset($responsive)) flex-row max-lg:flex-col-reverse @else flex-col-reverse @endif
    "
>

    <div class="
            flex justify-center gap-3 overflow-x-scroll w-full
            @if(isset($responsive)) flex-col  lg:w-[13%] max-lg:flex-row max-lg:h-20 @else flex-row h-20 @endif
        "
        id="images-list-{{ $uniqueId }}"
    >

        @foreach ($product->images as $image)
            <img class="transition-shadow duration-[500ms] cursor-pointer h-full w-auto aspect-square object-cover @if ($loop->first) shadow-lg @endif"  src="{{ $image->image }}" alt="{{ $image->alt }}">
        @endforeach
    </div>
    <div class="w-full grid grid-cols-1 grid-rows-1 relative" id="showing-images-{{ $uniqueId }}">
        @foreach ($product->images as $image)
            <img class="object-cover aspect-square w-full transition-opacity duration-[500ms] col-start-1 row-start-1 opacity-0 @if ($loop->first) !opacity-100  @endif" src="{{ $image->image }}" alt="{{ $image->alt }}">
        @endforeach
    </div>
    <script>
        const imagesContainer{{ $uniqueId }} = document.getElementById('images-list-{{ $uniqueId }}');
        const showingImages{{ $uniqueId }} = document.getElementById('showing-images-{{ $uniqueId }}');
        const selectedImageClassesList{{ $uniqueId }} = ['shadow-lg'];

        const toggleSelectedImageClassesList{{ $uniqueId }} = (clickedImage) => {
            for (let image of imagesContainer{{ $uniqueId }}.children) {
                if (image.src === clickedImage.src) {
                    clickedImage.classList.add(...selectedImageClassesList{{ $uniqueId }});
                    continue;
                }
                image.classList.remove(...selectedImageClassesList{{ $uniqueId }});
            }
        }

        imagesContainer{{ $uniqueId }}.addEventListener('click', function(event) {
            const clickedImage = event.target;

            if (!clickedImage.src) return;

            toggleSelectedImageClassesList{{ $uniqueId }}(clickedImage);

            for (let image of showingImages{{ $uniqueId }}.children) {
                if (image.src == clickedImage.src) {
                    image.classList.add('!opacity-100');
                    continue;
                }
                image.classList.remove('!opacity-100');
            }
        });

    </script>
</div>
