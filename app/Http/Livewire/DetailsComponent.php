<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;

class DetailsComponent extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $rel_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
        $new_products = Product::latest()->take(4)->get();
        return view('livewire.details-component', ['product' => $product, 'rel_products' => $rel_products, 'new_products' => $new_products]);
    }
}
