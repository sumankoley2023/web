<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Healthx Your gateway to better tomorrow</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="automax" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('public/assets/images/fab.png')}}">
    
        <!-- App css -->
        <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('public/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
    
    </head>

<body class="bg-primary">
 
    <div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex align-items-center min-vh-100">
                        <div class="w-100 d-block my-5">

                            <div class="row justify-content-center">
                                <div class="col-md-8 col-lg-5">
                                    <div class="card">
                                        @if(session('err')!='')
                                        <div class="alert alert-danger  alert-dismissible fade show mb-0" role="alert">
                                            <strong>Err!!</strong> {{session('err')}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        @if(session('succ')!='')
                                        <div class="alert alert-success  alert-dismissible fade show mb-0" role="alert">
                                            <strong>Success!!</strong> {{session('succ')}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        <div class="card-body">
                                            <div class="text-center mb-4 mt-3">
                                                <a href="{{url('index')}}">
                                                    <span><img src="{{asset('public/assets/images/healthx logo.png')}}" alt="" height="74"></span>
                                                </a>
                                            </div>
                                            <form  class="p-2" action="{{url('valid_check')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="id_name">User Name</label>
                                                    <input autocomplete="off" class="form-control" type="text" id="id_name" required="" placeholder="Enter User Name" name="mobile" >
                                                </div>
                                                <div class="form-group">
                                                    <a href="" class="text-muted float-right">Forgot your password?</a>
                                                    <label for="password">Password</label>
                                                    <input class="form-control" type="password" required="" id="password" placeholder="Enter your password" name="password" autocomplete="off">
                                                </div>
            
                                                <div class="form-group mb-4 pb-3">
                                                    <div class="custom-control custom-checkbox checkbox-primary">
                                                        <input type="checkbox" class="custom-control-input" id="checkbox-signin">
                                                        <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                                    </div>
                                                </div>
                                                <div class="mb-3 text-center">
                                                    <button class="btn btn-primary btn-block" type="submit"> Sign In </button>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->
            
                                    <div class="row mt-4">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-white-50 mb-0">Create an account? <a href="pages-register.html" class="text-white-50 ml-1"><b>Sign Up</b></a></p>
                                        </div>
                                    </div>
            
                                </div>
                                <!-- end col -->
                            </div>
                            <!-- end row -->
                        </div> <!-- end .w-100 -->
                    </div> <!-- end .d-flex -->
                </div> <!-- end col-->
            </div> <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <!-- jQuery  -->
    <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/assets/js/metismenu.min.js')}}"></script>
    <script src="{{asset('public/assets/js/waves.js')}}"></script>
    <script src="{{asset('public/assets/js/simplebar.min.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('public/assets/js/theme.js')}}"></script>

</body>

</html>