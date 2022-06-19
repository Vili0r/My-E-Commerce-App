<?php

namespace App\Http\Livewire\FrontEnd;

use App\Models\Attribute;
use Livewire\Component;

class AttributeDropdown extends Component
{
    public $variations;
    public $selectedVariation; //Contains the id 

    public function getSelectedVariationModelProperty()
    {
        if (!$this->selectedVariation) {
            return;
        }    

        return Attribute::find($this->selectedVariation);
    }
    
    public function updatedSelectedVariation()
    {
        $this->emitTo('front-end.product-selector', 'skuVariantSelected', null);

        if($this->selectedVariationModel?->sku){
            $this->emitTo('front-end.product-selector', 'skuVariantSelected', $this->selectedVariation);
        }
    }
    
    public function render()
    {
        return view('livewire.front-end.attribute-dropdown');
    }
}
