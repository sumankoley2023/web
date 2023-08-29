 @include('include.header')

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">My Profile</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">My Profile</li>
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
                                    <form action="{{url('change_profile')}}" method="post" enctype= "multipart/form-data">
                                        @csrf
                                        @foreach($member_data as $data)
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>PAN Card No <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="PAN Card No" class="form-control" name="pan" id="pan"  onblur="pan_check()" autocomplete="off" value="{{ucwords($data->pan_no)}}" readonly required><span class="text-danger" id="alert_pan"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Full Name <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Full Name" class="form-control " name="f_name" id="f_name" value="{{ucwords($data->display_name)}}"  autocomplete="off" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mobile No <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Mobile No" class="form-control number" name="mobile" id="mobile" onblur="mobile_check()" value="{{$data->phone}}" required>
                                                </div><span class="text-danger" id="tel"></span>

                                                <div class="form-group">
                                                    <label>Mail ID<span class="text-danger">*</span></label>
                                                    <input type="email" placeholder="Mail ID" class="form-control " name="email" id="email" value="{{$data->email}}" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>State<span class="text-danger">*</span></label>
                                                    <input type="text" value="{{$data->state}}" placeholder="" class="form-control " name="" id="" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Dist<span class="text-danger">*</span></label>
                                                    <input type="text" value="{{$data->dist}}" placeholder="" class="form-control " name="" id="" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label>PIN<span class="text-danger">*</span></label>
                                                    <input type="text" value="{{$data->pin}}" placeholder="" class="form-control " name="" id="" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Doc ID<span class="text-danger">*</span></label>
                                                    <input type="text"  value="{{$data->gov_id_no}}" placeholder="" class="form-control " name="" id="" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label>IFSC Code<span class="text-danger">*</span></label>
                                                    <input type="text"  value="{{$data->ifsc_code}}" placeholder="" class="form-control " name="" id="" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Bank Name<span class="text-danger">*</span></label>
                                                    <input type="text" value="{{$data->bank_name}}" placeholder="" class="form-control " name="" id="" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Branch<span class="text-danger">*</span></label>
                                                    <input type="text" value="{{$data->branch}}" placeholder="" class="form-control " name="" id="" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label>A/C Number<span class="text-danger">*</span></label>
                                                    <input type="text" value="{{$data->acc_no}}" placeholder="" class="form-control " name="" id="" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Bank Holder Name<span class="text-danger">*</span></label>
                                                    <input type="text"  value="{{$data->bank_holder_name}}" placeholder="" class="form-control " name="" id="" readonly required>
                                                </div>
                                                <div class="form-group">
                                                    <label><span class="text-danger">Profile Pic*</span></label>
                                                    <img src="{{url('storage/app/'.$data->upload_profile_pic_name)}}" alt="Profile" width="150" height="150">
                                                </div>
                                                
                                                
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto">
                                                        <button type="submit" id="submit_button" class="btn btn-primary mb-2 waves-effect waves-light">Update</button>
                                                        <a href="{{url('change_password')}}"><button type="button"  class="btn btn-success mb-2 waves-effect waves-light">Change Password</button></a>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            
                                            
                                        </div>
                                        @endforeach
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
        //$('#submit_button').prop('disabled', true);
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
                         url: 'valid_pan',
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
                         }
                     });
                 }
       </script>