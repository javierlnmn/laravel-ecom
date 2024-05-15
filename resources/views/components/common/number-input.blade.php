<div class="w-32 h-10 rounded-full border-zinc-900/50 border-[1px] border-solid">
    <div class="w-full h-full flex items-center justify-around">
        <div class="hover:bg-zinc-300/30 transition-colors duration-[300ms] h-full grid place-items-center rounded-l-full cursor-pointer select-none w-12 text-center text-xl font-extrabold" id="button-decrease-number-{{$id}}">
            -
        </div>
        <div>
            <input
                name="{{$name}}"
                type="number"
                @if (isset($min)) min="{{$min}}" @endif
                @if (isset($max)) max="{{$max}}" @endif
                class="!outline-none !ring-0 [appearance:textfield] !focus:outline-none border-none bg-transparent w-12 p-0 text-center"
                @if(isset($initialValue))
                    value="{{$initialValue}}"
                @else
                    value="0"
                @endif
                id="number-input-{{$id}}"
            >
        </div>
        <div class="hover:bg-zinc-300/30 transition-colors duration-[300ms] h-full grid place-items-center rounded-r-full cursor-pointer select-none w-12 text-center text-xl font-extrabold" id="button-increase-number-{{$id}}">
            +
        </div>
    </div>
    <script>
        const numberInput = document.getElementById('number-input-{{$id}}');
        const buttonIncreaseNumber = document.getElementById('button-increase-number-{{$id}}');
        const buttonDecreaseNumber = document.getElementById('button-decrease-number-{{$id}}');

        buttonIncreaseNumber.addEventListener('click', () => {
            if(numberInput.value >= {{$max}}) return;
            numberInput.value = parseInt(numberInput.value) + 1;
        });

        buttonDecreaseNumber.addEventListener('click', () => {
            if(numberInput.value <= {{$min}}) return;
            numberInput.value = parseInt(numberInput.value) - 1;
        });

    </script>
</div>
