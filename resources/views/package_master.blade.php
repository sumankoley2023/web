 @include('include.header')

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Package Master</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Package Master</li>
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
                                    <form action="{{url('insert_package_master')}}" method="post" enctype= "multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Package Type <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Package Type" class="form-control" name="p_type" id="display_name" onkeypress="return only_text(event)" onblur="name_check()" autocomplete="off" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Package Price <span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Package Price" class="form-control number" name="p_price" id="" required>
                                                </div><span class="text-danger" id=""></span>

                                                <div class="form-group">
                                                    <label> Product Value<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Product Value" class="form-control number" name="product_value" id="" required>
                                                </div><span class="text-danger" id=""></span>
                                                <div class="form-group">
                                                    <label>Direct Commission %<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Direct Commission" class="form-control number" name="direct_com" id=""  required>
                                                </div><span class="text-danger" id=""></span>
                                                
                                                <div class="form-group">
                                                    <label>Coverage<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Coverage" class="form-control" name="coverage" id=""  required>
                                                </div><span class="text-danger" id=""></span>
                                                <div class="form-group">
                                                    <label>Wallet Amount<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Wallet Amount" class="form-control number" name="wallet_amount" id="" required>
                                                </div><span class="text-danger" id=""></span>
                                               <div class="form-group">
                                                    <label>Discount<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Discount" class="form-control number" name="discount" id="" required>
                                                </div><span class="text-danger" id=""></span>
                                               <!--  <div class="form-group">
                                                    <label>Effect From Date<span class="text-danger">*</span></label>
                                                    <input type="text" placeholder="Effect From Date" class="form-control number" name="effect_date" id="" required>
                                                </div><span class="text-danger" id=""></span> -->
                                                <div class="form-row align-items-center">
                                                    <div class="col-auto">
                                                        <button type="submit"
                                                            class="btn btn-primary mb-2 waves-effect waves-light">Submit</button>
                                                    </div>
                                                </div>
                                            </div> <!-- end col -->

                                            
                                            
                                        </div>
                                    </form>

                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col -->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Owner Master List</h4>
                                    

                                    <table id="basic-datatable" class="table dt-responsive nowrap">
                                        <thead>
                                            <tr>
                                                <th>SL</th>
                                                <th>Package Type</th>
                                                <th>Package Price</th>
                                                <th>Product Value</th>
                                                <th>Direct Commission</th>
                                                <th>Coverage</th>
                                                <th>Wallet Amount</th>
                                                <th>Discount</th>
                                                <th>Status</th>
                                                <th>Delete</th>
                                                
                                            </tr>
                                        </thead>
                                    
                                    
                                        <tbody>
                                            @php $i=1;@endphp
                                            @foreach($package_master as $data)
                                            <tr>
                                                <td>{{$i++}}</td>
                                                <td>{{$data->p_type}}</td>
                                                <td>{{$data->p_price}}</td>
                                                <td>{{$data->product_value}}</td>
                                                <td>{{$data->direct_com}}</td>
                                                <td>{{$data->coverage}}</td>
                                                <td>{{$data->wallet_amount}}</td>
                                                <td>{{$data->discount}}</td>
                                               
                                               
                                                <td>@if($data->status=='yes')
                                                    <a href="{{url('status_package_master/'.$data->id.'/no')}}"><i class="bx bx-check btn-primary" ></i></a>
                                                    @else
                                                    <a href="{{url('status_package_master/'.$data->id.'/yes')}}"><i class="bx bx-x btn-warning " ></i></a>
                                                    @endif
                                                </td>
                                                <td><a onclick="return confirm('Are you sure to delete ?');" href="{{url('del_package_master/'.$data->id)}}"><i class="bx bxs-trash text-danger"></i></a></td>
                                            </tr>
                                            <!-- bx bx-x -->
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>


                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

           @include('include.footer')
       <script type="text/javascript">
           $("#select_2").select2({
              minimumResultsForSearch: Infinity
            });

           function mobile_check() {
            if($('#mobile').val().length!=10){
                 $('#tel').html('Please enter valid phone number');
                 $('#mobile').select();
            }else{
                $('#tel').html('');
            }
         }
        function name_check() {
            if($('#display_name').val()==''){
                 //$('#alert_text').html('Please enter name');
                // $("#customalertModal").modal('show');
                $('#name').html('Please enter valid Name');
                 $('#display_name').select();
            }else{
                $('#name').html('');
            }
        }
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
        $('#upload_file').bind('change', function() {
            var a=(this.files[0].size);
           // alert(a);
            if(a > 100000) {
                $('#upload_file').val(null);
                alert('image size not smaller than recommended size');
            };
        });
           </script>