@extends('layouts.app4')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Provider List</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item btn btn-warning"><a href="{{ url('/provider/create')}}">Add Provider</a></li>
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
                <h3 class="card-title">Provider List</h3>
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
                        <th> ID</th>
                        <th> Name</th>
                        <th> Phone</th>
                        <th> Address</th>
                        <th> Email</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th> ID</th>
                        <th> Name</th>
                        <th> Phone</th>
                        <th> Address</th>
                        <th> Email</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($provider as $item)
                        <tr>
                            <td>{{$item->id}}</td>
                            <td>{{$item->provider_name}}</td>
                            <td>{{$item->provider_phone}}</td>
                            <td>{{$item->provider_address}}</td>
                            <td>{{$item->provider_email}}</td>
                            <td>
                                <img src="{{asset($item->provider_image)}}" alt="{{asset($item->provider_image)}}"  style="border-radius: 10%;" width="100" height="100">
                            </td>
                            <td>
                                <a href="{{URL::to('provider/status/'.$item->id)}}" class="btn btn-raised {{($item->provider_status == 1)? 'btn-danger' : 'btn-warning'}} waves-effect">{{($item->provider_status == 1)? "Deactive" : "Active"}}</a>
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
                                    <form id="car-form" action="{{ URL::to('provider/'.$item->id) }}" Method="post" style="display: none;">
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
                                            <form id="form_validation" method="POST" action="{{URL::to('provider/'.$item->id)}}" enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="form-group form-float mt-4">
                                                    <input type="text" class="form-control" placeholder="Enter Rider Name" name="provider_name" required="" value="{{$item->provider_name}}" >
                                                </div>
                                                <div class="form-group form-float mt-4">
                                                    <input type="number" class="form-control" placeholder="Enter Rider Phone" name="provider_phone" value="{{$item->provider_phone}}" >
                                                </div>
                                                <div class="form-group form-float mt-4">
                                                    <input type="text" class="form-control" placeholder="Enter Rider Address" name="provider_address" required="" value="{{$item->provider_address}}">
                                                </div>
                                                <div class="form-group form-float mt-4">
                                                    <input type="text" class="form-control" placeholder="Enter Rider Email" name="provider_email" value="{{$item->provider_email}}">
                                                </div>
                                                <div class="form-group form-float mt-4">
                                                    <input type="password" class="form-control" placeholder="******" name="provider_password" >
                                                </div>
                                                <div>
                                                    <input type="file" name="provider_image">
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
