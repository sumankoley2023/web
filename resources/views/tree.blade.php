@include('include.header')
@inject('provider', 'App\Http\Controllers\Member')
<div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">Tree</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body" style="overflow-y: scroll;">
                                    <ul id="myUL" style="font-size: large;">
                                        <li><span class="caret">{{session('display_name')}}</span>
                                            <ul class="nested">
                                                 @php echo $str @endphp
                                            </ul>
                                        </li>
                                    </ul>
                                    <!-- <ul id="myUL" style="font-size: large;">
                                      <li><span class="caret">{{session('display_name')}}</span>
                                        <ul class="nested">
                                           
                                           
                                          <li>Coffee</li>
                                          <li><span class="caret">Tea</span>
                                            <ul class="nested">
                                              <li>Black Tea</li>
                                              <li>White Tea</li>
                                              <li><span class="caret">Green Tea</span>
                                                <ul class="nested">
                                                  <li>Sencha</li>
                                                  <li>Gyokuro</li>
                                                  <li>Matcha</li>
                                                  <li>Pi Lo Chun</li>
                                                </ul>
                                              </li>
                                            </ul>
                                          </li>  
                                        </ul>
                                      </li>
                                    </ul> -->
                                </div>
                            </div>
                        </div>
                    </div>
                   

                <script>
                var toggler = document.getElementsByClassName("caret");
                var i;

                for (i = 0; i < toggler.length; i++) {
                  toggler[i].addEventListener("click", function() {
                    this.parentElement.querySelector(".nested").classList.toggle("active");
                    this.classList.toggle("caret-down");
                  });
                }
                </script>
                    
                </div>
            </div>
            <style>
ul, #myUL {
  list-style-type: none;
}

#myUL {
  margin: 0;
  padding: 0;
}

.caret {
  cursor: pointer;
  -webkit-user-select: none; /* Safari 3.1+ */
  -moz-user-select: none; /* Firefox 2+ */
  -ms-user-select: none; /* IE 10+ */
  user-select: none;
}

.caret::before {
  content: "\25B6";
  color: black;
  display: inline-block;
  margin-right: 6px;
}

.caret-down::before {
  -ms-transform: rotate(90deg); /* IE 9 */
  -webkit-transform: rotate(90deg); /* Safari */'
  transform: rotate(90deg);  
}

.nested {
  display: none;
}

.active {
  display: block;
}
</style>
@include('include.footer')