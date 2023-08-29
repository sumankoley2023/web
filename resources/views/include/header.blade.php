<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Healthx Your gateway to better tomorrow</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="Network" name="description" />
    <meta content="automax" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('public/assets/images/fab.png')}}">

    <!-- Plugins css -->
    <link href="{{asset('public/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/plugins/daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/plugins/switchery/switchery.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/plugins/bootstrap-datepicker/bootstrap-datepicker.min.css')}}" rel="stylesheet" type="text/css" />
    

    <!-- App css -->
    <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/assets/css/theme.min.css')}}" rel="stylesheet" type="text/css" />
    
</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">

                <div class="d-flex align-items-left">
                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <div class="dropdown d-none d-sm-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        </button>

                    </div>
                </div>
                    @if(session('err')!='')
                    <div class="alert alert-danger  alert-dismissible fade show mb-0" role="alert">
                        <strong>Error!!</strong> {{session('err')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if(session('succ')!='')
                    <div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
                        <strong>Success!!</strong> {{session('succ')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                <div class="d-flex align-items-center">

                    <div class="dropdown d-none d-sm-inline-block ml-2">
                        <button type="button" class="btn header-item noti-icon waves-effect"
                            id="page-header-search-dropdown" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <i class="mdi mdi-magnify"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-search-dropdown">

                            <form class="p-3">
                                <div class="form-group m-0">
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Search ..."
                                            aria-label="Recipient's username">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="" src="{{asset('public/assets/images/flags/us.jpg')}}" alt="Header Language" height="16">
                            <span class="d-none d-sm-inline-block ml-1">English</span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <img src="{{asset('public/assets/images/flags/us.jpg')}}" alt="user-image" class="mr-1" height="12">
                                <span class="align-middle">English</span>
                            </a>
                        </div>
                    </div>


                    <div class="dropdown d-inline-block ml-2">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="rounded-circle header-profile-user" src="{{asset('public/assets/images/users/avatar-3.jpg')}}"
                                alt="Header Avatar">
                            <span class="d-none d-sm-inline-block ml-1">{{session('display_name')}}</span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{url('my_profile')}}">
                                <span>Profile</span>
                                <span>
                                    <span class="badge badge-pill badge-warning">1</span>
                                </span>
                            </a>
                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="{{url('logout')}}">
                                <span>Log Out</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <div class="navbar-brand-box">
                    <a href="{{url('dashboard')}}" class="logo">
                        <img src="{{asset('public/assets/images/healthx logo.png')}}" />
                    </a>
                </div>

                <!--- Sidemenu -->
                @if(session('complete_profile')=='yes')
                <div id="sidebar-menu">
                    <!-- Left Menu Start -->
                    <ul class="metismenu list-unstyled" id="side-menu">
                        <li class="menu-title">Menu</li>


                       <!--  <li>
                            <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Master</span></a>
                            <ul class="sub-menu" aria-expanded="false">
                                <li><a href="{{url('package_master')}}">Package Master</a></li>
                             </ul>
                        </li> -->
                        <li>
                            <a href="{{url('dashboard')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Dashboard</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('my_profile')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>My Profile</span></a>
                            
                        </li>
                        
                        <li>
                            <a href="{{url('add_member')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Add Members</span></a>
                            
                        </li>
                          <li>
                            <a href="{{url('refer_member')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Refer Members</span></a>
                            
                        </li>
                         
                        
                        <li>
                            <a href="{{url('update_package')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Update Package</span></a>
                            
                        </li>
                         <li>
                            <a href="{{url('direct_team')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Direct Member</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('total_team')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Total Team Member</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('tree')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Tree</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('direct_income')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Immediate Income</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('binary_income')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Binary Income</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('steady_income')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Steady Income</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('executive_income')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Executive Income</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('power')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Power Side Business</span></a>
                            
                        </li>
                         <li>
                            <a href="{{url('weaker')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Weaker Side Business</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('my_wallet')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>My Wallet</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('rewards')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Rewards</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('withdrawal')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>Withdrawal</span></a>
                            
                        </li>
                        <li>
                            <a href="{{url('emi')}}" class="has-arrow waves-effect"><i
                                    class="bx bxs-eraser"></i><span>EMI</span></a>
                            
                        </li>

                    </ul>
                </div>
                @endif
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
         <div class="main-content">
                           
