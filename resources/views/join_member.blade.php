

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>HelthX Your gateway to better tomorrow</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="HelthX Join Member" name="description" />
        <meta content="MyraStudio" name="author" />
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
                                            <strong>Err!!</strong> {{session('succ')}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        @endif
                                        <div class="card-body">
                                            
                                            <div class="text-center mb-4 mt-3">
                                                <a href="{{url('')}}">
                                                    <span><img src="{{asset('public/assets/images/healthx logo.png')}}" alt="" height="60"></span>
                                                </a>
                                            </div>
                                             @php 
                                             
                                           $decrypted=$encrypted;

                                            @endphp

                                            @if($count>0)
                                            <form  class="p-2" action="{{url('join_profile')}}" method="post">
                                                @csrf
                                                <div class="form-group">
                                                    <label>PAN Card No <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="PAN Card No" class="form-control" name="pan" id="pan"  onblur="pan_check()" style="text-transform: uppercase" autocomplete="off" required><span class="text-danger" id="alert_pan"></span>
                                                </div>
                                                <div class="form-group">
                                                     <label>Full Name <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Full Name" class="form-control " name="f_name" id="f_name" value=""  autocomplete="off" readonly required>
                                                </div>
                                                <div class="form-group">
                                                   <label>Mobile No <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Mobile No" class="form-control number" name="mobile" id="mobile" onblur="mobile_check()" required>
                                                </div><span class="text-danger" id="tel"></span> 
                                              
                                                <div class="form-group">
                                                 <label>Mail ID<span class="text-danger">*</span></label>
                                                <input type="email" placeholder="Mail ID" class="form-control " name="email" id="email" autocomplete="off" required>
                                                </div>
                                                <div class="form-group">
                                                 <label>Confirm Mail ID<span class="text-danger">*</span></label>
                                                    <input type="email" onblur="check_confirm_email()" placeholder="Confirm Mail ID" class="form-control " name="c_email" id="c_email" autocomplete="off" required><span class="text-danger" id="alert_email"></span>  
                                                    <input type="hidden" name="token" value="{{$token}}"> 
                                                </div>
                                                
                                                <div class="mb-3 text-center">
                                                    <button id="submit_button" class="btn btn-primary btn-block" type="submit"> Submit </button>
                                                </div>
                                            </form>
                                            @else
                                            <div class="mt-4 pt-3 text-center">
                                                <div class="row justify-content-center">
                                                    <div class="col-6 my-4">
                                                        <img src="{{asset('public/assets/images/500-error.svg')}}" title="invite.svg">
                                                    </div>
                                                </div>
                                                <h3 class="expired-title mb-4 mt-3">Invalid URL</h3>
                                                    <p class="text-muted mb-4 w-75 m-auto">A URL in your data feed is badly formed or contains invalid characters.</p>
                                            </div>
            
                                            <div class="mb-3 mt-4 text-center">
                                                <a href="{{url('')}}" class="btn btn-primary btn-block">Back to Home</a>
                                            </div>
                                            @endif
                                        </div>
                                        <!-- end card-body -->
                                    </div>
                                    <!-- end card -->
            
                                    <div class="row mt-4">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-white-50 mb-0">Already have an account? <a href="{{url('')}}" class="text-white-50 ml-1"><b>Sign In</b></a></p>
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
<script type="text/javascript">
        $('#submit_button').prop('disabled', true);
           function pan_check() {
              if($('#pan').val().length!=10){
                     $('#alert_pan').html('Please enter valid PAN number');
                     $('#pan').focus();
                }else{
                    $('#alert_pan').html('');
                    pan_get_name();
                }
            }
            function check_s_id() {
                //const regex = /^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/;
              if($('#sponsor_id').val().length!=11){
                     $('#sponsor_id_alert').html('Please enter valid Sponsor ID');
                     $('#sponsor_id').focus();
                     $('#submit_button').prop('disabled', true);
                }else{
                    $('#sponsor_id_alert').html('');
                    $('#submit_button').prop('disabled', false);
                }
            }

           function mobile_check() {
            if($('#mobile').val().length!=10){
                 $('#tel').html('Please enter valid phone number');
                 $('#mobile').select();
            }else{
                $('#tel').html('');

            }
         }
          function check_confirm_email() {
            if($('#email').val()!=$('#c_email').val()){
                 $('#alert_email').html('Email and confirm email not matched');
                 $('#c_email').select();
                 $('#submit_button').prop('disabled', true);
            }else{
                $('#alert_email').html('');
                if($('#f_name').val()!=''){
                 $('#submit_button').prop('disabled', false);
                }
            }
         }
       
           </script>
           <script type="text/javascript">
              function pan_get_name(){
                var pan = $( "#pan" ).val();
                    $.ajax({
                         type: "GET",
                         enctype: 'multipart/form-data',
                         url: '{{url('valid_pan')}}',
                         data: {pan:pan},
                         dataType: 'json',
                         success: function (res) {
                             document.getElementById('f_name').value=res.name;
                             if(res.name!=''){
                                $('#submit_button').prop('disabled', false);
                            }else{
                                $('#submit_button').prop('disabled', true);
                            }
                             
                         },
                         error: function (e) {
                             console.log("ERROR : ", e);
                             console.log(e.responseText);
                             $('#submit_button').prop('disabled', true);
                         }
                     });
                 }
       </script>
</body>

</html>