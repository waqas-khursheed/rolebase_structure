<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/home')}}" class="brand-link">
      <img src="{{asset('images/icon.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">WAQAS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{Auth::user()->image == '' ? asset('images/admin/admin.jpg') : Auth::user()->image }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
                {{--
                <!-- <li class="nav-item has-treeview menu-open">
                    <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                        <i class="right fas fa-angle-left"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="./index.html" class="nav-link active">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v1</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index2.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v2</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="./index3.html" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Dashboard v3</p>
                        </a>
                    </li>
                    </ul>
                </li>-->--}} 

                <li class="nav-item">
                    <a href="{{ url('/home')}}" class="nav-link">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                    </a>
                </li>

                
                @if (in_array('employee', explode(',',Auth::user()->right)))

                  <!-- Employee-->
                  
                  <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Employees
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{URL::to('/employee/create')}} " class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Employee</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/employee')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manage Employee</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/managerole')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Manage Admin Roles</p>
                        </a>
                    </li>
                    </ul>
                </li>
                @endif


                 <!-- Employee-->
                  
                 <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fa fa-car"></i>
                    <p>
                        Cars
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>
                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{URL::to('/category')}} " class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/subcategory')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sub Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/year')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Year</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/brand')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Brand</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/car/create')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Add Car</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/car')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p> Car List</p>
                        </a>
                    </li>
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-hospital-user"></i>
                    <p>
                        Providers
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>

                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{URL::to('/provider/create')}} " class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Provider</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/provider')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Provider List</p>
                        </a>
                    </li>
                    
                    </ul>
                </li>

                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                    <i class="nav-icon fab fa-product-hunt"></i>
                    <p>
                        Products
                        <i class="fas fa-angle-left right"></i>
                    </p>
                    </a>

                    <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{URL::to('/oilbrand')}} " class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Oil Brand</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/productcategory')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Product Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/product/create')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Add Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/product')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Product List</p>
                        </a>
                    </li>
                    
                    </ul>
                </li>
            </ul>

            <!-- @if (in_array('employees', explode(',',Auth::user()->right)))
            <li> <a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-account-add"></i><span>Employees</span></a>
                <ul class="ml-menu">
                    <li><a href="{{URL::to('/employee/create')}}">Add Employee</a></li>
                    <li><a href="{{URL::to('/employee')}}">Manage Employee</a></li>
                    <li><a href="{{URL::to('/managerole')}}">Manage Admin Roles</a></li>
                </ul>
            </li>
            @endif -->
        </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
