<?php

namespace App\Livewire\Components;

use App\Models\Character;
use App\Traits\CustomGetImage;
use Livewire\Attributes\On;
use Livewire\Component;

class SelectWithImage extends Component
{
    public $item_select;
    public $items;
    public $itemsOriginal;
    public $searchItem = '';
    public $gameId;
    public $wire_model;
    public $absolute;

    public function mount($items, $gameId, $wire_model = null, $item_select = null, $absolute = true)
    {
        $this->items = $items;
        $this->gameId = $this->gameId;
        $this->itemsOriginal = $this->items;
        $this->wire_model = $wire_model;
        $this->item_select = $item_select;
        $this->absolute = $absolute;
    }

    public function render()
    {

        $items = $this->itemsOriginal;

        if ($this->gameId != null) {
            $this->items = $items->where('game_id', $this->gameId);
        }

        if ($this->searchItem) {
            $this->items = $this->items->filter(function ($item) {
                return stripos($item->name, $this->searchItem) !== false;
            });
        }


        return view('livewire.components.select-with-image');
    }

    public function unselectItem()
    {
        if (!$this->item_select) {
            return;
        }

        foreach ($this->item_select as $key => $value) {
            $this->{$key} = null;
        }


        $this->dispatch('select-item', [
            'model' => get_class($this->item_select),
            'value' => null,
            'wire_model' => $this->item_select->wire_model = $this->wire_model
        ]);
        $this->item_select = null;
    }

    public function selectItem($id)
    {
        $this->item_select = $this->items->where('id', $id)->first();

        if ($this->wire_model != null) {
            $this->item_select->wire_model = $this->wire_model;
        }

        $this->dispatch('select-item', [
            'model' => get_class($this->item_select),
            'value' => $this->item_select
        ]);
    }
}
