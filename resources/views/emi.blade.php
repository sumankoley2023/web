 @include('include.header')

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">EMI</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">EMI</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                   
                   
                
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <table id="" class="table table-striped table-bordered table-sm" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Installment</th>
                                                <th>EMI Date</th>
                                                <th>Amount</th>
                                                <th>Penalty</th>
                                                <th>Payment Status</th>
                                                <th>Payment Date</th>
                                                <th>Pay Now</th>
                                               
                                                
                                            </tr>
                                        </thead>
                                    
                                    
                                        <tbody>
                                            @php $i=0;$penalty_p=$mod=$penalty_amm=$penalty=$no_day=$j=0;@endphp
                                            @foreach($user_emi as $val)
                                            @php
                                            $i++;
                                            $penalty=$val->emi_amount;
                                            if($val->pad_status=='no'){
                                                $j++;
                                            $emi_date=$val->emi_date;
                                            $now = time(); // or your date as well
                                            $your_date = strtotime($emi_date);
                                            $datediff = $now - $your_date;

                                             $no_day=round($datediff / (60 * 60 * 24));
                                            
                                            if($no_day>7){
                                                $mod=round($no_day/7);
                                                $penalty_p=$mod*1.5;
                                                if($i==2 && $penalty_p>18){
                                                   $penalty_p=18; 
                                                }
                                                if($i==3 && $penalty_p>12){
                                                   $penalty_p=12; 
                                                }
                                                if($i==4 && $penalty_p>6){
                                                   $penalty_p=6; 
                                                }
                                                $penalty=$val->emi_amount+(($val->emi_amount*$penalty_p)/100);
                                                $penalty_amm=(($val->emi_amount*$penalty_p)/100);
                                              }
                                            }
                                            @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td><input class="form-control number" type="text" name="" value="{{$val->emi_date}}" readonly> </td>
                                                <td><input class="form-control number" type="text" name="" value="{{$val->emi_amount}}" readonly> </td>
                                                <td><!--{{$penalty_p}}/-->{{$penalty_amm}}</td>
                                                <td>{{$val->pad_status}}</td>
                                                <td>@if($val->pad_date!='0000-00-00'){{$val->pad_date}}@endif</td>
                                                <td> @if($val->pad_status=='no' && $j==1) <div class="form-row align-items-center">
                                                   <a href="{{url('pad_emi/'.$val->id.'/'.$penalty.'/'.$i)}}"><div class="col-auto">
                                                        <button type="submit" id="submit_button" class="btn btn-success mb-2 waves-effect waves-light">Pay Now</button>
                                                    </div></a>
                                                    @else
                                                    @if($val->pad_amount!='0.00')
                                                    {{$val->pad_amount}}
                                                    @endif
                                                @endif</td>
                                            </tr>
                                           
                                            @endforeach
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
       