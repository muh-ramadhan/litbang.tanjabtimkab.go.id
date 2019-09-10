<!-- MULAI SCRIPT KOSTUM GOOGLE -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var jsonData = $.ajax({
      url: "<?php echo base_url() . 'Polling/ambilpolling' ?>",
      dataType: "json",
      async: false
    }).responseText;
    var data = new google.visualization.DataTable(jsonData);
    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, {width: 900, height: 500});
  }

</script>
<!-- SELESAI SCRIPT KOSTUM GOOGLE -->
<!-- MEMILIH KONIDISI -->
<?php  if ($this->uri->segment(1,0)=='polling' and $this->uri->segment(2,0)==null) { ?>
  <!-- MULAI MINI IKLAN HEADER -->
  <section class="breadcrumb breadcrumb_bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb_iner text-center">
            <div class="breadcrumb_iner_item">
              <h2><?php echo $judulan; ?></h2>
              <p>
                <a href="<?php echo base_url(); ?>" class="text-white">Home</a>
                <span>//</span>
                <a href="<?php echo base_url(); ?>polling" class="text-white">Semua Polling</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- SELESAI MINI IKLAN HEADER -->

  <!-- MULAI ISI -->
  <section class="blog_area section_padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-5 mb-lg-0">
          <div class="blog_left_sidebar">
            <div class="box-single-content clearfix" id="pagehead">
              <h2><?php echo $judulan; ?></h2>
              <p class="rs post-by"><?php echo $postingby; ?></p>
              <div id="chart_div"></div></div>
              <!-- AKHIR DARI SEMUA CERITA YANG PANJANG -->

              <?php
            } elseif ($this->uri->segment(1,0)=='polling' and $this->uri->segment(2,0)=='vote') { ?>
              <!-- MULAI MINI IKLAN HEADER -->
              <section class="breadcrumb breadcrumb_bg">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-12">
                      <div class="breadcrumb_iner text-center">
                        <div class="breadcrumb_iner_item">
                          <h2><?php echo $judulan; ?></h2>
                          <p>
                            <a href="<?php echo base_url(); ?>" class="text-white">Home</a>
                            <span>//</span>
                            <a href="<?php echo base_url(); ?>polling" class="text-white">Semua Polling</a>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <!-- SELESAI MINI IKLAN HEADER -->

              <!-- MULAI ISI -->
              <section class="blog_area section_padding">
                <div class="container">
                  <div class="row">
                    <div class="col-lg-8 mb-5 mb-lg-0">
                      <div class="blog_left_sidebar">
                        <div class="box-single-content clearfix" id="pagehead">
                          <h2><?php echo $judulan; ?></h2>
                          <p class="rs post-by"><?php echo $postingby; ?></p>
                          <div id="chart_div"></div></div>
                          <!-- AKHIR DARI SEMUA CERITA YANG PANJANG -->
                        <?php } ?>
                      </div>
                    </div>