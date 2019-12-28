<?php

namespace App\Http\Livewire;

use App\Post;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    private $posts;

    public $per_page = 10;

    public function render()
    {
        $this->posts = Post::with('user')->paginate($this->per_page);
        return view('livewire.posts', [
            'posts' => $this->posts
        ]);
    }

    public function nextPage($page)
    {
        $this->per_page = $this->per_page * $page;
    }
}
