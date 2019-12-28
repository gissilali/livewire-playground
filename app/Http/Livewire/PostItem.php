<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PostItem extends Component
{
    private $post;

    public function mount($post)
    {
        $this->post = $post;
    }
    public function render()
    {
        return view('livewire.post-item', [
            'post' => $this->post
        ]);
    }
}
