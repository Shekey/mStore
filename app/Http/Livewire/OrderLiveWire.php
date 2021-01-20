<?php

namespace App\Http\Livewire;

use App\Models\Articles;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Overtrue\LaravelShoppingCart\Facade as ShoppingCart;
use Symfony\Component\HttpFoundation\Response;

class OrderLiveWire extends Component
{

    public $orderId = null, $allOrderItems = null, $isForAuthorOrder = null, $clickedFinish = false, $order = null;

    public function mount($id) {
        $this->orderId = $id;
        $order = Order::where('id',$id)->with('orderproduct')->first();
        $isForAuthor = Order::where('id',$id)->whereHas('orderproduct', function ($query) {
            $query->where('marketId', auth()->user()->isOwner);
        })->get();
        $this->order = $order;
        $this->isForAuthorOrder = count($isForAuthor);
        $isAuthor = $order->customer_id === Auth::user()->id || $this->isForAuthorOrder;
        abort_unless(Auth::user()->isAdmin || $isAuthor, 403);
        $this->allOrderItems = $order->orderproduct;
    }

    public function addToCart(int $productId)
    {
        $article = Articles::find($productId);
        $isActive = $article->isActive;
        $isMarketClosed = $article->market->isClosed;
        $articleInCart = ShoppingCart::search(['id' => $productId]);
        if (count($articleInCart) >= 1 && $isActive && $isMarketClosed) {
            ShoppingCart::update($articleInCart->first()->__raw_id, $articleInCart->first()->qty + 1);
            $this->dispatchBrowserEvent('updatedArticleCart');
        } else {
            $image = count($article->images) > 0 ? $article->images[0]->url : 'https://dummyimage.com/400x400';
            if ($isActive && !$isMarketClosed || auth()->user()->superUser && $isActive) {
                ShoppingCart::add($productId, $article->name, 1, $article->price, ['color' => $article->color,  'profitMake' => $article->profitMake, 'image' => $image, 'isActive' => $article->isActive, 'marketId' => $article->market_id, 'market' => $article->market->name, 'shipping' => $article->market->orderPaid]);
                $this->dispatchBrowserEvent('addedArticleCart');
            }
        }
    }


    public function repeatOrder(){
        $order = Order::find($this->orderId);
        if($order) {
            foreach ($order->orderproduct as $item) {
                $isActive = $item->product->first()->isActive;
                $isMarketClosed = $item->product->first()->market->isClosed;
                $image = count($item->product->first()->images) > 0 ? $item->product->first()->images[0]->url : 'https://dummyimage.com/400x400';
                if ($isActive && !$isMarketClosed || auth()->user()->superUser && $isActive) {
                    ShoppingCart::add($item->product_id, $item->product->first()->name, $item->quantity, $item->product->first()->price, ['color' => $item->product->first()->color,  'profitMake' => $item->product->first()->profitMake, 'image' => $image, 'isActive' => $item->product->first()->isActive, 'marketId' => $item->product->first()->market_id, 'market' => $item->product->first()->market->name, 'shipping' => $item->product->first()->market->orderPaid]);
                }
            }
            $this->dispatchBrowserEvent('repeatedOrder');
        }

    }

    public function render()
    {
        return view('livewire.order-live-wire');
    }
}
