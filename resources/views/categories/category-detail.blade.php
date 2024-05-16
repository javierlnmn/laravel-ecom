<x-app-layout>

    <div class="my-6 max-w-7xl w-11/12 mx-auto">


        <h3 class="font-extrabold uppercase text-4xl">{{$category->name}}</h3>

        <div class="flex flex-col gap-5">
            {{$category->allProducts()}}
        </div>

    </div>

</x-app-layout>
