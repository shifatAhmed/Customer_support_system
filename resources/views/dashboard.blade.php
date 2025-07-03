@extends('layouts.app', ['page_title' => 'Dashboard', 'page_parent_title' => '','page_parent_url' => ''])

@push('styles')
@endpush

@section('content')
  <div class="row">
    <div class="col-lg-12 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Welcome {{ Auth::user()->name }}! 🎉</h5>
              <p class="mb-4">Please review the data below and take action to drive the company's growth even further!</p>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img
                src="{{ URL::to('/') }}/assets/img/illustrations/man-with-laptop-light.png"
                height="140"
                alt="View Badge User"
                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                data-app-light-img="illustrations/man-with-laptop-light.png"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-12 col-md-12 order-1">
      <div class="row">
        @foreach($service_tickets as $ticket)
        <div class="col-lg-3 col-md-12 col-6 mb-4">
          <a href="edit-ticket/{{$ticket->id}}" >
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img
                      src="{{ URL::to('/') }}/assets/img/icons/unicons/chart-success.png"
                      alt="chart success"
                      class="rounded"
                    />
                  </div>
                </div>
                <h3 class="card-title mb-2"><span>{{$ticket->title}}</span></h3>
                <p>{{$ticket->description}}</p>
              </div>
            </div>
          </a>
        </div>
        @endforeach
      </div>
    </div>
    <!-- Total Revenue -->
    <!-- <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
      <div class="card">
        <div class="row row-bordered g-0">
          <div class="col-md-12">
            <h5 class="card-header m-0 me-2 pb-3">Customer Growth (This Month)</h5>
            <div id="customerGrowthChart" class="px-2"></div>
          </div>
        </div>
      </div>
    </div> -->
    <!--/ Total Revenue -->
  </div>
@endsection

@push('scripts')
<script type="text/javascript">
  $(document).ready(function(){

  });
</script>
@endpush

            