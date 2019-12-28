<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="max-w-sm relative">
        <input type="text" wire:model="searchQuery" class="py-2 w-full relative z-20 focus:shadow-outline focus:outline-none px-2 border border-gray-200 rounded">
        <div  aria-expanded="{{ count($searchResults) ? 'true' : 'false'  }}" class="{{ count($searchResults) ? 'visible' : 'hidden'  }} dropdown_list_container shadow bg-white mt-1 rounded-t-none rounded-b-lg overflow-hidden absolute z-10 w-full border-gray-100">
            <ul class="dropdown_list">
                @foreach($searchResults as  $user)
                    <li wire:key="{{ $loop->index }}" class="block dropdown_list_item {{ $loop->index === 0 ? 'dropdown_item_selected': '' }}">
                        <a href="#" tabindex="0" class=" pt-2 pb-4 px-2 focus:bg-gray-200 focus:outline-none hover:bg-gray-200 w-full block">
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
    </div>
</div>
@push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const SPACEBAR_KEY_CODE = [0,32];
            const ENTER_KEY_CODE = 13;
            const DOWN_ARROW_KEY_CODE = 40;
            const UP_ARROW_KEY_CODE = 38;
            const ESCAPE_KEY_CODE = 27;

            const list = document.querySelector(".dropdown_list");
            const dropdownArrow = document.querySelector(".dropdown__arrow");
            const listItems = document.querySelectorAll(".dropdown_list_item");
            const listContainer = document.querySelector(".dropdown_list_container");
            const dropdownSelectedNode = document.querySelector(".dropdown_item_selected");
            const listItemIds = [];

            dropdownSelectedNode.addEventListener("click", e =>
                toggleListVisibility(e)
            );
            dropdownSelectedNode.addEventListener("keydown", e =>
                toggleListVisibility(e)
            );

            listItems.forEach(item => listItemIds.push(item.id));

            listItems.forEach(item => {
                item.addEventListener("click", e => {
                    setSelectedListItem(e);
                    closeList();
                });

                item.addEventListener("keydown", e => {
                    switch (e.keyCode) {
                        case ENTER_KEY_CODE:
                            setSelectedListItem(e);
                            closeList();
                            return;

                        case DOWN_ARROW_KEY_CODE:
                            focusNextListItem(DOWN_ARROW_KEY_CODE);
                            return;

                        case UP_ARROW_KEY_CODE:
                            focusNextListItem(UP_ARROW_KEY_CODE);
                            return;

                        case ESCAPE_KEY_CODE:
                            closeList();
                            return;

                        default:
                            return;
                    }
                });
            });

            function setSelectedListItem(e) {
                let selectedTextToAppend = document.createTextNode(e.target.innerText);
                dropdownSelectedNode.innerHTML = null;
                dropdownSelectedNode.appendChild(selectedTextToAppend);
            }

            function closeList() {
                list.classList.remove("open");
                dropdownArrow.classList.remove("expanded");
                listContainer.setAttribute("aria-expanded", false);
            }

            function toggleListVisibility(e) {
                let openDropDown =
                    SPACEBAR_KEY_CODE.includes(e.keyCode) || e.keyCode === ENTER_KEY_CODE;

                if (e.keyCode === ESCAPE_KEY_CODE) {
                    closeList();
                }

                if (e.type === "click" || openDropDown) {
                    list.classList.toggle("open");
                    dropdownArrow.classList.toggle("expanded");
                    listContainer.setAttribute(
                        "aria-expanded",
                        list.classList.contains("open")
                    );
                }

                if (e.keyCode === DOWN_ARROW_KEY_CODE) {
                    focusNextListItem(DOWN_ARROW_KEY_CODE);
                }

                if (e.keyCode === UP_ARROW_KEY_CODE) {
                    focusNextListItem(UP_ARROW_KEY_CODE);
                }
            }

            function focusNextListItem(direction) {
                const activeElementId = document.activeElement.id;
                if (activeElementId === "dropdown__selected") {
                    document.querySelector(`#${listItemIds[0]}`).focus();
                } else {
                    const currentActiveElementIndex = listItemIds.indexOf(
                        activeElementId
                    );
                    if (direction === DOWN_ARROW_KEY_CODE) {
                        const currentActiveElementIsNotLastItem =
                            currentActiveElementIndex < listItemIds.length - 1;
                        if (currentActiveElementIsNotLastItem) {
                            const nextListItemId = listItemIds[currentActiveElementIndex + 1];
                            document.querySelector(`#${nextListItemId}`).focus();
                        }
                    } else if (direction === UP_ARROW_KEY_CODE) {
                        const currentActiveElementIsNotFirstItem =
                            currentActiveElementIndex > 0;
                        if (currentActiveElementIsNotFirstItem) {
                            const nextListItemId = listItemIds[currentActiveElementIndex - 1];
                            document.querySelector(`#${nextListItemId}`).focus();
                        }
                    }
                }
            }
        })
    </script>
@endpush
