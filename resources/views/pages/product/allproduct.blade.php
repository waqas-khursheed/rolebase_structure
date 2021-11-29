@extends('layouts.app4')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Product List</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item btn btn-warning"><a href="{{ url('/product/create')}}">Add Product</a></li>
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
                <h3 class="card-title">Product</h3>
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
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Product Unit</th>
                        <th>Cost Price</th>
                        <th>Sale Price</th>
                        <th>description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Product Unit</th>
                        <th>Cost Price</th>
                        <th>Sale Price</th>
                        <th>description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($product as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{App\ProductCategory::where('id',$item->productcategory_id)->first()->productcategory_name}}</td>
                            <td>{{(App\OilBrand::where('id',$item->oilbrand_id)->first() != null )? App\OilBrand::where('id',$item->oilbrand_id)->first()->oilbrand_name : 'Local' }}</td>
                            <td>{{$item->product_name}}</td>
                            <td>{{($item->product_quantity)? $item->product_quantity : 0}}</td>
                            <td>{{$item->product_unit}}</td>
                            <td>{{$item->product_costprice}}</td>
                            <td>{{$item->product_saleprice}}</td>
                            <td>{{$item->product_detail}}</td>
                           
                            <td>
                                <img src="{{asset($item->product_image)}}" alt="{{asset($item->product_image)}}"  style="border-radius: 10%;" width="100" height="100">
                            </td>
                            <td>
                                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#defaultModal{{$item->id}}">Edit</a>
                                    @if (Auth::user()->employeerole_id == 1)
                                    <a data-toggle="modal" data-target="#delete{{$item->id}}" class="btn btn-danger">Delete</a>
                                    @endif
                            </td>
                        </tr>
                        
                        <div class="modal fade" id="delete{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="delete{{$item->id}}Label" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title">Are you want to sure</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-footer">
                                    <form id="car-form" action="{{ URL::to('product/'.$item->id) }}" Method="post" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Confirm</button>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                        
                        <!-- Default Size -->
                        <div class="modal fade" id="defaultModal{{$item->id}}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="title" id="defaultModal{{$item->id}}Label">Edit</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body"> 
                                        <div class="container">
                                            <form id="form_validation" method="POST" action="{{URL::to('product/'.$item->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <select class="form-control show-tick ms select2" data-placeholder="Select Product Category" name="productcategory_id">
                                                    <option></option>
                                                    @foreach (App\ProductCategory::all() as $PROCAT)
                                                        <option value="{{$PROCAT->id}}" {{($PROCAT->id == $item->productcategory_id)? 'Selected' : ''}} >{{$PROCAT->productcategory_name}}</option>
                                                    @endforeach
                                                </select>
                                                <select class="form-control show-tick ms select2 mt-4" data-placeholder="Select Product Brand" name="oilbrand_id">
                                                    <option></option>
                                                    @foreach (App\OilBrand::all() as $oirlbrand)
                                                        <option value="{{$oirlbrand->id}}" {{($oirlbrand->id == $item->oilbrand_id)? 'Selected' : ''}}>{{$oirlbrand->oilbrand_name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-group form-float mt-4">
                                                    <input type="text" class="form-control" placeholder="Enter Product Name" name="product_name" value="{{$item->product_name}}" >
                                                </div>
                                                <div class="form-group form-float mt-4">
                                                    <input type="text" class="form-control" placeholder="Enter Product Unit" name="product_unit" value="{{$item->product_unit}}" >
                                                </div>
                                                <div class="form-group form-float mt-4">
                                                    <input type="number" class="form-control" placeholder="Enter Product Cost Price" name="product_costprice" value="{{$item->product_costprice}}" >
                                                </div>
                                                <div class="form-group form-float mt-4">
                                                    <input type="number" class="form-control" placeholder="Enter Product Sale Price" name="product_saleprice" value="{{$item->product_saleprice}}" >
                                                </div>
                                                <div class="form-group form-float mt-4">
                                                    <textarea class="form-control" name="product_detail" id="product_detail" placeholder="Enter Product Description">{{$item->product_detail}}</textarea>
                                                </div>
                                                <div>
                                                    <input type="file" name="product_image">
                                                </div>
                                                {{-- <select id="optgroup" class="ms" multiple="multiple" name="car_id[]">
                                                    @foreach(App\SubCategory::all() as $cat)
                                                        <optgroup label="{{$cat->subcategory_name}}">
                                                            @foreach(App\Car::select('car_name','id','year_id','brand_id')->get() as $product)
                                                                <option value="{{$product->id}}">{{$product->car_name }} {{ App\Year::find($product->year_id)->year }} {{ App\Brand::find($product->brand_id)->brand_name}} </option>
                                                            @endforeach
                                                        </optgroup>
                                                    @endforeach
                                                </select> --}}
                                                   <!-- /.card-body -->
                                                <div class="card-footer">
                                                    <button type="submit" class="btn btn-primary">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
