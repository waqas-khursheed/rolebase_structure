@extends('layouts.app4')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Add Car</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item btn btn-warning"><a href="{{ url('/car')}}">Car List</a></li>
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
                  <h3 class="card-title">Create Car</h3>
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
              <form role="form" id="quickForm" method="POST" action="{{URL::to('/car')}}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <select class="form-control custom-select" placeholder="Select Sub Category" name="subcategory">
                            <option selected="" disabled="">Select Sub Category</option>
                            @foreach ($subcategory as $item)
                                <option value="{{$item->id}}">{{$item->subcategory_name}}  ({{App\Category::where('id',$item->category_id)->first()->category_name}})</option>
                            @endforeach
                        </select>
                        @if ($errors->has('subcategory'))
                            <label id="subcategory-error" class="error text-danger" for="subcategory">{{ $errors->first('subcategory') }}</label>
                        @endif
                    </div>

                    <div class="form-group">
                        <select class="form-control custom-select" data-placeholder="Select Brand" name="brand">
                        <option selected="" disabled="">Select Brand</option>
                            @foreach ($brand as $item)
                                <option value="{{$item->id}}">{{$item->brand_name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('brand'))
                            <label id="brand-error" class="error text-danger" for="brand">{{ $errors->first('brand') }}</label>
                        @endif
                    </div>

                    <div class="form-group">
                        <select class="form-control custom-select" data-placeholder="Select Year" name="year">
                            <option selected="" disabled="">Select Year</option>
                            @foreach ($year as $item)
                                <option value="{{$item->id}}">{{$item->year}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('year'))
                            <label id="year-error" class="error text-danger" for="year">{{ $errors->first('year') }}</label>
                        @endif
                    </div> 

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Car Name" name="car_name" required="" >
                        @if ($errors->has('car_name'))
                            <label id="car_name-error" class="error" for="car_name">{{ $errors->first('car_name') }}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Car Model" name="car_model" >
                        @if ($errors->has('car_model'))
                            <label id="car_model-error" class="error" for="car_model">{{ $errors->first('car_model') }}</label>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="file" class="dropify" name="image" required="">
                        @if ($errors->has('image'))
                        <label id="image-error" class="error text-danger" for="image">{{ $errors->first('image') }}</label>
                        @endif
                    </div>


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
