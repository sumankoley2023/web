@include('include.header')
@inject('provider', 'App\Http\Controllers\Member')
<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Direct Team</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Direct Team</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="dtHorizontalExample" class=" table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Reg Date</th>
                                                <th>Member ID</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Amount</th>
                                                
                                                
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