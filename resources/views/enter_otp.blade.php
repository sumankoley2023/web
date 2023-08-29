 @include('include.header')

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Enter OTP</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Enter OTP</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{url('verify_email_otp_profile')}}" method="post" enctype= "multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                               
                                                 <div class="form-group">
                                                    <label>Enter Email OTP <span class="text-danger">*</span>{{session('email_otp')}}</label>
                                                    <a href="{{url('resend_mobile')}}"><button type="button" id="resend2" class="btn btn-link p-2" > <div class="countdown"></div> Resend</button></a>  <input type="text" placeholder="Enter Email OTP" class="form-control number" name="email_otp" id=""  required>
                                                    
                                                </div> 
                                               
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto">
                                                        <button type="submit" id="submit_button" class="btn btn-primary mb-2 waves-effect waves-light">Submit</button>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            
                                            
                                        </div>
                                    </form>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                  


                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

           @include('include.footer')
       <script type="text/javascript">
  $('#resend2').prop('disabled', true);
  $('#resend1').prop('disabled', true);
 setTimeout(function() {
       $('#resend1').prop('disabled', false);
       $('#resend2').prop('disabled', false);
 }, 61000);

 //timer
  var timer2 = "1:01";
var interval = setInterval(function() {


  var timer = timer2.split(':');
  //by parsing integer, I avoid all extra string processing
  var minutes = parseInt(timer[0], 10);
  var seconds = parseInt(timer[1], 10);
  --seconds;
  minutes = (seconds < 0) ? --minutes : minutes;
  seconds = (seconds < 0) ? 59 : seconds;
  seconds = (seconds < 10) ? '0' + seconds : seconds;
  //minutes = (minutes < 10) ?  minutes : minutes;
  $('.countdown').html(minutes + ':' + seconds);
  if (minutes < 0) clearInterval(interval);
  //check if both minutes and seconds are 0
  if ((seconds <= 0) && (minutes <= 0)) clearInterval(interval);
  timer2 = minutes + ':' + seconds;
}, 1000);
</script>