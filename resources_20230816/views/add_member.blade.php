 @include('include.header')

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Add Member</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Add Member</li>
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
                                    <form action="{{url('create_profile')}}" method="post" enctype= "multipart/form-data">
                                        @csrf
                                        @php 
                                        $id=session('members_id');
                                        $display_name=session('display_name');
                                        $sp_id=substr($id+10000,1);
                                        @endphp
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>PAN Card No <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="PAN Card No" class="form-control" name="pan" id="pan"  onblur="pan_check()" style="text-transform: uppercase" autocomplete="off" required><span class="text-danger" id="alert_pan"></span>
                                                </div>
                                                <div class="form-group">
                                                    <label>Full Name <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Full Name" class="form-control " name="f_name" id="f_name"   autocomplete="off" readonly required>
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
                                                </div>
                                                <!-- <div class="form-group">
                                                    <label>Sponsor ID<span class="text-danger">*</span></label>
                                                    <input type="text" onblur="check_s_id()" placeholder="Sponsor ID" class="form-control " name="sponsor_id" id="sponsor_id" readonly value="HX{{$sp_id}}" required>
                                                </div><span class="text-danger" id="sponsor_id_alert"></span> -->
                                                
                                                
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