<div id="viewLogDetails" class="modal fade" role="dialog">
    
</div>
<div class="overlay"></div>
<!--              -->
<!-- BEGIN SCRIPT -->
<!--              -->
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>-->
<script src="{{asset('assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
<script>
    window.jQuery || document.write('<script src="/docs/4.3/assets/js/vendor/jquery-slim.min.js"><\/script>')
</script>
<!--<script src="{{asset('/docs/4.3/dist/js/bootstrap.bundle.min.js')}}"
    integrity="sha384-xrRywqdh3PHs8keKZN+8zzc5TX0GRTLCcmivcbNJWm2rs5C8PRhcEn3czEjhAO9o" crossorigin="anonymous">
</script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js" integrity="sha256-fzFFyH01cBVPYzl16KT40wqjhgPtq6FFUB6ckN2+GGw=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.3/Chart.min.js"></script>
<!-- <script src="{{url('/js/dashboard.js')}}"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js"></script>

<script src="{{asset('/js/jquery-ui.js')}}"></script>
<script src="{{asset('/js/search.js')}}"></script>
<script>
	$(document).ready(function () {
        $('#dismiss, .overlay').on('click', function () {
            $('.sidebar').removeClass('shown');
            $('.overlay').removeClass('active');
        });

        $('#sidebarCollapse').on('click', function () {
            $('.sidebar').addClass('shown');
            $('.overlay').addClass('active');
            //$('.collapse.in').toggleClass('in');
            //$('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
        feather.replace()

        $(".sidebar_toggle").on('click',function() {
            $(".sidebar-sticky").toggle(500);            
        });

    });
    var base_url = "{{url('')}}";
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
      });
</script>

<!-- Bootstrap Form Helpers -->
<script src="{{asset('js/bootstrap-formhelpers-phone.js')}}"></script>

<!--            -->
<!-- END SCRIPT -->
<!--            -->
