<div class="bg-white border-gray-200 border">
    <div>
        <h3 class="font-semibold text-gray-800 border-b  py-2 px-4">Posts with load more button</h3>
    </div>
    <div class="h-screen overflow-auto   posts-container">
        @foreach($posts as $post)
            <div class="flex  px-4 border-b py-6" {{ $loop->last ? '' : 'mb-8' }}>
                <div class="flex-none">
                    <img src="{{ $post->user->avatar }}" class="w-8 h-8 rounded-lg" alt="">
                </div>
                <div class="flex-1 ml-4">
                    <div class="">
                        <span class="font-semibold text-gray-700">{{ $post->user->name }}</span>
                    </div>
                    <div>
                        <p class="text-gray-900">{{ $post->text }}</p>
                    </div>
                </div>
            </div>
        @endforeach
        <div>
            <button class="w-full h-full text-blue-700 hover:text-blue-800  py-2 px-4 font-semibold" wire:click.prevent="nextPage({{ $posts->currentPage() + 1 }})">Load More </button>
        </div>
    </div>
</div>
@push("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const postsContainer = document.querySelector('.posts-container');4
            postsContainer.addEventListener('scroll', function (event) {
                const element = event.target;
                var hasScrolledToBottom = element.scrollHeight - element.scrollTop === element.clientHeight;
                if(hasScrolledToBottom) {
                    @this.call('nextPage', {{ $posts->currentPage() + 1 }})
                }
            })
        })
    </script>
@endpush
