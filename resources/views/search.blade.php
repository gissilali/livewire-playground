@extends("layouts.app")
@section("content")
    <div class="flex">
        <div class="w-4/12">
            @livewire("search-autocomplete")
        </div>
        <div class="w-6/12">
            @livewire("posts")
        </div>
    </div>
@endsection
