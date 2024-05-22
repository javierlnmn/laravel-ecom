<div class="absolute w-full top-5" id="message-pop-up-container">
    <div class="relative w-[500px] max-w-[90%] mx-auto bg-red-500 text-zinc-200 flex flex-col">
        <p class="p-6">{{ $errors->first('message') }}</p>
        <span class="-mb-4 h-4 w-full bg-red-700 animate-disappear-width"></span>
    </div>

</div>

<script>
    const messagePopUpContainer = document.getElementById('message-pop-up-container');
    setTimeout(() => {
        messagePopUpContainer.classList.add('animate-leave-screen');
        setTimeout(() => {
            messagePopUpContainer.classList.add('hidden')
        }, 1000);
    }, 5000);
</script>
