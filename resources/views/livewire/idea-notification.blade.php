<div x-data="{isShow:false, displayNotification:null }" x-show="isShow"
         @click.outside.window="isShow = false"
{{--         @custom-show-notification.window="isShow = true; setTimeout(() => {--}}
{{--         isShow = false--}}
{{--         }, 5000)"--}}
         x-cloak
         x-transition
         x-init="window.addEventListener('custom-show-notification', event => {
             displayNotification = event.detail;
             console.log(displayNotification)
             isShow = true;
             setTimeout(() => {
             isShow = false
             }, 5000)
})"
         class="fixed bottom-0 right-0 bg-white rounded-xl shadow-lg border px-6 py-5 mx-6 my-8 max-w-sm w-full">
        <div class="flex justify-between">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-green mr-2 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="font-semibold text-gray-600 mr-3" x-text="displayNotification"></span>
            </div>

            <button class="text-gray-600 hover:text-gray-900 text-xl" @click.prevent="isShow = false">&times;</button>
        </div>
</div>
