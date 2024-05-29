<!-- Main Content -->
<?php $page = 'Dashboard' ?>
<div class="main-content">
  <section class="section">
    <div class="row ">
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row ">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-20">Peminjaman</h5>
                    <h2 class="mb-3 font-28"><?= $countpeminjaman ?></h2>
                    <p class="mb-0"><span class="col-green">Jumlah Peminjaman</span></p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img text-center mt-3">
                    <!-- <img src="assets/img/banner/1.png" alt=""> -->
                    <p style="font-size: 50px; color: green"><i class="fa fa-hands-helping"></i></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row ">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-20">Pengembalian</h5>
                    <h2 class="mb-3 font-28"><?= $countpengembalian ?></h2>
                    <p class="mb-0"><span class="col-orange">Jumlah Pengembalian</span></p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img text-center mt-3">
                    <!-- <img src="assets/img/banner/1.png" alt=""> -->
                    <p style="font-size: 50px; color: orange"><i class="fa fa-hands-helping"></i></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row ">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-20">Kerusakan</h5>
                    <h2 class="mb-3 font-28"><?= $countlaporan ?></h2>
                    <p class="mb-0"><span class="col-red">Jumlah Laporan</p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img text-center mt-3">
                    <!-- <img src="assets/img/banner/1.png" alt=""> -->
                    <p style="font-size: 50px; color: red"><i class="fa fa-file-contract"></i></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
          <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
              <div class="row ">
                <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                  <div class="card-content">
                    <h5 class="font-20">Barang</h5>
                    <h2 class="mb-3 font-28"><?= $countbarang ?></h2>
                    <p class="mb-0"><span class="col-blue">Jumlah Barang</p>
                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 pl-0">
                  <div class="banner-img text-center mt-3">
                    <!-- <img src="assets/img/banner/1.png" alt=""> -->
                    <p style="font-size: 50px; color: blue"><i class="fa fa-boxes"></i></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- CHART PENGUNJUNG DAN PEMINJAM BUKU -->
    <div class="row">
      <div class="col-12 col-sm-12 col-lg-12">
        <div class="card ">
          <div class="card-body text-center">
            <h2>
              <div id="chart1"></div>
            </h2>
          </div>
        </div>
      </div>
    </div>
  </section>


</div>
<!-- JS Libraies -->
<script src="<?= base_url('assets/bundles/apexcharts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/chartjs/chart.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') ?>"></script>
<script>
  $(function() {
    chart1();

    function chart1() {
      var options = {
        chart: {
          height: 400,
          type: "line",
          shadow: {
            enabled: true,
            color: "#000",
            top: 18,
            left: 13,
            blur: 10,
            opacity: 1
          },
          toolbar: {
            show: false
          }
        },
        colors: ["green", "orange","red"],
        dataLabels: {
          enabled: true
        },
        stroke: {
          curve: "smooth"
        },
        series: [{
            name: "Peminjaman",
            data: [<?php foreach($bulanpeminjaman as $bpm){
              echo $bpm->jumlah.',';
            } ?>]
          },
          {
            name: "Pengembalian",
            data: [<?php foreach($bulanpengembalian as $bpb){
              echo $bpb->jumlah.',';
            } ?>]
          },
          {
            name: "Kerusakan",
            data: [<?php foreach($bulankerusakan as $rusak){
              echo $rusak->jumlah.',';
            } ?>]
          }
        ],
        grid: {
          borderColor: "#e7e7e7",
          row: {
            colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
            opacity: 0.0
          }
        },
        markers: {
          size: 6
        },
        xaxis: {
          categories: [<?php foreach($bulan as $bulan){
            echo '"'.date('F', strtotime($bulan->bulan)).'",';
        }?>],

          labels: {
            style: {
              colors: "#9aa0ac"
            }
          }
        },
        yaxis: {
          title: {
            text: "Jumlah"
          },
          labels: {
            style: {
              color: "#9aa0ac"
            }
          },
          min: 0,
          max: 50
        },
        legend: {
          position: "top",
          horizontalAlign: "right",
          floating: true,
          offsetY: -25,
          offsetX: -5
        }
      };

      var chart = new ApexCharts(document.querySelector("#chart1"), options);

      chart.render();
    }

  });
</script>
<!-- Page Specific JS File -->