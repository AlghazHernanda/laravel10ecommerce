<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Gloudemans\Shoppingcart\Facades\Cart;

class DetailsComponent extends Component
{
    public $slug;

    public function mount($slug)
    {
        $this->slug = $slug;
    }

    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message', 'Item added in Cart');
        return redirect()->route('shop.cart');
    }

    public function render()
    {
        $product = Product::where('slug', $this->slug)->first();
        $rel_products = Product::where('category_id', $product->category_id)->inRandomOrder()->limit(4)->get();
        $new_products = Product::latest()->take(4)->get();
        return view('livewire.details-component', ['product' => $product, 'rel_products' => $rel_products, 'new_products' => $new_products]);
    }
}
