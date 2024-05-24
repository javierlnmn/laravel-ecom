<div class="w-full h-10 rounded-full border-zinc-900/50 border-[1px] border-solid hover:bg-zinc-200 transition-colors">
    <div class="w-full h-full flex items-center justify-around">
        <input
            @if (isset($required))
            required="{{$required}}"
            @endif
            name="{{$name}}"
            type="text"
            class="w-full !outline-none !ring-0 !focus:outline-none border-none bg-transparent px-6 text-left"
            placeholder="{{$placeholder}}"
            id="text-input-{{$id}}"
            value="{{$value}}"
        >
    </div>
</div>
