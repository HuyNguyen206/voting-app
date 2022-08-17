<x-app-layout>
    <a href="{{route('ideas.index')}}" class="font-semibold flex mb-2"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
        </svg><span>All ideas</span></a>
    <livewire:idea-show :idea="$idea"/>
    <x-idea-notification />

    <x-modals-container :idea="$idea"/>

    <livewire:idea-comments :idea="$idea"/>
    <x-slot name="title">
       {{$idea->title}}
    </x-slot>
</x-app-layout>
