@extends('layouts.app')

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Employee List</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item btn btn-warning"><a href="{{ url('/employee/create')}}">Add Employee</a></li>
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
                <h3 class="card-title">Employee</h3>
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
                    <th>Employee Name</th>
                    <th>Employee Role</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($employee as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{ App\EmployeeRole::where('id',$item->employeerole_id)->first()->role }}</td>
                                <td>{{$item->email}}</td>
                                <td><img src="{{$item->image}}" alt="{{$item->image}}" width="150"></td>
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
                                        <form id="car-form" action="{{ URL::to('employee/'.$item->id) }}" Method="post" style="display: none;">
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
                                        </div>
                                        <div class="modal-body"> 
                                            <div class="container">
                                                <form action="{{ URL::to('employee/'.$item->id) }}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <select class="form-control show-tick ms select2" data-placeholder="Select Employee Role" name="role">
                                                                <option></option>
                                                                @foreach (App\EmployeeRole::all() as $role)
                                                                    <option value="{{$role->id}}" {{($item->employeerole_id == $role->id )? 'Selected' : '' }}>{{$role->role}}</option>
                                                                @endforeach
                                                        </select>
                                                        <div class="col-md-12">
                                                            <h4 class="mt-2 mb-2"> <b> Rights: </b></h4>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="checkbox">
                                                                <input id="users{{$item->id}}" type="checkbox" name="right[]" value="users" {{(in_array('users', explode(',',$item->right)))? 'checked' : ''}} >
                                                                <label for="users{{$item->id}}">users</label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <input id="category{{$item->id}}" type="checkbox" name="right[]" value="category" {{(in_array('category', explode(',',$item->right)))? 'checked' : ''}}>
                                                                <label for="category{{$item->id}}">category</label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <input id="promotion{{$item->id}}" type="checkbox" name="right[]" value="promotion" {{(in_array('promotion', explode(',',$item->right)))? 'checked' : ''}}>
                                                                <label for="promotion{{$item->id}}">Promotion</label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <input id="product{{$item->id}}" type="checkbox" name="right[]" value="product" {{(in_array('product', explode(',',$item->right)))? 'checked' : ''}}>
                                                                <label for="product{{$item->id}}">Product</label>
                                                            </div>
                                                            <div class="checkbox">
                                                                <input id="employee{{$item->id}}" type="checkbox" name="right[]" value="employee" {{(in_array('employee', explode(',',$item->right)))? 'checked' : ''}}>
                                                                <label for="employee{{$item->id}}">Employee</label>
                                                            </div>
                                                        </div>
                                                       
                                                    </div>
                                                    <button type="submit" class="btn btn-warning waves-effect btn-round">Update</button>
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
                    <th>Employee Name</th>
                    <th>Employee Role</th>
                    <th>Email</th>
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