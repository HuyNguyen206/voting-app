<div>
    <nav class="hidden lg:flex items-center justify-between text-xs ">
        <ul class="flex uppercase space-x-10 border-b-4 pb-3">
            <li><a  wire:click.prevent="updateStatusFilter('all')" href="#" class="border-b-4 @if($status === 'all') font-semibold text-gray-800   border-blue @endif text-gray-400 pb-3 transition duration-75 ease-in">All ideas ({{ $statusCount['All']}})</a></li>
            <li ><a  wire:click.prevent="updateStatusFilter('considering')" href="" class="@if($status === 'considering') font-semibold text-gray-800 border-blue @endif text-gray-400 transition duration-75 ease-in border-b-4 pb-3 hover:border-blue">Considering ({{ $statusCount['Considering']}})</a></li>
            <li  wire:click.prevent="updateStatusFilter('in_progress')"><a href="" class="@if($status === 'in_progress') font-semibold text-gray-800 border-blue @endif text-gray-400 transition duration-75 ease-in border-b-4 pb-3 hover:border-blue">In Progress ({{ $statusCount['In Progress']}})</a></li>
        </ul>

        <ul class="flex uppercase space-x-10 border-b-4 pb-3">
            <li  wire:click.prevent="updateStatusFilter('implemented')"><a href="" class="@if($status === 'implemented') font-semibold text-gray-800 border-blue @endif text-gray-400 border-b-4 pb-3">Implemented ({{ $statusCount['Implemented']}})</a></li>
            <li  wire:click.prevent="updateStatusFilter('close')"><a href="" class="@if($status === 'close') font-semibold text-gray-800 border-blue @endif text-gray-400 transition duration-75 ease-in border-b-4 pb-3 hover:border-blue">Closed ({{ $statusCount['Close']}})</a></li>
        </ul>
    </nav>
</div>
