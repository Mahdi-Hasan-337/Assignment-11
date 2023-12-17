<?php

namespace App\Http\Controllers;
use App\Models\Products;
use App\Models\Sell;
use App\Models\Sold;
use Illuminate\Http\Request;
use Illuminate\View\View;

class Product_Controller extends Controller {
    public function index() {
        $products = Products::all();
        $soldItems = Sold::all();

        $todaySales = Sold::whereDate('created_at', today())->sum('price_sold');
        $yesterdaySales = Sold::whereDate('created_at', today()->subDay())->sum('price_sold');
        $thisMonthSales = Sold::whereYear('created_at', today()->year)
            ->whereMonth('created_at', today()->month)
            ->sum('price_sold');
        $lastMonthSales = Sold::whereYear('created_at', today()->subMonth()->year)
            ->whereMonth('created_at', today()->month)
            ->sum('price_sold');

        return view('dashboard', compact('todaySales', 'yesterdaySales', 'thisMonthSales', 'lastMonthSales', 'products', 'soldItems'));
    }

    public function create() {
        return view('create');
    }

    public function store(Request $request) {
        $product = new Products;
        $product->name = $request->input('name');
        $product->quantity = $request->input('quantity');
        $product->unit_price = $request->input('unit_price');
        $product->save();

        return redirect('/')->with('status', 'Added Successfully');
    }

    public function edit($id) {
        $product = Products::find($id);
        return view('edit', compact('product'));
    }

    public function update(Request $request, $id) {
        $product = Products::find($id);
        $product->name = $request->input('name');
        $product->quantity = $request->input('quantity');
        $product->unit_price = $request->input('unit_price');
        $product->update();

        return redirect('/')->with('status', 'Updated Successfully');
    }

    // public function delete($id) {
    //     $product = Products::find($id);
    //     $product->delete();

    //     return redirect('/')->with('status', 'Deleted Successfully');
    // }

    public function delete($id) {
        $product = Products::find($id);

        $hasSales = Sold::where('product_id', $id)->exists();

        if ($hasSales) {
            return redirect('/')->with('error', 'Cannot delete product with associated sales');
        }

        $product->delete();

        return redirect('/')->with('status', 'Deleted Successfully');
    }

    public function sold($id) {
        $product = Products::find($id);
        return view('sell', compact('product'));
    }

    public function sell(Request $request, $id) {
        $product = Products::find($id);

        $requestedQuantity = $request->input('quantity');

        if ($product->quantity >= $requestedQuantity) {
            $priceSold = $requestedQuantity * $product->unit_price;

            $product->quantity -= $requestedQuantity;
            $product->update();

            Sold::create([
                'product_id' => $product->id,
                'quantity_sold' => $requestedQuantity,
                'price_sold' => $priceSold,
                'sold_at' => now(),
            ]);

            return redirect('/')->with('status', 'Product sold successfully');
        } else {
            return redirect('/')->with('status', 'Insufficient quantity to sell');
        }
    }

}
