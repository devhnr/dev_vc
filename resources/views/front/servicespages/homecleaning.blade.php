@include('front.includes.header')
<style>
    .our-register{
        top: 153px;
        padding: 0 !important;
        padding-bottom: 120px;
    }
    
    .fixed-sub-header {
      position: fixed;
      top: 93px;
      width: 100%;
      height: 50px;
      background-color: #ffc107;
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 1040;
    }

    #stickyBox {
      position: sticky;
      top: 110px; /* Same as the height of the fixed sections */
      background-color: #f8f9fa;
      padding: 15px;
      border: 1px solid #dee2e6;
    }
</style>
<section class="our-register">
    <div class="fixed-sub-header">
        Fixed Sub-Header
    </div>
    <div class="container">
        <div class="row">
            <div class="col-7">
                <h2>Main Content</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod, nisl nec aliquam tincidunt, nunc lorem pretium massa, at ultrices felis ligula nec ligula.</p>
                <p>Scroll down to see the sticky effect.</p>
                <p>Content filler...</p>
                <p style="height: 1200px;">More scrolling content in left column</p>
            </div>

            <div class="col-5">
                <div id="stickyBox">
                <h5>Sticky Sidebar</h5>
                <p>This box stays sticky until the footer is reached.</p>
                <p>More sticky content here...</p>
                </div>
            </div>
        </div>
    </div>
</section>
@include('front.includes.footer')

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const stickyBox = document.getElementById("stickyBox");
      const footer = document.querySelector(".footer-style1");

      function onScroll() {
        const footerTop = footer.getBoundingClientRect().top;
        const stickyHeight = stickyBox.offsetHeight;
        const topOffset = 110; // header (60) + sub-header (50)

        if (footerTop <= stickyHeight + topOffset + 20) {
          stickyBox.style.position = "absolute";
          stickyBox.style.top = (footer.offsetTop - stickyHeight - 20) + "px";
        } else {
          stickyBox.style.position = "sticky";
          stickyBox.style.top = topOffset + "px";
        }
      }

      window.addEventListener("scroll", onScroll);
    });
  </script>
