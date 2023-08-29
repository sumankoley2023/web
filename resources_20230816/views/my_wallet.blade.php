@include('include.header')
@inject('provider', 'App\Http\Controllers\Member')
<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">My Wallet</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">My Wallet</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5>Wallet Balance:- @php $bal=DB::table('members')->where('id','=',session('members_id'))->where('status','=','yes')->select('wallet_bal','level_eligibility')->get(); echo $bal[0]->wallet_bal @endphp</h5>
                                    
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