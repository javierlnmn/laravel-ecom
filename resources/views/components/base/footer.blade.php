<footer class="min-h-20 bg-zinc-900 p-3 flex items-center">

    <div class="max-w-7xl w-11/12 mx-auto py-5 grid grid-cols-3 text-zinc-100">

        <div class="flex flex-col gap-3 items-start">
            <p class="font-bold">Products</p>
            {{-- @foreach ($categories as $category)
                <li>{{ $category->name }}</li>
            @endforeach --}}
        </div>

        <div class="flex flex-col gap-3 items-start">
            <p class="font-bold">About Us</p>
        </div>

        <div class="flex flex-col justify-center items-center">
            <x-breeze.application-logo-notext class="max-w-36 w-full h-w-full" color="#FDFDFD" />
        </div>
    </div>

</footer>
