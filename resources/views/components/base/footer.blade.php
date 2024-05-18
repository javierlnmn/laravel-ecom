<footer class="min-h-20 bg-zinc-900 p-3 flex items-center">

    <div class="max-w-7xl w-11/12 mx-auto py-5 grid grid-cols-3 max-md:grid-cols-2 gap-5 text-zinc-100">

        <div class="flex flex-col gap-3 items-start">
            <p class="font-extrabold">Products</p>
            <a class="font-light hover:text-zinc-400 transition-colors" href="#">Products</a>
            <a class="font-light hover:text-zinc-400 transition-colors" href="{{ route('category.index') }}">Categories</a>
            <a class="font-light hover:text-zinc-400 transition-colors" href="{{ route('brand.index') }}">Brands</a>
        </div>
        <div class="flex flex-col gap-3 items-start">
            <p class="font-extrabold">Categories</p>
            @foreach ($footerCategories as $category)
                <a class="font-light hover:text-zinc-400 transition-colors" href="{{route('category.show', ['categorySlug' => $category->slug])}}">{{$category->name}}</a>
            @endforeach
            <a class="font-light hover:text-zinc-400 transition-colors" href="{{route('category.index')}}">See all</a>
        </div>

        <div class="flex flex-col gap-3 items-start">
            <p class="font-extrabold">About Us</p>
            <a class="font-light hover:text-zinc-400 transition-colors" href="#">About Us</a>
            <a class="font-light hover:text-zinc-400 transition-colors" href="#">Contact Us</a>
        </div>


        <div class="col-span-2">
            <p class="text-extrabold">&copy; JIJA, 2024. All Rights Reserved.</p>
            <br>
            <p class="text-sm">
                All content included on this site, such as text, graphics, logos, images, audio clips, video clips, data compilations,
                and software, is the property of JIJA or its content suppliers and protected by international copyright laws.
                <br><br>
                The compilation of all content on this site is the exclusive property of JIJA and protected by international
                copyright laws.
            </p>
        </div>

        <div class="max-md:col-span-2 flex w-full flex-col justify-center items-center">
            <x-breeze.application-logo-notext class="max-w-24 w-full h-full" color="#FDFDFD" />
        </div>

    </div>

</footer>
