

@extends('layouts.app4')

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                <h1>Employee Add</h1>
                </div>
                <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item btn btn-warning"><a href="{{ url('/employee')}}">Employee List</a></li>
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
                  <h3 class="card-title">Create Employee</h3>
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
                <form role="form" id="quickForm" method="POST" action="{{URL::to('/employee')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                    
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mt-2 mb-2"> <b> Employee INFO: </b></h4>
                        </div>
                        <div class="col-md-6">                                    
                            <div class="col-md-12">
                                <select class="form-control show-tick ms select2" data-placeholder="Select Employee Role" name="role">
                                    <option></option>
                                    @foreach (App\EmployeeRole::all() as $item)
                                        <option value="{{$item->id}}">{{$item->role}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('role'))
                                    <label id="role-error" class="error text-danger" for="role">{{ $errors->first('role') }}</label>
                                @endif
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float mt-3">
                                    <input type="text" class="form-control" placeholder="Enter Employee Name" name="name" required="" autofocus>
                                    @if ($errors->has('name'))
                                        <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <input type="number" class="form-control" placeholder="Enter Phone #" name="phone" required="" autofocus>
                                    @if ($errors->has('phone'))
                                        <label id="phone-error" class="error" for="phone">{{ $errors->first('phone') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Enter Email" name="email" required="" autofocus>
                                    @if ($errors->has('email'))
                                        <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group form-float">
                                    <input type="text" class="form-control" placeholder="Enter Password" name="password" required="" autofocus>
                                    @if ($errors->has('password'))
                                        <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="col-md-12">
                                <input type="file" class="dropify" accept="image/*" name="image">
                                @if ($errors->has('image'))
                                    <label id="image-error" class="error text-danger" for="image">{{ $errors->first('image') }}</label>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <h4 class="mt-2 mb-2"> <b> Rights: </b></h4>
                        </div>
                        <div class="col-md-4">
                            
                            <div class="checkbox">
                                <input id="employee" type="checkbox" name="right[]" value="employee" checked>
                                <label for="employee">employee</label>
                            </div>
                        </div>
                     
                        
                        </div>
                        <br>
                        <div class="col-md-12">
                            <button class="btn btn-raised btn-primary waves-effect" type="submit"> Add Employee </button>
                        </div>
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
