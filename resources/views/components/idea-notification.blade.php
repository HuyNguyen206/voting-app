@props([
'displayNotification' => '',
'isRedirect' => false,
'type' => 'success'
])
<div x-data="{
    isShow:false,
    isSuccessForNonRedirect:  @if($type === 'success') true @else false @endif,
    displayNotification:null,
    initNotification() {
             this.isShow = true;
             setTimeout(() => {
             this.isShow = false
             }, 5000)
        }
          }"
     x-show="isShow"
     @click.outside.window="isShow = false"
     x-cloak
     x-transition
     x-init="
            @if(!$isRedirect)
                 window.addEventListener('custom-show-notification', event => {
                 displayNotification = event.detail.message;
                 isSuccessForNonRedirect = event.detail.is_success
                 console.log(displayNotification)
                 initNotification()
            })
            @else
                 displayNotification = '{{$displayNotification}}'
                 initNotification()
            @endif
"
     class="fixed bottom-0 right-0 bg-white rounded-xl shadow-lg border px-6 py-5 mx-6 my-8 max-w-sm w-full z-30">
    <div class="flex justify-between">
        <div class="flex items-center">
                <template x-if="isSuccessForNonRedirect">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-green mr-2 h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </template>
                <template x-if="!isSuccessForNonRedirect">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-red mr-2 h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </template>
            <span class="font-semibold text-gray-600 mr-3" x-text="displayNotification"></span>
        </div>

        <button class="text-gray-600 hover:text-gray-900 text-xl" @click.prevent="isShow = false">&times;</button>
    </div>
</div>
