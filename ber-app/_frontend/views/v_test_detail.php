
  <!-- MULAI BERITA -->
  <section class="blog_area section_padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-8 mb-5 mb-lg-0">
          <div class="blog_left_sidebar">
            <style>
            .accordion {
              background-color: #eee;
              color: #444;
              cursor: pointer;
              padding: 18px;
              width: 100%;
              border: none;
              text-align: left;
              outline: none;
              font-size: 15px;
              transition: 0.4s;
            }

            .active, .accordion:hover {
              background-color: #ccc;
            }
            .panel {
              padding: 0 18px;
              display: none;
              background-color: white;
              overflow: hidden;
            }
          </style>

          <!-- CODENYA DISINI -->

          <!-- SELESAI CODENYA -->

            <script>
              var acc = document.getElementsByClassName("accordion");
              var i;
              for (i = 0; i < acc.length; i++) {
                acc[i].addEventListener("click", function() {
                  this.classList.toggle("active");
                  var panel = this.nextElementSibling;
                  if (panel.style.display === "block") {
                    panel.style.display = "none";
                  } else {
                    panel.style.display = "block";
                  }
                });
              }
            </script>
          </div>
        </div>