<?php

namespace App\Livewire\Components;

use App\Models\Character;
use App\Traits\CustomGetImage;
use Livewire\Component;

class SelectWithImage extends Component
{
    public $item_select;
    public $items;
    public $itemsOriginal;
    public $searchItem = '';
    public $gameId;
    public $wire_model;

    public function mount($items, $gameId, $wire_model = null)
    {
        $this->items = $items;
        $this->gameId = $this->gameId;
        $this->itemsOriginal = $this->items;
        $this->wire_model = $wire_model;
    }

    public function render()
    {

        $items = $this->itemsOriginal;

        $this->items = $items->where('game_id', $this->gameId);

        if ($this->searchItem) {
            $this->items = $this->items->filter(function ($item) {
                return stripos($item->name, $this->searchItem) !== false;
            });
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

        if ($this->wire_model != null) {
            $this->item_select->wire_model = $this->wire_model;
        }

        $this->dispatch('select-item', $this->item_select);
    }
}
