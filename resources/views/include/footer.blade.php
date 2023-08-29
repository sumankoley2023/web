  <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            2023 © HealthX
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right dl-none d-sm-block">
                                Design & Develop by Atomax
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
 </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>
    <style type="text/css">
        .vertical-menu {
    width: 240px;
    z-index: 1001;
    background: #4cffee;
    bottom: 0;
    margin-top: 0;
    top: 0;
    position: fixed;
    -webkit-box-shadow: 0 0 20px 0 rgba(183,190,199,0.15);
    box-shadow: 0 0 20px 0 rgba(183,190,199,0.15);
}
.navbar-header {
   
    background-color: #81e6e3;
    
}
#sidebar-menu ul li a {
    display: block;
    padding: 0.65rem 1.5rem;
    color: #0000ff;
    position: relative;
    font-size: 15px;
    -webkit-transition: all .4s;
    transition: all .4s;
}
    </style>
    <style type="text/css">
        .logo img {
    height: 55px;
}
    </style>
    <style type="text/css">
                .dtHorizontalExampleWrapper {
  max-width: 600px;
  margin: 0 auto;
}
#dtHorizontalExample th, td {
  white-space: nowrap;
}

table.dataTable thead .sorting:after,
table.dataTable thead .sorting:before,
table.dataTable thead .sorting_asc:after,
table.dataTable thead .sorting_asc:before,
table.dataTable thead .sorting_asc_disabled:after,
table.dataTable thead .sorting_asc_disabled:before,
table.dataTable thead .sorting_desc:after,
table.dataTable thead .sorting_desc:before,
table.dataTable thead .sorting_desc_disabled:after,
table.dataTable thead .sorting_desc_disabled:before {
 bottom: .5em;
}
            </style>

    <!-- jQuery  -->
    <script src="{{asset('public/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('public/assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('public/assets/js/metismenu.min.js')}}"></script>
    <script src="{{asset('public/assets/js/waves.js')}}"></script>
    <script src="{{asset('public/assets/js/simplebar.min.js')}}"></script>

    <!-- Plugins js -->
    <script src="{{asset('public/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/dataTables.bootstrap4.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/buttons.flash.min.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/dataTables.select.min.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('public/plugins/datatables/vfs_fonts.js')}}"></script>


    <script src="{{asset('public/plugins/autonumeric/autoNumeric-min.js')}}"></script>
    <script src="{{asset('public/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('public/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}"></script>
    <script src="{{asset('public/plugins/moment/moment.js')}}"></script>
    <script src="{{asset('public/plugins/daterangepicker/daterangepicker.js')}}"></script>
    <script src="{{asset('public/plugins/select2/select2.min.js')}}"></script>
    <script src="{{asset('public/plugins/switchery/switchery.min.js')}}"></script>
    <script src="{{asset('public/plugins/bootstrap-colorpicker/bootstrap-colorpicker.min.js')}}"></script>
    <script src="{{asset('public/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js')}}"></script>

    <!-- Custom Js -->
    <script src="{{asset('public/assets/pages/advanced-plugins-demo.js')}}"></script>
        <script src="{{asset('public/assets/pages/datatables-demo.js')}}"></script>
    <!-- App js -->
    <script src="{{asset('public/assets/js/theme.js')}}"></script>
    <script>
    var elem = document.getElementsByClassName("number"); //use the CLASS in your input field.
        for (i = 0; i < elem.length; i++) {
            elem[i].addEventListener('keypress', function(event){
                var keys = [46, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57,0];
                var validIndex = keys.indexOf(event.charCode);
                if(validIndex == -1){
                event.preventDefault();
                }
            });
        }
</script>
 <script type="text/javascript">
      function only_text(e){
          var k;
          document.all ? k = e.keyCode : k = e.which;
          return ((k > 96 && k < 123) || (k > 64 && k < 91) || k == 32 );
          }
    </script>
    <script type="text/javascript">
        function only_email(e){
            var k;
            document.all ? k = e.keyCode : k = e.which;
            return ((k > 96 && k < 123) || (k >= 64 && k < 91)  || k==46 || (k >= 48 && k <= 57));
            }
      </script>
      <script type="text/javascript">
    $(document).ready(function () {
  $('#dtHorizontalExample').DataTable({
    "scrollX": true
  });
  $('.dataTables_length').addClass('bs-select');
});
</script>

</body>

</html>