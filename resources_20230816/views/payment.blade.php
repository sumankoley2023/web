 @include('include.header')

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Payment</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Payment</li>
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
                                    <form action="{{url('payment_generate')}}" method="post" enctype= "multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                               <h5>Payment Amount:-{{session('p_price')}}</h5>
                                                <div class="form-group">
                                                    <label>Payment Type<span class="text-danger">*</span></label>
                                                      <select class="form-control" data-toggle="select2" name="payment_type" required>
                                                        <option value="1">One Time Amount:-{{session('p_price')}}</option>
                                                        @if(session('package_id')=='4') 
                                                        <option value="emi">EMI Amount:-{{round(session('p_price')/4)}}</option>
                                                        @endif
                                                    </select>
                                                    
                                                </div>
                                                

                                               <div class="form-row align-items-center">
                                                   <div class="col-auto">
                                                        <button type="submit" id="submit_button" class="btn btn-success mb-2 waves-effect waves-light">Pay Now</button>
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