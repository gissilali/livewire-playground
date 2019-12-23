<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class SearchAutocomplete extends Component
{
    public $searchQuery;

    public $noSearchResults = false;

    public function render()
    {
        $searchResults = [];
        if (strlen($this->searchQuery) > 0) {
            $searchResults = User::where('name', 'like', '%'. $this->searchQuery.'%')->take(12)->get();
            $this->noSearchResults = count($searchResults) === 0;
        }


        return view('livewire.search-autocomplete', [
            'searchResults' => $searchResults
        ]);
    }
}
