@extends('layouts.app4')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h2>Sub Category</h2>
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
                  <h3 class="card-title">Sub Category</h3>
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
                <form role="form" id="quickForm" method="POST" action="{{URL::to('subcategory')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <select class="form-control show-tick ms select2" data-placeholder="Select Category" name="category">
                                <option>Select Category</option>
                                @foreach ($category as $item)
                                    <option value="{{$item->id}}">{{$item->category_name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category'))
                                <label id="category-error" class="error text-danger" for="category">{{ $errors->first('category') }}</label>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Sub Category Name" name="subcategory_name" required="" >
                            @if ($errors->has('subcategory_name'))
                                <label id="subcategory_name-error" class="error" for="subcategory_name">{{ $errors->first('subcategory_name') }}</label>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="file" class="dropify" name="image" required="">
                            @if ($errors->has('image'))
                            <label id="image-error" class="error text-danger" for="image">{{ $errors->first('image') }}</label>
                            @endif
                        </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add Sub Category</button>
                    </div>
                </form>

                <!-- /.card-header -->
                <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Category Name</th>
                        <th>Sub Category Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($subcategory as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{App\Category::where('id', $item->category_id)->first()->category_name}}</td>
                            <td>{{$item->subcategory_name}}</td>
                            <td>
                                <img src="{{asset($item->subcategory_image)}}" alt="{{asset($item->subcategory_image)}}"  style="border-radius: 10%;" width="100" height="100">
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
                                    <form id="car-form" action="{{ URL::to('subcategory/'.$item->id) }}" Method="post" style="display: none;">
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
                                            <form id="form_validation" method="POST" action="{{URL::to('subcategory/'.$item->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <select class="form-control show-tick ms select2" name="category">
                                                    <option></option>
                                                    @foreach ($category as $category)
                                                        <option value="{{$category->id}}" {{($category->id == $item->category_id)? 'Selected' : '' }} >{{$category->category_name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="form-group form-float mt-4">
                                                    <input type="text" class="form-control" placeholder="Sub Category Name" name="subcategory_name" required="" value=" {{$item->subcategory_name}} ">
                                                </div>
                                                <div>
                                                    <input type="file" name="image">                                                                        
                                                </div>
                                                <br>
                                                <button class="btn btn-raised btn-info waves-effect btn-round" type="submit">update</button>
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
          </div>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">
        
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
      
    </section>
    <!-- /.content -->
  </div>
@endsection
