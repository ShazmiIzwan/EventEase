<?php $page = 'dashboard'; ?>
@include('Navigation-Admin.app')

<style>
  .chart-wrap { background: #fff; padding:1rem; border-radius:.5rem; box-shadow:0 2px 6px rgba(0,0,0,.1); }
  .dashboard-report-card { cursor: default; }
</style>

<div class="wrapper wrapper-body">
  <div class="dashboard-body">
    <div class="container-fluid">

      <!-- Title + Profile -->
      <div class="row mb-4">
        <div class="col-12">
          <div class="d-main-title">
            <h3><i class="fa-solid fa-gauge me-3"></i>Registration Overview</h3>
          </div>
        </div>
      </div>

      <!-- Summary Cards -->
      <div class="row">
        @php
          $cards = [
            ['title'=>'Total Registrations','value'=>$totalRegs,'icon'=>'fa-users','bg'=>'purple'],
            ['title'=>'This Year','value'=>$yearRegs,'icon'=>'fa-calendar-alt','bg'=>'red'],
            ['title'=>'Unique Participants','value'=>$uniqueParts,'icon'=>'fa-user','bg'=>'info'],
            ['title'=>'Your Events','value'=>$totalEvents,'icon'=>'fa-calendar','bg'=>'success'],
          ];
        @endphp

        @foreach($cards as $c)
        <div class="col-xl-3 col-lg-6 col-md-6 mb-4">
          <div class="dashboard-report-card {{ $c['bg'] }}">
            <div class="card-content d-flex justify-content-between align-items-center p-3">
              <div>
                <span class="card-title fs-6">{{ $c['title'] }}</span><br>
                <span class="card-sub-title fs-3">{{ $c['value'] }}</span>
              </div>
              <div class="card-media fs-2">
                <i class="fa-solid {{ $c['icon'] }}"></i>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>

      <!-- Charts -->
      <div class="row mt-4">
        <div class="col-lg-6 mb-4">
          <div class="chart-wrap">
            <h5 class="mb-3">Monthly Registrations ({{ now()->year }})</h5>
            <canvas id="monthlyChart" height="200"></canvas>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="chart-wrap">
            <h5 class="mb-3">Registrations by Category</h5>
            <canvas id="categoryChart" height="200"></canvas>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

@include('Navigation-Org.footer')

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // 1) Monthly line chart
    const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    const monthlyData = @json(array_map(function($i) use ($monthly) {
      return $monthly[$i] ?? 0;
    }, range(1,12)));

    const ctx1 = document.getElementById('monthlyChart').getContext('2d');
    new Chart(ctx1, {
      type: 'line',
      data: {
        labels: months,
        datasets: [{
          label: 'Registrations',
          data: monthlyData,
          fill: false,
          tension: 0.3
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              stepSize: 1,
              precision: 0
            }
          }
        }
      }
    });

    // 2) Category doughnut chart
    const categoryLabels = @json($byCat->keys()->all());
    const categoryData   = @json($byCat->values()->all());

    const ctx2 = document.getElementById('categoryChart').getContext('2d');
    new Chart(ctx2, {
      type: 'doughnut',
      data: {
        labels: categoryLabels,
        datasets: [{
          data: categoryData
        }]
      },
      options: {
        plugins: {
          legend: { position: 'bottom' }
        }
      }
    });
  });
</script>

