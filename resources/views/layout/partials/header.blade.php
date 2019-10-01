<!--                -->
<!-- BEGIN CONTENT  -->
<!--                -->
          <!-- Dashboard Body -->
          <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            @if(session()->has('excpMsg'))
            <br>
                <div class="alert alert-danger">
                    {{ session()->get('excpMsg') }}
                    @php Session::forget('excpMsg');@endphp
                </div>
            @endif
            <!-- Section Title & Nav -->
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
              <h1 class="h2" id="main_header">Dashboard</h1> <!-- This should be dynamic for each page -->
            </div>
