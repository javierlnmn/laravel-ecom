<div class="fixed w-full top-5" id="message-pop-up-container">
    <div class="relative animate-enter-screen w-[500px] max-w-[90%] mx-auto bg-red-500 text-zinc-100 flex flex-col {{$additionalClassesBox ?? ''}}">
        <p class="p-6 {{$additionalClassesText ?? ''}}">{{ $message }}</p>
        <span class="-mb-4 h-4 w-full bg-red-700 animate-disappear-width {{$additionalClassesTimerLine ?? ''}}"></span>
        <span class="absolute top-1 right-3 text-2xl cursor-pointer" id="close-message-button">&times;</span>
    </div>

</div>

<script>
    const messagePopUpContainer = document.getElementById('message-pop-up-container');
    setTimeout(() => {
        messagePopUpContainer.classList.add('animate-leave-screen');
        setTimeout(() => {
            messagePopUpContainer.classList.add('hidden');
        }, 1000);
    }, 4000);

    const closeMessageButton = document.getElementById('close-message-button');

    closeMessageButton.addEventListener('click', () => {
        messagePopUpContainer.classList.add('animate-leave-screen');
        setTimeout(() => {
            messagePopUpContainer.classList.add('hidden');
        }, 1000);
    });
</script>
