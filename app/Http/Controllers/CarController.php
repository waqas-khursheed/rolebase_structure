<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\SubCategory;
use App\Year;
use App\Brand;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subcategory = SubCategory::all();
        $year = Year::all();
        $brand = Brand::all();

        $car = DB::table('cars')
        ->join('brands','brands.id','cars.brand_id')
        ->join('years','years.id','cars.year_id')
        ->join('sub_categories','sub_categories.id','cars.subcategory_id')
        ->join('categories','categories.id','sub_categories.category_id')
        ->select(
            'categories.category_name',
            'sub_categories.subcategory_name',
            'brands.brand_name',
            'years.year',
            'cars.id',
            'cars.subcategory_id',
            'cars.brand_id',
            'cars.year_id',
            'cars.car_modal',
            'cars.car_name',
            'cars.car_image'
        )->orderBy('id','desc')
        ->paginate(10);
        return view('pages.car.allcar',compact('car', 'subcategory', 'year', 'brand'));



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subcategory = SubCategory::all();
        $year = Year::all();
        $brand = Brand::all();
        return view('pages.car.createcar', compact('subcategory', 'year', 'brand'));

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
            'subcategory' => 'required',
            'year' => 'required',
            'brand' => 'required',
            'car_name' => 'required',
            'car_model' => 'required ',
            'image' => 'required|image',
        ], [
            'subcategory.required' => 'Select subcategory',
            'year.required' => 'Select Year',
            'brand.required' => 'Select Brand',
            'car_name.required' => 'Car Name is required',
            'car_model.required' => 'Car Model is required',
            'image.required' => 'image is required',
        ]);

        $car = new Car();
        $car->subcategory_id = $request->subcategory;
        $car->year_id = $request->year;
        $car->brand_id = $request->brand;
        $car->car_name = $request->car_name;
        $car->car_modal = $request->car_model;
    
        $file = $request->file('image') ;
        $fileName = $file->getClientOriginalName() ;
        $name = Auth::user()->name.date('d-M-Y').$fileName ;
        $file->move('images/car/', $name);
        $car->car_image = 'images/car/'.$name;
        
        $car->save();
        return redirect()->back()->with('success', 'Successfully Car Add');
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
        $car = Car::find($id);
        $car->subcategory_id = $request->subcategory;
        $car->brand_id = $request->brand;
        $car->year_id = $request->year;
        $car->car_name = $request->car_name;
        $car->car_modal = $request->car_model;

        if ($request->has('image')) {
            $file = $request->file('image') ;
            $fileName = $file->getClientOriginalName() ;
            $name = Auth::user()->name.date('d-M-Y').$fileName ;
            $file->move('images/car/', $name);
            $car->car_image = 'images/car/'.$name;
        }
        $car->update();
        return redirect()->back()->with('success', 'Successfully Car Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Car::find($id)->delete();
        return redirect()->back()->with('success','Delete Successfully');
    }
}
