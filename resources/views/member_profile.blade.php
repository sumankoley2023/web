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
                                    <form action="{{url('insert_profile_1')}}" method="post" enctype= "multipart/form-data">
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
                                                    <input type="hidden" placeholder="Mobile No" class="form-control number" name="old_mobile" id="mobile" onblur="mobile_check()" value="{{$data->phone}}" required>
                                                </div>
                                                <span class="text-danger" id="tel"></span>

                                                <div class="form-group">
                                                    <label>Mail ID<span class="text-danger">*</span></label>
                                                    <input type="email" placeholder="Mail ID" value="{{$data->email}}"  class="form-control " name="email" id="email" required>
                                                    <input type="hidden" placeholder="Mail ID" value="{{$data->email}}"  class="form-control " name="old_email" id="email" required>
                                                </div>
                                               <div class="form-group">
                                                    <label>Select Package <span class="text-danger">*</span></label>
                                                      <select class="form-control" data-toggle="select2" name="package_id" required>
                                                        <option value="">Select</option>
                                                        @foreach($package as $package_data)
                                                        <option value="{{$package_data->id}}">{{$package_data->p_type}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                 <div class="form-group">
                                                    <label>Select Address Proof<span class="text-danger">*</span></label>
                                                      <select class="form-control" data-toggle="select2" name="gov_id_card_id" id="" required>
                                                        <option value="">Select</option>
                                                        @foreach($address_prove as $address_data)
                                                        <option value="{{$address_data->id}}">{{$address_data->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                 <div class="form-group">
                                                    <label>Upload Document(max 100kb jpg,png) <span class="text-danger">*</span></label>
                                                      <div class="custom-file">
                                                        <input type="file" class="custom-file-input"  name="document" accept=".jpg, .png" id="doc" style="opacity: unset !important;padding: 4px !important;"
                                                            required>
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                 <div class="form-group">
                                                    <label>Enter Upload Document Number<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Enter Upload Document Number"  class="form-control " name="gov_id_no" id="" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Upload Profile Pic(max 100kb jpg,png) <span class="text-danger">*</span></label>
                                                      <div class="custom-file" >
                                                        <input type="file" class="custom-file-input"  name="profile" accept=".jpg, .png" id="profile" style="opacity: unset !important;padding: 4px !important;"
                                                            required>
                                                        <label class="custom-file-label" for="customFile">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto">
                                                        <input id="terms" type="checkbox" onclick="agree()" name="terms" required /> 
                                                    </div><label>I agree<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto">
                                                        <button type="submit" id="submit_button" class="btn btn-primary mb-2 waves-effect waves-light">Submit</button>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->
                                            @endforeach
                                            
                                            
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
        function mobile_check() {
            if($('#mobile').val().length!=10){
                 $('#tel').html('Please enter valid phone number');
                 $('#mobile').select();
            }else{
                $('#tel').html('');

            }
         }

         </script>
       <script type="text/javascript">
            $(document).ready(function() {       
            $('#doc').bind('change', function() {
                var a=(this.files[0].size);
               // alert(a);
                if(a > 100000) {
                    alert('Size of image exceeds 100kb ');
                     $('#doc').val('');
                };
            });
        });
    </script>
    <script type="text/javascript">
            $(document).ready(function() {       
            $('#profile').bind('change', function() {
                var a=(this.files[0].size);
               // alert(a);
                if(a > 100000) {
                    alert('Size of image exceeds 100kb ');
                     $('#profile').val('');
                };
            });
        });
    </script>