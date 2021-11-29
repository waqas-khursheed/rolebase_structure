@extends('layouts.app4')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
            <h2>Brand</h2>
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
                  <h3 class="card-title"> Oil Brand</h3>
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
                <form role="form" id="quickForm" method="POST" action="{{URL::to('oilbrand')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Oil Brand Name" name="oilbrand_name" required="" autofocus>
                            @if ($errors->has('oilbrand_name'))
                                <label id="oilbrand_name-error" class="error" for="oilbrand_name">{{ $errors->first('oilbrand_name') }}</label>
                            @endif
                        </div>

                        <div class="form-group">
                            <input type="file" class="dropify" name="image">
                            <label id="image-error" class="error text-danger" for="image"><span class="text-dark">NOTE:</span> Kindly Upload Oil Brand Image Size 300*300 PX</label><br>
                            @if ($errors->has('image'))
                                <label id="image-error" class="error text-danger" for="image">{{ $errors->first('image') }}</label>
                            @endif
                        </div>
                    </div> 
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Add Oil Brand</button>
                    </div>
                </form>

                <!-- /.card-header -->
                <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Brand Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Product Brand Name</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($oilbrand as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->oilbrand_name}}</td>
                            <td>
                                <img src="{{asset($item->oilbrand_image)}}" alt="{{asset($item->oilbrand_image)}}"  style="border-radius: 10%;" width="100" height="100">
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
                                    <form id="car-form" action="{{ URL::to('oilbrand/'.$item->id) }}" Method="post" style="display: none;">
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
                                            <form id="form_validation" method="POST" action="{{URL::to('oilbrand/'.$item->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <input type="text" class="form-control" placeholder="Oil Brand Name" name="oilbrand_name" required="" autofocus value="{{$item->oilbrand_name}}">
                                                </div>
                                                <div class="form-group">
                                                    <input type="file" name="image">
                                                </div>
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
