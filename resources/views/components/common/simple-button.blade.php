@if (isset($submitButton))
<button
    type="submit"
    class="@if(isset($additionalClasses)){{$additionalClasses}}@endif px-6 cursor-pointer text-center text-zinc-200 bg-zinc-800 hover:bg-zinc-700 py-4 transition-colors"
    {{ $attributes }}
>
    {{$text}}
</button>
@else
<a
    href="{{$link}}"
    class="@if(isset($additionalClasses)){{$additionalClasses}}@endif px-6 cursor-pointer text-center text-zinc-200 bg-zinc-800 hover:bg-zinc-700 py-4 transition-colors"
    {{ $attributes }}
>
    {{$text}}
</a>
@endif

