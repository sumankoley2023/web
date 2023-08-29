 @include('include.header')

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Bank KYC</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Bank KYC</li>
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
                                    <form action="{{url('verify_otp_bank')}}" method="post" enctype= "multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                               
                                                <div class="form-group">
                                                    <label>Enter IFSC<span class="text-danger">*</span></label>
                                                      <input type="text" placeholder="Enter IFSC" class="form-control " name="ifsc" id="ifsc" autocomplete="off"  required><span class="text-danger" id="v_ifsc"></span>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label>Account No<span class="text-danger">*</span></label>
                                                      <input type="text" id="acc_no" placeholder="Account No" class="form-control number" name="acc"  autocomplete="off"  required> <span class="text-danger" id="v_acc"></span>
                                                    <span class="text-danger" id="acc_v"></span>
                                                    
                                                </div>
                                                <div class="form-group myDiv">
                                                    <label>Bank name<span class="text-danger">*</span></label>
                                                      <input type="text" id="bank_name"  class="form-control number" name="bank_name"  autocomplete="off" readonly > 
                                                </div>
                                                <div class="form-group myDiv">
                                                    <label>Branch<span class="text-danger">*</span></label>
                                                      <input type="text" id="branch"  class="form-control number" name="branch"  autocomplete="off"  readonly> 
                                                </div>
                                                <div class="form-group myDiv">
                                                    <label>Bank address<span class="text-danger">*</span></label>
                                                      <input type="text" id="bank_address"  class="form-control number" name="bank_address"  autocomplete="off" readonly > 
                                                </div>
                                                <div class="form-group myDiv">
                                                    <label>Full name<span class="text-danger">*</span></label>
                                                      <input type="text" id="full_name"  class="form-control number" name="full_name"  autocomplete="off" readonly > 
                                                </div>

                                               <div class="form-row align-items-center">
                                                    <div class="col-auto">
                                                        <button onclick="pan_get_name()" type="button" id="verify" class="btn btn-primary mb-2 waves-effect waves-light">Verify Now</button>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="submit" id="submit_button" class="btn btn-success mb-2 waves-effect waves-light">Submit</button>
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
  $('.myDiv').hide();
   function val_check() {
            if($('#ifsc').val()==''){
                 $('#v_ifsc').html('Please enter IFSC number');
                 $('#ifsc').select();
            }else{
                $('#v_ifsc').html('');

            }
             if($('#acc_no').val()==''){
                 $('#v_acc').html('Please enter Account number');
                 $('#acc_no').select();
            }else{
                $('#v_acc').html('');

            }
         }
 
</script>
<script type="text/javascript">
              function pan_get_name(){
                val_check();
                var ifsc = $( "#ifsc" ).val();
                var acc_no = $( "#acc_no" ).val();
                    $.ajax({
                         type: "GET",
                         enctype: 'multipart/form-data',
                         url: 'get_bank_details',
                         data: {ifsc:ifsc,acc:acc_no},
                         dataType: 'json',
                         success: function (res) {
                             
                              if(res.status=='false'){
                                $('#acc_v').html('Account number not valid. please enter valid account number');
                            }else{
                            $('#verify').prop('disabled', true);
                            $('#submit_button').prop('disabled', false);
                            $('#ifsc').attr('readonly', true);
                            $('#acc_no').attr('readonly', true);
                            $('.myDiv').show();
                            $('#acc_v').html('');

                            document.getElementById('bank_name').value=res.bank_name; 
                            document.getElementById('branch').value=res.branch; 
                            document.getElementById('bank_address').value=res.bank_address; 
                            document.getElementById('full_name').value=res.full_name; 
                            }
                         },
                         error: function (e) {
                             console.log("ERROR : ", e);
                             console.log(e.responseText);
                         }
                     });
                 }
       </script>