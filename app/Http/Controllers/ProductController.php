<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\CarProduct;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();
        return view('pages.product.allproduct',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.product.createproduct');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'productcategory_id' => 'required',
            // 'oilbrand_id' => 'required',
            // 'vender_id' => 'required',
            'product_name' => 'required',
            'product_unit' => 'required',
            'product_costprice' => 'required|numeric',
            'product_saleprice' => 'required|numeric',
            'product_detail' => 'required',
            'product_image' => 'required|image',
        ], [
            'productcategory_id.required' => 'Select Product Category',
            // 'oilbrand_id.required' => 'Select Product Brand',
            // 'vender_id.required' => 'Select Vender',
            'product_name.required' => 'Product Name Is Required',
            'product_unit.required' => 'Product Unit Is Required',
            'product_costprice.required' => 'Product Cost Price Is Required',
            'product_saleprice.required' => 'Product Sale Price Is Required',
            'product_detail.required' => 'Product Detail Is Required',
            'product_image.required' => 'image is required',
        ]);

        $product = new Product();
        $product->productcategory_id = $request->productcategory_id;
        $product->oilbrand_id = $request->oilbrand_id;
        // $product->vender_id = $request->vender_id;
        $product->product_name = $request->product_name;
        $product->product_unit = $request->product_unit;
        $product->product_costprice = $request->product_costprice;
        $product->product_saleprice = $request->product_saleprice;
        $product->product_detail = $request->product_detail;

            $file = $request->file('product_image') ;
            $fileName = $file->getClientOriginalName() ;
            $name = Auth::user()->name.date('d-M-Y s').$fileName ;
            $file->move('images/product/', $name);

        $product->product_image = 'images/product/'.$name;
        
        if($product->save()){
            for ($i=0; $i < count($request->car_id); $i++) { 
                $carpro = new CarProduct();
                $carpro->car_id = $request->car_id[$i];
                $carpro->product_id = Product::orderBy('id','desc')->first()->id;
                $carpro->save();
            }
        }
        return redirect()->back()->with('success', 'Successfully Product Add');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->productcategory_id = $request->productcategory_id;
        $product->oilbrand_id = $request->oilbrand_id;
        // $product->vender_id = $request->vender_id;
        $product->product_name = $request->product_name;
        $product->product_unit = $request->product_unit;
        $product->product_costprice = $request->product_costprice;
        $product->product_saleprice = $request->product_saleprice;
        $product->product_detail = $request->product_detail;
        if ($request->has('product_image')) {
            $file = $request->file('product_image') ;
            $fileName = $file->getClientOriginalName() ;
            $name = Auth::user()->name.date('d-M-Y s').$fileName ;
            $file->move('images/product/', $name);
            $product->product_image = 'images/product/'.$name;
        }
        $product->update();
        return redirect()->back()->with('success', 'Successfully Product Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::find($id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
