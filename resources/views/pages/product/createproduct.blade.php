@extends('layouts.app4')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Add Product</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item btn btn-warning"><a href="{{ url('/product')}}">Product List</a></li>
                </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Create Product</h3>
                      @if(Session::has('success'))
                          <div class="alert alert-success">
                              {{ Session::get('success') }}
                              @php
                                  Session::forget('success');
                              @endphp
                          </div>
                      @endif
                </div>
                <!-- /.card-header -->

              <!-- form start -->
              <form role="form" id="quickForm" method="POST" action="{{URL::to('/product')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <select class="form-control show-tick ms select2" data-placeholder="Select Product Category" name="productcategory_id">
                            <option selected="" disabled="">Select Product Category</option>
                            <option></option>
                            @foreach (App\ProductCategory::all() as $item)
                                <option value="{{$item->id}}" {{(old('productcategory_id') == $item->id )? 'Selected' : '' }}>{{$item->productcategory_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('productcategory_id'))
                            <label id="productcategory_id-error" class="error text-danger" for="productcategory_id">{{ $errors->first('productcategory_id') }}</label>
                        @endif
                    </div>   
                    
                    <div class="form-group">
                        <select class="form-control show-tick ms select2 mt-4" data-placeholder="Select Product Brand" name="oilbrand_id">
                        <option selected="" disabled="">Select Oil Brand</option>
                        <option></option>
                            @foreach (App\OilBrand::all() as $item)
                                <option value="{{$item->id}}" {{(old('oilbrand_id') == $item->id )? 'Selected' : '' }}>{{$item->oilbrand_name}}</option>
                            @endforeach
                        </select>

                    </div>       

                        {{-- <select class="form-control show-tick ms select2 mt-4" data-placeholder="Select Vender" name="vender_id">
                            <option></option>
                            @foreach (App\Vender::all() as $item)
                                <option value="{{$item->id}}">{{$item->vender_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('vender_id'))
                            <label id="vender_id-error" class="error text-danger" for="vender_id">{{ $errors->first('vender_id') }}</label>
                        @endif --}}



                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="{{ old('product_name') }}" required="" >
                            @if ($errors->has('product_name'))
                                <label id="product_name-error" class="error" for="product_name">{{ $errors->first('product_name') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Enter Product Unit" name="product_unit" value="{{ old('product_unit') }}" required="" >
                            @if ($errors->has('product_unit'))
                                <label id="product_unit-error" class="error" for="product_unit">{{ $errors->first('product_unit') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Enter Product Cost Price" value="{{ old('product_costprice') }}" name="product_costprice" required="" >
                            @if ($errors->has('product_costprice'))
                                <label id="product_costprice-error" class="error" for="product_costprice">{{ $errors->first('product_costprice') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control" placeholder="Enter Product Sale Price" name="product_saleprice" value="{{ old('product_saleprice') }}" required="" >
                            @if ($errors->has('product_saleprice'))
                                <label id="product_saleprice-error" class="error" for="product_saleprice">{{ $errors->first('product_saleprice') }}</label>
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" name="product_detail" id="product_detail" cols="4" rows="2" placeholder="Enter Product Description" required="" > {{{ old('product_detail') }}} </textarea>
                            @if ($errors->has('product_detail'))
                                <label id="product_detail-error" class="error" for="product_detail">{{ $errors->first('product_detail') }}</label>
                            @endif
                        </div>
                        <div class="mb-4">
                            <input type="file" class="dropify" name="product_image" accept="image/x-png" required="">
                            <label id="product_image-error" class="error text-danger" for="product_image"><span class="text-dark">Note:</span> Only Upload PNG Images </label><br>
                            @if ($errors->has('product_image'))
                            <label id="product_image-error" class="error text-danger" for="product_image">{{ $errors->first('product_image') }}</label>
                            @endif
                        </div>
                        <select id="optgroup" class="ms" multiple="multiple" name="car_id[]">
                            @foreach(App\SubCategory::all() as $cat)
                                <optgroup label="{{$cat->subcategory_name}}">
                                    @foreach(App\Car::select('car_name','id','year_id','brand_id')->get() as $product)
                                        <option value="{{$product->id}}">{{$product->car_name }} {{ App\Year::find($product->year_id)->year }} {{ App\Brand::find($product->brand_id)->brand_name}} </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>


                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
