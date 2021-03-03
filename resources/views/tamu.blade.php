@extends('layouts.appNonAuth')

@section('content')
  <script type="text/javascript">
    const BASE_URL = '{{url("/")}}';
    const AUTH_LOGIN_ID = null ;
    const APP_BASE = '{{ env('APP_BASE') }}'
  </script>

  <div id="app"> </div>
  <?php if (!empty($permitted)): ?>
  <?php else: ?>
    <!-- <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card text-center">
            <h1 class="py-4">
              Harap Scan QR CODE Terlebih Dahulu
            </h1>
          </div>
        </div>
      </div>
    </div> -->
  <?php endif; ?>

  <script src="{{ asset('js/tamu.js') }}" ></script>
@endsection
