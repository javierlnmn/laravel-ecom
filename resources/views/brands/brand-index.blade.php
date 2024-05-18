<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">

        <h1 class="font-extrabold uppercase text-4xl">Brands</h1>

        <div class="my-12 flex flex-col gap-12">
            <p class="text-2xl text-center font-thin">Some of the brands we work with:</p>
            <div class="flex flex-wrap gap-6 gap-y-3 items-center justify-center">
                @foreach($brands->slice(0, 6) as $brand)
                    <a href="{{route('brand.show', ['brandSlug' => $brand->slug])}}">
                        <img class="max-w-32 w-full h-auto aspect-square object-contain mix-blend-multiply" src="{{$brand->image}}" />
                    </a>
                @endforeach
            </div>
            <p class="text-2xl text-center font-thin">and many more...</p>
        </div>

        <div class="grid grid-cols-2 max-md:grid-cols-1 my-12 gap-6">
            @foreach($brands as $brand)
            <div class="flex flex-col gap-6 border p-4 shadow-md">
                <div class="flex justify-between gap-6 items-center">
                    <p class="uppercase font-black text-4xl">{{$brand->name}}</p>
                    <img class="max-w-32 w-full h-auto aspect-square object-contain mix-blend-multiply" src="{{$brand->image}}" />
                </div>
                @if($brand->description)
                    <p class="opacity-50">{{Str::words($brand->description, 12)}}</p>
                @endif
                <x-common.simple-button :additionalClasses="'mt-auto'" :link="route('brand.show', ['brandSlug' => $brand->slug])" :text="'See '.$brand->name" />
            </div>
            @endforeach
        </div>

    </div>

</x-app-layout>
