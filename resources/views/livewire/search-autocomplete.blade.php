<div>
    <div class="max-w-sm relative">
        <input type="text" wire:model="searchQuery" class="py-2 w-full relative z-20 focus:shadow-outline focus:outline-none px-2 border border-gray-200 rounded">
        @if(count($searchResults) > 0)
            <div  class="shadow bg-white mt-1 rounded-t-none rounded-b-lg overflow-hidden absolute z-10 w-full border-gray-100">
                <ul>
                    @foreach($searchResults as $user)
                        <li class="block">
                            <a href="#" class="pt-2 pb-4 px-2 hover:bg-gray-200 w-full block">
                                <div class="flex ">
                                    <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="text-xs w-10 rounded-lg h-10">
                                    <div class="pl-4">
                                        <p class="text-sm font-semibold text-gray-800">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-600">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @else
            @if($this->noSearchResults)
                <div  class="shadow bg-white mt-1 rounded-t-none rounded-b-lg overflow-hidden absolute z-10 w-full border-gray-100">
                    <ul>
                        <li class="block">
                            <div href="#" class="pt-2 pb-4 px-2 w-full block">
                                <div class="">
                                    <p class="font-semibold text-center text-xs text-gray-600">No results for query "{{ $this->searchQuery }}"</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            @endif
        @endif
    </div>
</div>
