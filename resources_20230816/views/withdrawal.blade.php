@include('include.header')
@inject('provider', 'App\Http\Controllers\Member')
<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Withdrawal</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Withdrawal</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Wallet Balance:- @php $bal=DB::table('members')->where('status','=','yes')->where('id','=',session('members_id'))->select('wallet_bal','level_eligibility')->get(); echo $bal[0]->wallet_bal @endphp</h5>
                                    <div class="col-md-6">
                                        <form action="{{url('req_withdrawal')}}" method="post" enctype= "multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Enter Amount <span class="text-danger">*</span></label>
                                            <input type="text" placeholder="Enter Amount" class="form-control number" name="amount" id=""  autocomplete="off" required>
                                            <span class="text-danger" id="alert_pan"></span>
                                        </div>
                                        <div class="form-row align-items-center">
                                            <div class="col-auto">
                                                <button type="submit" id="submit_button" class="btn btn-primary mb-2 waves-effect waves-light">Request Now</button>
                                            </div>
                                        </div>
                                    </form>
                                    @php $limit=DB::table('withdrawal_condition')->where('status','=','yes')->select('min_wallet_bal','min_withdrawal_bal')->get();@endphp
                                    <p style="color: red;">*Minimum withdrawal limit:-{{$limit[0]->min_withdrawal_bal}}</p>
                                    <p style="color: red;">*Minimum Wallet balance:-{{$limit[0]->min_wallet_bal}}</p>
                                    </div>
                                 </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dtHorizontalExample" class=" table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Sl</th>
                                                <th>Request Date</th>
                                                <th>Amount</th>
                                                <th>Tranjaction type</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                        </thead>
                                    
                                    
                                        <tbody>
                                            <?php echo $str?>
                                            
                                        </tbody>
                                    </table>
                                
                                </div> <!-- end card body-->
                            </div> <!-- end card -->
                        </div><!-- end col-->
                    </div>
                    </div>
                   

               
                    
                </div>
            </div>
            
@include('include.footer')