<?php

namespace App\Livewire\News;

use App\Models\News;
use App\Models\Type;
use Carbon\Carbon;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('Notícias - Playtime')]
class ListNews extends Component
{
    use WithPagination;

    public $search = '';
    public $types;
    public $selectedTypes = [];
    public $selectedOrder = 'recent';

    protected $queryString = ['search' => ['except' => '']];

    public function mount()
    {
        $this->types = Type::orderBy('name', 'asc')->get();
    }

    public function render()
    {
        $news = News::query();

        if (!empty($this->selectedTypes)) {
            $news->whereIn('type_id', $this->selectedTypes);
        }

        switch ($this->selectedOrder) {
            case 'views':
                $news->orderBy('views', 'desc');
                break;
            case 'recent':
                $news->orderBy('created_at', 'desc');
                break;
            case 'older':
                $news->orderBy('created_at', 'asc');
                break;
        }

        if($this->search)
        {
            $news->where('title','like','%'. $this->search .'%');
        }

        $news = $news->with('type')->paginate(16);

        $types = Type::orderBy('name', 'asc')->get();

        return view('livewire.news.list-news', ['news' => $news, 'types' => $types]);
    }

    public function formatDate($data)
    {
        return Carbon::parse($data)->diffForHumans();
    }

    public function resetFilter()
    {
        $this->reset(
            'selectedTypes',
            'selectedOrder',
        );
    }
}
