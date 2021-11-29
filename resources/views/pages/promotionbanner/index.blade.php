@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Promotion Banner List</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item btn btn-info"><a href="{{ url('/promotion/banner/create')}}">Add Promotion Banner</a></li>
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
                <h3 class="card-title">Promotion Banner</h3>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-error">
                            {{ Session::get('error') }}
                            @php
                                Session::forget('error');
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
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($promotionBanner as $item)
                        <tr>
                            <td>{{ $item->id }} </td>
                            <td>{{ $item->name }} </td>
                            <td>
                               <img src="{{asset($item->image)}}" alt="{{asset($item->image)}}"  style="border-radius: 50%;" width="100" height="100">



                            </td>
                            <td>
                                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#defaultModal{{$item->id}}">Edit</a>
                                <a data-toggle="modal" data-target="#delete{{$item->id}}" class="btn btn-danger">Delete</a>


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
                                <form id="car-form" action="{{ URL::to('promotion/banner/'.$item->id) }}" Method="post" style="display: none;">
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
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>

                                    </div>
                                    <div class="modal-body">
                                        <div class="container">
                                            <form id="form_validation" method="POST" action="{{URL::to('promotion/banner/'.$item->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="name" name="name" class="form-control" id="name" placeholder="Enter User Name" value="{{$item->name}}" required>
                                                    @if ($errors->has('name'))
                                                        <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputFile">File input</label>
                                                    <div class="input-group">
                                                      <div class="custom-file">
                                                        <input type="file" accept="image/*" class="custom-file-input" name="image" value="{{ $item->image}}" id="exampleInputFile">
                                                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                                      </div>
                                                      <div class="input-group-append">
                                                        <span class="input-group-text" id="">Upload</span>
                                                      </div>
                                                    </div>
                                                  </div>
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                     @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
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
