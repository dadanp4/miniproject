<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>MiniProject - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">


    {{-- Vue js --}}
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>

</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            {{-- <hr class="sidebar-divider"> --}}

            <!-- Heading -->
            {{-- <div class="sidebar-heading">
                Interface
            </div> --}}

            <!-- Nav Item - Pages Collapse Menu -->

            <!-- Nav Item - Utilities Collapse Menu -->

            <!-- Divider -->
            {{-- <hr class="sidebar-divider"> --}}

            <!-- Heading -->

            <!-- Nav Item - Pages Collapse Menu -->

            <!-- Nav Item - Charts -->

            <!-- Nav Item - Tables -->

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->

                        <!-- Nav Item - Alerts -->


                        <!-- Nav Item - Messages -->


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ $username }} </span>
                                <img class="img-profile rounded-circle"
                                    src="/img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                {{-- <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div id="appCrudProject" class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Project</h1>
                    </div>

                    <!-- Content Row -->

                    <div class="row">
                        <div class="col-sm-4"></div>
                        <div class="col-sm-4">
                            @if (session('message_search'))
                                <div class="alert alert-danger text-center">
                                    {{ session('message_search') }}
                                </div>
                            @endif

                            @if (session('message_save_success'))
                            <div class="alert alert-success text-center">
                                {{ session('message_save_success') }}
                            </div>
                            @endif

                            @if (session('message_save_fail'))
                            <div class="alert alert-danger text-center">
                                {{ session('message_save_fail') }}
                            </div>
                            @endif
                        </div>
                        <div class="col-sm-4"></div>
                    </div>


                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->

                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="row row-cols-2">
                                        <div class="col-2 text-center">
                                            Filter
                                        </div>
                                        <div class="col-10">
                                            <form action="/api/auth/search" method="GET">
                                            <div class="row row-cols-5">
                                                <div class="col">Project Name</div>
                                                <div class="col">Client</div>
                                                <div class="col">Status</div>
                                                <div class="col"></div>
                                                <div class="col"></div>
                                                <div class="col">
                                                    <input name="project_name_search" class="form-control" type="text" placeholder="..." required>
                                                </div>
                                                <div class="col">
                                                    <select name="client_opsi" class="form-control" required>
                                                        @foreach ($dataclient as $item)
                                                        <option value="{{$item->client_name}}">{{$item->client_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <select name="status_opsi" class="form-control" required>
                                                        <option value="OPEN">OPEN</option>
                                                        <option value="DOING">DOING</option>
                                                        <option value="DONE">DONE</option>
                                                    </select>
                                                </div>
                                                <div class="col-1">
                                                    <button type="submit" class="btn btn-primary">Search</button>
                                                </div>
                                                <div class="col-3">
                                                    <button type="button" @click="toggleclear" class="btn btn-secondary">Clear</button>
                                                </div>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                    {{-- button aksi --}}

                    <div class="d-sm-flex mb-4">
                        <Transition name="slide-up">
                            <button v-if="tabeltrue" @click="toggle" type="button" class="btn btn-success btn-tbl-slide" style="width: 10%">New</button>
                            <button v-if="!tabeltrue" @click="toggle" type="button" class="btn btn-secondary btn-tbl-slide" style="width: 10%">Close</button>
                        </Transition>
                        <button v-if="itemdelete == ''" disabled type="button" class="btn btn-danger" style="width: 10%; margin-left: 150px" data-toggle="modal" data-target="#ModalDelete">Delete</button>
                        <button v-else type="button" class="btn btn-danger" style="width: 10%; margin-left: 150px" data-toggle="modal" data-target="#ModalDelete">Delete</button>
                    </div>

                    <!-- The Modal -->
                    <div class="modal fade" id="ModalDelete">
                        <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">

                            <h4 class="modal-title">Ready to delete?</h4>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                Select "YES" below if you are ready to delete the data
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                            <form action="/api/auth/delete" method="GET">
                                <input type="hidden" name="id_delete" v-model="itemdelete">
                                <button type="submit" class="btn btn-danger">Yes</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                            </div>

                            </div>
                        </div>
                    </div>


                    <!-- Content Row -->
                    <Transition duration="550" name="nested">
                    <div v-if="tabeltrue == true && tabeltrueChange == true" class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->

                                <!-- Card Body -->
                                <div class="card-body">
                                    <table class="table" id="dataTable">
                                        <thead class="thead-light">
                                          <tr>
                                            <th scope="col">
                                                <input type="checkbox" aria-label="Checkbox for following text input" disabled>
                                            </th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Project Name</th>
                                            <th scope="col">Client</th>
                                            <th scope="col">Project Start</th>
                                            <th scope="col">Project End</th>
                                            <th scope="col">Status</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($dataproduct as $item)
                                            <tr>
                                                <th scope="row">
                                                    <input type="checkbox" value="{{ $item['project_id'] }}" v-model="itemdelete" aria-label="Checkbox for following text input">
                                                </th>
                                                <td>
                                                    <a href="/api/auth/change/{{ $item['project_id'] }}" style='background: none; border: none;'><i class='fas fa-edit'></i></a>
                                                </td>
                                                <td>
                                                    <input type="text" ref="nameproject" value="{{ $item['project_name'] }}" hidden>
                                                    {{ $item['project_name'] }}
                                                </td>
                                                <td>
                                                    <input type="text" ref="nameclient" value="{{ $item['client_name'] }}" hidden>
                                                    {{ $item['client_name'] }}
                                                </td>
                                                <td>{{ $item['project_start'] }}</td>
                                                <td>{{ $item['project_end'] }}</td>
                                                <td>{{ $item['project_status'] }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                      </table>
                                      {{-- <div class="row row-cols-2">
                                        <div class="col" >Page</div>
                                        <div class="col">{!! $dataproduct->links() !!}</div>
                                      </div> --}}
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Content Row -->

                    <div v-if="!tabeltrue" class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->

                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="/api/auth/save" method="GET">
                                        @csrf
                                    <div class="row row-cols-3">
                                        <div class="col">
                                            Project Name
                                            <input name="project_name" class="form-control" type="text" placeholder="..." required>
                                        </div>
                                        <div class="col">
                                            Client
                                            <select name="client_opsi" class="form-control" required>
                                                @foreach ($dataclient as $item)
                                                <option value="{{$item->client_name}}">{{$item->client_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            Status
                                            <select name="status_opsi" class="form-control" required>
                                                <option value="OPEN">OPEN</option>
                                                <option value="DOING">DOING</option>
                                                <option value="DONE">DONE</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            Project Start
                                            <input name="project_start" class="form-control" type="date" placeholder="..." required>
                                        </div>
                                        <div class="col">
                                            Project End
                                            <input name="project_end" class="form-control" type="date" placeholder="..." required>
                                        </div>
                                        <div class="col">
                                            {{-- <button type="submit" class="btn btn-success">Save</button> --}}
                                        </div>
                                        <div class="col">
                                            {{-- <button type="submit" class="btn btn-success">Save</button> --}}
                                        </div>
                                        <div class="col">
                                            {{-- <button type="submit" class="btn btn-success">Save</button> --}}
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-success" style="width: 100%">Save</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                            </div>
                        </div>

                    <!-- Content Row -->

                    <div v-if="!tabeltrueChange" class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->

                                <!-- Card Body -->
                                <div class="card-body">
                                    <form action="/api/auth/change" method="GET">
                                        @csrf
                                    <div class="row row-cols-3">
                                        <div class="col">
                                            Project Name
                                            <input name="project_name" v-model="change_project_name" class="form-control" type="text" placeholder="..." required>
                                        </div>
                                        <div class="col">
                                            Client
                                            <select name="client_opsi" v-model="change_project_client" class="form-control" required>
                                                @foreach ($dataclient as $item)
                                                <option value="{{$item->client_name}}">{{$item->client_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col">
                                            Status
                                            <select name="status_opsi" class="form-control" required>
                                                <option value="OPEN">OPEN</option>
                                                <option value="DOING">DOING</option>
                                                <option value="DONE">DONE</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            Project Start
                                            <input name="project_start" class="form-control" type="date" placeholder="..." required>
                                        </div>
                                        <div class="col">
                                            Project End
                                            <input name="project_end" class="form-control" type="date" placeholder="..." required>
                                        </div>
                                        <div class="col">
                                            {{-- <button type="submit" class="btn btn-success">Save</button> --}}
                                        </div>
                                        <div class="col">
                                            {{-- <button type="submit" class="btn btn-success">Save</button> --}}
                                        </div>
                                        <div class="col">
                                            {{-- <button type="submit" class="btn btn-success">Save</button> --}}
                                        </div>
                                        <div class="col">
                                            <button type="submit" class="btn btn-warning" style="width: 100%">Change</button>
                                        </div>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    </Transition>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <form action="/api/auth/logout" method="POST">
                        @csrf
                        <input type="text" name="token" value="{{ $token_session }}" hidden>
                        <button class="btn btn-primary">Logout</button>
                    </form>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="/js/demo/chart-area-demo.js"></script>
    <script src="/js/demo/chart-pie-demo.js"></script>

    <!-- Page level plugins -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script src="/js/demo/datatables-demo.js"></script>


</body>

<script>
    const { createApp } = Vue

    createApp({
        data() {
            return {
                 v_data: 'hello',
                 itemdelete:[],
                 tabeltrue: true,
                 tabeltrueChange: true,
            }
        },
        methods: {
            toggle(){
                this.tabeltrue = !this.tabeltrue
            },
            toggleclear(){
                location.replace("/api/auth/index");
            }
        }
    }).mount('#appCrudProject')
</script>
<style>
    .outer, .inner {
        background: #eee;
      padding: 30px;
      min-height: 100px;
    }

    .inner {
      background: #ccc;
    }

    .nested-enter-active, .nested-leave-active {
        transition: all 0.3s ease-in-out;
    }
    /* delay leave of parent element */
    .nested-leave-active {
      transition-delay: 0.25s;
    }

    .nested-enter-from,
    .nested-leave-to {
      transform: translateY(30px);
      opacity: 0;
    }

    /* we can also transition nested elements using nested selectors */
    .nested-enter-active .inner,
    .nested-leave-active .inner {
      transition: all 0.3s ease-in-out;
    }
    /* delay enter of nested element */
    .nested-enter-active .inner {
        transition-delay: 0.25s;
    }

    .nested-enter-from .inner,
    .nested-leave-to .inner {
      transform: translateX(30px);
      /*
          Hack around a Chrome 96 bug in handling nested opacity transitions.
        This is not needed in other browsers or Chrome 99+ where the bug
        has been fixed.
      */
      opacity: 0.001;
    }


    .btn-tbl-slide{
        position: absolute;
    }

    .slide-up-enter-active,
    .slide-up-leave-active {
    transition: all 0.25s ease-out;
    }

    .slide-up-enter-from {
    opacity: 0;
    transform: translateY(30px);
    }

    .slide-up-leave-to {
    opacity: 0;
    transform: translateY(-30px);
    }

</style>

</html>
