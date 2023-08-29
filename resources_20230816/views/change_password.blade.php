 @include('include.header')

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Change Password</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Change Password</li>
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
                                    <form action="{{url('update_change_password')}}" method="post" enctype= "multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                               
                                                <div class="form-group">
                                                    <label>Enter Old Pasword<span class="text-danger">*</span></label>
                                                      <input type="text" placeholder="Enter Old Pasword" class="form-control " name="old" id="" autocomplete="off" required>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label>Enter New Pasword<span class="text-danger">*</span></label>
                                                      <input type="password" placeholder="Enter New Pasword" class="form-control " name="new_password" id="password" onblur="pass_check()" autocomplete="off" required>
                                                    <span class="text-danger" id="pass_alert"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Confirm Pasword<span class="text-danger">*</span></label>
                                                      <input type="text" placeholder="Confirm Pasword" class="form-control " name="confirm_password" id="c_password" autocomplete="off" onblur="cpass_check()" required>
                                                    <span class="text-danger" id="cpass_alert"></span>
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
           function pass_check() {
        //var passw=  /^(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]).{6,}$/;
        var passw=  /^(?=.*\d)(?=.*[a-zA-Z]).{6,}$/;
        var inputtxt=$('#password').val();
        if(inputtxt.match(passw)){
            $('#pass_alert').html('');
        }else{
            
             $('#pass_alert').html('Password containing at least 6 characters, 1 number, 1 letter');
             $('#password').focus();
        }
    } 
    function cpass_check() {
        if($('#password').val()!=$('#c_password').val()){
            $('#cpass_alert').html('Password and confirm password not matched');
            $('#c_password').focus();
        }else{
            $('#cpass_alert').html('');
        }
    } 
       </script>