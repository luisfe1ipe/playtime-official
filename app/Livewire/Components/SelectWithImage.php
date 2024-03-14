<?php

namespace App\Livewire\Components;

use App\Models\Character;
use Livewire\Component;

class SelectWithImage extends Component
{
    public $item_select;
    public $items;
    public $itemsOriginal;
    public $searchItem = '';
    public $gameId;

    public function mount($items, $gameId)
    {
        $this->items = $items;
        $this->gameId = $gameId;
        $this->itemsOriginal = $this->items;
    }

    public function render()
    {
        if (!$this->items->isEmpty()) {
            $items = $this->items->first()->getModel()->query();

            if ($this->searchItem) {
                $items->where('game_id', $this->gameId)->where('name', 'like', '%' . $this->searchItem . '%');
            }

            $this->items = $items->get();
        } else {
            $this->items = $this->itemsOriginal;
        }


        return view('livewire.components.select-with-image');
    }

    public function unselectItem()
    {
        $this->item_select = null;
    }

    public function selectItem($id)
    {
        $this->item_select = $this->items->where('id', $id)->first();
        $this->item_select->model = get_class($this->item_select);
        $this->dispatch('select-item', $this->item_select);
    }
}
