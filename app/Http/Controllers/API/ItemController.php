<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Requests\ItemOrderRequest;
use App\Item;
use App\Http\Resources\ItemResource;
use App\Http\Resources\ItemCollection;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{   
    private $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->item->ordered()->get();
        return new ItemCollection($items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        $item = $this->item->create($request->all());
        $item->order = $this->item->max('order') + 1;
        $item->save();
        return (new ItemResource($item))
            ->response()
            ->header('Location', route('items.show', ['item' => $item->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = $this->item->findOrFail($id);
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, $id)
    {
        $item = $this->item->findOrFail($id);
        $item->fill($request->all());
        $item->save();
        return (new ItemResource($item))
            ->response()
            ->header('Location', route('items.show', ['item' => $item->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = $this->item->findOrFail($id);
        $item->delete();
        return response(null, 204);
    }

    public function updateOrder(ItemOrderRequest $request)
    {
        foreach ($request->all() as $orderConfig) {
            DB::collection('items')
                ->where('_id', $orderConfig['id'])
                ->update(['order' => $orderConfig['order']]);
        }
        return response(null, 204);
    }
}
