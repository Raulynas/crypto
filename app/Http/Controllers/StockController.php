<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Price;
use Illuminate\Http\Request;

class StockController extends Controller
{
    function priceChange($currentPrice)
    {

        $percentage = rand(-10, 10) / 100;

        return $percentage * $currentPrice;
    }



    function priceGenerator()
    {
        // $stockID = Stock::where("name", $request->title)->first();

        $criptoList = Stock::all();
        // $currentPice = Price::where('stock_id', $stock->id)->first();

        foreach ($criptoList as  $crypto) {

            $currentPrice = Price::where('stock_id', $crypto->id)->orderBy('updated_at', 'DESC')->first()->price;

            $newPrice = $currentPrice + ($this->priceChange($currentPrice));
            $price = new Price();
            $price->stock_id = $crypto->id;
            $price->price = $newPrice;
            $price->save();
        }

        // $price = new Price();
        // $price->stock_id = $stock->id;
        // $price->price = $price;
        // $price->save();

    }

    public function index()
    {
        $this->priceGenerator();

        $stock = Stock::get();
        return view("stock.index", ["stock" => $stock]);
    }

    public function priceList()
    {
        $stock = Stock::get();
        $prices = Price::orderBy('updated_at', 'ASC')->get();
        return [$prices, $stock];
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stock.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stock = new Stock();
        $stock->name = $request->title;
        $stock->abbr = $request->abbr;

        $stock->save();

        $stockID = Stock::where("name", $request->title)->first();


        $price = new Price();
        $price->stock_id = $stockID;
        $price->price = $request->price;
        $price->save();

        return redirect()->route('stock.create')->with("msg", "Asset \"$request->title\" was added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Stock $stock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stock $stock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        //
    }
}
