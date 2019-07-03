<!-- jQuery 3 -->
@include('layouts.Admin.includes._session')

<!--ckeditor -->
<script src="{{ asset('Admin/plugins/ckeditor/ckeditor.js') }}" ></script>
<script src="{{ url ('/Admin')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ url ('/Admin')}}/bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url ('/Admin')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="{{ url ('/Admin')}}/bower_components/raphael/raphael.min.js"></script>
<script src="{{ url ('/Admin')}}/bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="{{ url ('/Admin')}}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="{{ url ('/Admin')}}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ url ('/Admin')}}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ url ('/Admin')}}/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ url ('/Admin')}}/bower_components/moment/min/moment.min.js"></script>
<script src="{{ url ('/Admin')}}/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="{{ url ('/Admin')}}/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url ('/Admin')}}/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="{{ url ('/Admin')}}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="{{ url ('/Admin')}}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ url ('/Admin')}}/dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url ('/Admin')}}/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url ('/Admin')}}/dist/js/demo.js"></script>

<!-- start sweetalert 2 links-->
<script src="{{ url ('/Admin')}}/dist/js/sweetalert2.js"></script>
<!-- end sweetalert 2 links-->
<script>
  $(document).ready(function(){

  
    $('.delete').click(function(e){
      e.preventDefault(); // to stop action
      const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false,
      })

      swalWithBootstrapButtons.fire({
        title: "@lang('site.Are_you_sure?')",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: "@lang('site.Yes_delete_it')",
        cancelButtonText: "@lang('site.No_cancel')",
        reverseButtons: false
      }).then((result) => {
        if (result.value) {
          swalWithBootstrapButtons.fire(
            "@lang('site.Deleted!')",
            "@lang('site.your_file_has_been_deleted')",
          )
        $(this).closest('form').submit();
        } else if (
          // Read more about handling dismissals
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalWithBootstrapButtons.fire(
            "@lang('site.canceled')",
            '',
            'error'
          )
        }
      })
    }) // end delete script


    CKEDITOR.config.language = "{{app()->getLocale() }}"; 




  $(".image").change(function() { 
    
     if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('.image-preview').attr('src', e.target.result);
        }
        
        reader.readAsDataURL(this.files[0]);
    }
  });
});//end of ready
</script>

@include('layouts.Admin.includes._session')
</body>
</html>
