<div class="relative my-0 mx-auto mb-5">
    <div class="flex overflow-hidden snap-x snap-mandatory scroll-smooth">
        @foreach ($imageList as $image)
            <img class="flex-grow flex-shrink-0 basis-full snap-start aspect-square object-cover" id="slider-image-{{ $image->id }}" src="{{ $image->image }}" alt="{{ $image->alt }}">
        @endforeach
    </div>
    <div class="w-full flex justify-center gap-4 absolute -bottom-14 left-1/2 -translate-x-1/2 z-10">
        @foreach ($imageList as $image)
            <a class="w-fit h-12 " href="#slider-image-{{ $image->id }}">
                <img class="h-full w-auto aspect-square object-cover" id="slider-image-{{ $image->id }}" src="{{ $image->image }}" alt="{{ $image->alt }}">
            </a>
        @endforeach
    </div>
</div>
{{-- <div>
    <div class="relative w-full h-full aspect-square mx-auto my-0">

        <button id="{{ $product->id }}-button-left" class="absolute top-1/2 -translate-y-1/2 left-3 z-20">
            <
        </button>

        <div class="h-full relative"
            <ul>
            @foreach ($imageList as $image)
                <li class="absolute bottom-0 top-0 w-full h-full">
                    <img class="w-full h-full object-cover aspect-square" src="{{ $image->image }}" alt="">
                </li>
            @endforeach
            </ul>
        </div>

        <button id="{{ $product->id }}-button-right" class="absolute top-1/2 -translate-y-1/2 right-3 z-20">
            >
        </button>

        <div class="flex justify-center gap-1 my-1">

            @foreach ($imageList as $image)
                <button class="w-3 h-1 bg-zinc-300 @if ($loop->first) !bg-zinc-400 @endif"></button>
            @endforeach

        </div>

    </div>
</div> --}}
