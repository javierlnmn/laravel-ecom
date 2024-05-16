<div class="w-full">
    <div class="w-32 h-10 !cursor-pointer rounded-full hover:bg-zinc-300/30 border-zinc-900/50 border-[1px] border-solid grid place-items-center">
        <select class="outline-none !cursor-pointer !ring-0 !focus:outline-none border-none bg-transparent w-full p-0 text-center" name="{{$name}}" @if (isset($id)) id="{{$id}}" @endif>
            <option value="" selected disabled>-</option>
            @foreach ($product->stock as $stock)
            <option value="{{$stock->size_id}}">{{$stock->size->name}} ({{$stock->quantity}})</option>
            @endforeach
        </select>
    </div>
</div>
