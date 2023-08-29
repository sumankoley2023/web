@include('include.header')

<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Dashboard</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                  @foreach($member_data as $val)
                    <div class="container">
   
                    <div class="col-md-12">
                      <div class="row">
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="cockpit" routerLink="total-members" style="cursor: pointer;">
                            <div class="cockpit-up"> 
                              <table style="width: 100%;">
                                <tr>
                                  <td style="font-size: 45px">
                                    <li class="fa fa-user" style="color:#0762bd "></li>
                                  </td>
                                  <td align="right" style="font-size: 25px">
                                    {{$val->user_name}}
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="cockpit-down">
                              User Id
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="cockpit" routerLink="active-members" style="cursor: pointer;">
                            <div class="cockpit-up">
                              <table style="width: 100%;">
                                <tr>
                                  <td style="font-size: 45px">
                                    <li class="far fa-money-bill-alt" style="color:#2ec500 "></li>
                                  </td>
                                  <td align="right" style="font-size: 25px">
                                  {{$val->direct}}
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="cockpit-down">
                             Immediate Income
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="cockpit" routerLink="non-active-members" style="cursor: pointer;">
                            <div class="cockpit-up">
                              <table style="width: 100%;">
                                <tr>
                                  <td style="font-size: 45px">
                                    <li class="far fa-money-bill-alt" style="color:#ee0a0a "></li>
                                  </td>
                                  <td align="right" style="font-size: 25px">
                                    {{$val->executive}}
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="cockpit-down">
                              Executive Income
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="cockpit" routerLink="non-active-members" style="cursor: pointer;">
                            <div class="cockpit-up">
                              <table style="width: 100%;">
                                <tr>
                                  <td style="font-size: 45px">
                                    <li class="far fa-money-bill-alt" style="color:rgb(0, 146, 195) "></li>
                                  </td>
                                  <td align="right" style="font-size: 25px">
                                    {{$val->steady}}
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="cockpit-down">
                              Steady Income
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="cockpit" routerLink="non-active-members" style="cursor: pointer;">
                            <div class="cockpit-up">
                              <table style="width: 100%;">
                                <tr>
                                  <td style="font-size: 45px">
                                    <li class="far fa-money-bill-alt" style="color:rgb(240, 169, 36) "></li>
                                  </td>
                                  <td align="right" style="font-size: 25px">
                                    {{$val->binary_bal}}
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="cockpit-down">
                              Binary Income
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="cockpit" routerLink="non-active-members" style="cursor: pointer;">
                            <div class="cockpit-up">
                              <table style="width: 100%;">
                                <tr>
                                  <td style="font-size: 45px">
                                    <li class="far fa-money-bill-alt" style="color:rgb(206, 25, 219) "></li>
                                  </td>
                                  <td align="right" style="font-size: 25px">
                                    {{$val->wallet_bal}}
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="cockpit-down">
                              Wallet Balance
                            </div>
                          </div>
                        </div>
                         <div class="col-md-3 col-sm-4 col-xs-12">
                          <div class="cockpit" routerLink="non-active-members" style="cursor: pointer;">
                            <div class="cockpit-up">
                              <table style="width: 100%;">
                                <tr>
                                  <td style="font-size: 45px">
                                    <li class="far fa-money-bill-alt" style="color:rgb(7, 30, 206) "></li>
                                  </td>
                                  <td align="right" style="font-size: 25px">
                                    {{$val->tot_earning}}
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="cockpit-down">
                              Total Income
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
            </div>
            <style type="text/css">
                .container
{
    width: 100%;
    padding: 25px 0px;
    padding-top: 0px;
    // background-color: aquamarine;
  
}
.cockpit
{
    width: 100%;
    min-height: 167px;
    background-color: #fff;
    box-shadow: 0 2px 10px 0 rgba(0, 0, 0, 0.2);
    margin-top: 15px;
    padding: 2%;
    padding-top: 11px;
    overflow: hidden;
    border-radius: 7px;
}

// .cpone
// {
//     background-image: url("assets/images/rev.jpg");
// }

// .cockpit:hover
// {
//     box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);  
// }

@media screen and (max-width: 900px) {
    .cockpit
    {
        margin-top: 25px;
    }
  }

  .cockpit-up
  {
      width: 100%;
      height: 75px;
      padding: 10px 20px;
  }
  .cockpit-down
  {
      width: 100%;
      height: 35px;
      font-size: 15px;
      text-align: center;
      padding-top: 15px;
  }

  .subi:hover
  {
    background-color: #f7f7f7 !important;
    .ic2{
        color:#4b4b4b !important;
    }
  }

  .title
  {
    padding: 5px;
    border-bottom: 1px solid #e7e7e7;
    margin: 5px 0px 20px 0px;
  }

  .dash_b_title
  {
    padding: 10px 15px 0px 14px;
    color: #8a88a2aa;
    font-weight: 600 !important;
    cursor: default;
    font-size: 20px;
  }
  .dash_b_title:hover
  {
    padding: 10px 15px 0px 14px;
    color: #02767a;
    font-weight: 600!important;
  }

  @media (min-width: 1200px)
  {
  .container {
      max-width: 1285px;
  }
}

.currency
{
  background-color: white;
  font-size: 18px;
  padding: 5px 15px;
  border-radius: 5px;
  font-weight: normal;
  border: 2px solid #02767a;
  cursor: pointer;
}

.currency:hover
{
  background-color: #bee8e9;
  font-size: 18px;
  padding: 5px 15px;
  border-radius: 5px;
  font-weight: normal;
  color: #02767a;
  border: 2px solid #02767a;
  cursor: pointer;
}

.overlay
{
    position: fixed;
    z-index:1;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    background:#00000075;
    overflow: auto;
}



.avatorbox
{
    text-align: center;
//     padding: 5vh;
//     text-align: right;
//     padding-right: 0;
}

.whitebox
{
    width: 400px;
    margin: 8% auto;
}
@media only screen and (max-width: 600px) {
    .whitebox
    {
        width:auto;
        margin: 8% auto;
    }
  }
    
            </style>
@include('include.footer')
