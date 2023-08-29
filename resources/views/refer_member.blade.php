 @include('include.header')

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Refer Member</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Refer Member</li>
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

                                       @endphp
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Share Link <span class="text-danger">*</span></label>
                                                    <a target="_blank" href="{{url('join/'.$encrypted)}}" id="p1">{{url('join/'.$encrypted)}}</a>
                                                </div>
                                                
                                                <input type="hidden" placeholder="Paste here for test" />
                                                
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto">
                                                        <button type="button" onclick="copyToClipboard('#p1')" class="btn btn-primary mb-2 waves-effect waves-light">Copy</button>
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
               function copyToClipboard(element) {
                  var $temp = $("<input>");
                  $("body").append($temp);
                  $temp.val($(element).text()).select();
                  document.execCommand("copy");
                  $temp.remove();
                }
           </script>
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
                         },
                         error: function (e) {
                             console.log("ERROR : ", e);
                             console.log(e.responseText);
                         }
                     });
                 }
       </script>