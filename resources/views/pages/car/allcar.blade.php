@extends('layouts.app4')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Car List</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item btn btn-warning"><a href="{{ url('/car/create')}}">Add Car</a></li>
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
                <h3 class="card-title">Car</h3>
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
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Brand Name</th>
                        <th>Year</th>
                        <th>Model</th>
                        <th>Car Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Brand Name</th>
                        <th>Year</th>
                        <th>Model</th>
                        <th>Car Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($car as $item)
                        <tr>
                            <td>{{$item->category_name}}</td>
                            <td>{{$item->subcategory_name}}</td>
                            <td>{{$item->brand_name}}</td>
                            <td>{{$item->year}}</td>
                            <td>{{$item->car_modal}}</td>
                            <td>{{$item->car_name}}</td>
                            <td>
                                <img src="{{asset($item->car_image)}}" alt="{{asset($item->car_image)}}"  style="border-radius: 10%;" width="100" height="100">
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
                                    <form id="car-form" action="{{ URL::to('car/'.$item->id) }}" Method="post" style="display: none;">
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
                                            <form id="form_validation" method="POST" action="{{URL::to('car/'.$item->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <select class="form-control show-tick ms select2" data-placeholder="Select Sub Category" name="subcategory">
                                                    <option></option>
                                                    @foreach ($subcategory as $subcategory)
                                                        <option value="{{$subcategory->id}}" {{($subcategory->id == $item->subcategory_id)? 'Selected' : '' }} >{{$subcategory->subcategory_name}}</option>
                                                    @endforeach
                                                </select>
                                                <select class="form-control show-tick ms select2 mt-4" data-placeholder="Select Brand" name="brand">
                                                    <option></option>
                                                    @foreach ($brand as $brand)
                                                        <option value="{{$brand->id}}" {{($brand->id == $item->brand_id)? 'Selected' : ''}} >{{$brand->brand_name}}</option>
                                                    @endforeach
                                                </select>
                                                <select class="form-control show-tick ms select2 mt-4" data-placeholder="Select Year" name="year">
                                                    <option></option>
                                                    @foreach ($year as $year)
                                                        <option value="{{$year->id}}" {{($year->id == $item->year_id)? 'Selected' : ''}}>{{$year->year}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-group form-float mt-4">
                                                    <input type="text" class="form-control" placeholder="Car Name" name="car_name" value="{{$item->car_name}}">
                                                </div>
                                                <div class="form-group form-float mt-4">
                                                    <input type="text" class="form-control" placeholder="Car Model" name="car_model" value="{{$item->car_modal}}" >
                                                </div>
                                                <div>
                                                    <input type="file" name="image">
                                                </div>
                                                <br>
                                                <button class="btn btn-raised btn-warning waves-effect" type="submit">Update</button>
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
