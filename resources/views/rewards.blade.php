 @include('include.header')

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Rewards</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Rewards</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                   
                   
                
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body"><h6>Monthly achievement</h6>
                                    <table id="" class=" table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Current Position </th>
                                                <th>Upcoming Position</th>
                                           </tr>
                                        </thead>
                                    
                                    
                                        <tbody>
                                           @php
                                           $tot_busness_val=0;
                                           if($eligibility_month_rew==1){
                                            $tot_busness_val=$tot_amm_month;
                                           }
                                           $cur_month=DB::table('rewards_monthly_master')->where('start_amm','<=',$tot_busness_val)->where('end_amm','>=',$tot_busness_val)->get();
                                          if($cur_month[0]->id+1<=6){
                                             $next=$cur_month[0]->id+1;
                                          }else{
                                            $next='6';
                                          }
                                          
                                           $upcoming_month=DB::table('rewards_monthly_master')->where('id','=',$next)->get();

                                           @endphp
                                           
                                            
                                            <tr>
                                                <td>Amount</td>
                                                <td>{{$cur_month[0]->start_amm}}</td>
                                                <td>{{$upcoming_month[0]->start_amm}}</td>
                                            </tr>
                                           <tr>
                                                <td>Rewards</td>
                                                <td>{{$cur_month[0]->reward}}</td>
                                                <td>{{$upcoming_month[0]->reward}}</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </form>
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body"><h6>Yearly achievement</h6>
                                    <table id="" class=" table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Current Position </th>
                                                <th>Upcoming Position</th>
                                           </tr>
                                        </thead>
                                    
                                    
                                        <tbody>
                                           @php
                                           $tot_busness_val=0;
                                           if($eligibility_year_rew==1){
                                            $tot_busness_val=$tot_amm_year;
                                           }
                                           
                                           $cur_year=DB::table('rewards_yearly_master')->where('start_amm','<=',$tot_busness_val)->where('end_amm','>=',$tot_busness_val)->get();
                                          if($cur_year[0]->id+1<=11){
                                             $next=$cur_year[0]->id+1;
                                          }else{
                                            $next='11';
                                          }
                                          
                                           $upcoming_year=DB::table('rewards_yearly_master')->where('id','=',$next)->get();

                                           @endphp
                                           
                                            
                                            <tr>
                                                <td>Amount</td>
                                                <td>{{$cur_year[0]->start_amm}}</td>
                                                <td>{{$upcoming_year[0]->start_amm}}</td>
                                            </tr>
                                           <tr>
                                                <td>Rewards</td>
                                                <td>{{$cur_year[0]->reward}}</td>
                                                <td>{{$upcoming_year[0]->reward}}</td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </form>
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>


                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

           @include('include.footer')
       <script type="text/javascript">

      //$('#myDiv').hide();
       function val_check(val) {
                if(val=='emi'){
                     $('#myDiv').show();

                }else{
                     $('#myDiv').hide();

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