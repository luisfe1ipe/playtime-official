<?php

namespace App\Livewire\News;

use App\Models\News;
use Livewire\Component;

class ShowNews extends Component
{
    public $news;
    public $recentNews;

    public function mount($id)
    {
        $this->news = News::with(['type', 'user'])->find($id);
        $this->recentNews = News::orderBy('created_at', 'desc')->limit(4)->get();
    }

    public function render()
    {
        return view('livewire.news.show-news');
    }
}
