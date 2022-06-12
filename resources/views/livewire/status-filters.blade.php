<div>
    <nav class="hidden lg:flex items-center justify-between text-xs ">
        <ul class="flex uppercase space-x-10 border-b-4 pb-3">
            <li><a  wire:click.prevent="updateStatusFilter('all',{{request()->routeIs('ideas.show')}})" href="#" class="border-b-4 @if($status === 'all') font-semibold text-gray-800 border-blue @endif text-gray-400 pb-3 transition duration-75 ease-in">All ideas ({{ $statusCount['All'] ?? 0}})</a></li>
            <li ><a  wire:click.prevent="updateStatusFilter('considering',{{request()->routeIs('ideas.show')}})" href="" class="@if($status === 'considering') font-semibold text-gray-800 border-blue @endif text-gray-400 transition duration-75 ease-in border-b-4 pb-3 hover:border-blue">Considering ({{ $statusCount['Considering'] ?? 0}})</a></li>
            <li  wire:click.prevent="updateStatusFilter('in_progress',{{request()->routeIs('ideas.show')}})"><a href="" class="@if($status === 'in_progress') font-semibold text-gray-800 border-blue @endif text-gray-400 transition duration-75 ease-in border-b-4 pb-3 hover:border-blue">In Progress ({{ $statusCount['In Progress'] ?? 0}})</a></li>
        </ul>

        <ul class="flex uppercase space-x-10 border-b-4 pb-3">
            <li  wire:click.prevent="updateStatusFilter('implemented',{{request()->routeIs('ideas.show')}})"><a href="" class="@if($status === 'implemented') font-semibold text-gray-800 border-blue @endif text-gray-400 border-b-4 pb-3">Implemented ({{ $statusCount['Implemented'] ?? 0}})</a></li>
            <li  wire:click.prevent="updateStatusFilter('closed',{{request()->routeIs('ideas.show')}})"><a href="" class="@if($status === 'closed') font-semibold text-gray-800 border-blue @endif text-gray-400 transition duration-75 ease-in border-b-4 pb-3 hover:border-blue">Closed ({{ $statusCount['Closed'] ?? 0}})</a></li>
        </ul>
    </nav>
</div>
