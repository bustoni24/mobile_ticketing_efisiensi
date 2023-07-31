<!DOCTYPE html>
<html lang="en" class="">
  <!-- Mirrored from ngorder.id/ by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 23 Mar 2022 05:38:07 GMT -->
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link type="text/css" href='<?= Constant::frontAsset() . "/css/main.css" ?>' rel='stylesheet'>
    <link type="text/css" href='<?= Constant::frontAssetUrl() . "/assets/vendor/boxicons/css/boxicons.min.css" ?>' rel='stylesheet'>

    <title data-react-helmet="true">Satu dashboard untuk kendali penuh jualan online dimanapun | <?= Constant::PROJECT_NAME; ?></title>

    <script data-gatsby="web-vitals-polyfill">
      !(function () {
        var e,
          t,
          n,
          i,
          r = { passive: !0, capture: !0 },
          a = new Date(),
          o = function () {
            (i = []), (t = -1), (e = null), f(addEventListener);
          },
          c = function (i, r) {
            e || ((e = r), (t = i), (n = new Date()), f(removeEventListener), u());
          },
          u = function () {
            if (t >= 0 && t < n - a) {
              var r = { entryType: "first-input", name: e.type, target: e.target, cancelable: e.cancelable, startTime: e.timeStamp, processingStart: e.timeStamp + t };
              i.forEach(function (e) {
                e(r);
              }),
                (i = []);
            }
          },
          s = function (e) {
            if (e.cancelable) {
              var t = (e.timeStamp > 1e12 ? new Date() : performance.now()) - e.timeStamp;
              "pointerdown" == e.type
                ? (function (e, t) {
                    var n = function () {
                        c(e, t), a();
                      },
                      i = function () {
                        a();
                      },
                      a = function () {
                        removeEventListener("pointerup", n, r), removeEventListener("pointercancel", i, r);
                      };
                    addEventListener("pointerup", n, r), addEventListener("pointercancel", i, r);
                  })(t, e)
                : c(t, e);
            }
          },
          f = function (e) {
            ["mousedown", "keydown", "touchstart", "pointerdown"].forEach(function (t) {
              return e(t, s, r);
            });
          },
          p = "hidden" === document.visibilityState ? 0 : 1 / 0;
        addEventListener(
          "visibilitychange",
          function e(t) {
            "hidden" === document.visibilityState && ((p = t.timeStamp), removeEventListener("visibilitychange", e, !0));
          },
          !0
        );
        o(),
          (self.webVitals = {
            firstInputPolyfill: function (e) {
              i.push(e), u();
            },
            resetFirstInputPolyfill: o,
            get firstHiddenTime() {
              return p;
            },
          });
      })();
    </script>

    <style>
      .gatsby-image-wrapper {
        position: relative;
        overflow: hidden;
      }
      .gatsby-image-wrapper img {
        bottom: 0;
        height: 100%;
        left: 0;
        margin: 0;
        max-width: none;
        padding: 0;
        position: absolute;
        right: 0;
        top: 0;
        width: 100%;
        object-fit: cover;
      }
      .gatsby-image-wrapper [data-main-image] {
        opacity: 0;
        transform: translateZ(0);
        transition: opacity 0.25s linear;
        will-change: opacity;
      }
      .gatsby-image-wrapper-constrained {
        display: inline-block;
        vertical-align: top;
      }
      html, body, .font-body{
        font-family: 'Poppins', sans-serif!important;
    }
    .color-secondary {
      background-color: #F9CF6B;
    }
    .logos {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2rem;
      font-weight: 700;
    }
    .custom-border{
      border: 1px solid #000;
      padding: 5px 10px;
      border-radius: 10px;
    }
    #hero-banner-0 {
      /* background-color: rgb(250, 219, 138) */
      background-color: #F4F0EB;
    }
    .main-title{
      font-size: 1.8rem;font-weight: 700;
    }
    .color-primary{
      color: rgba(13, 64, 144, var(--tw-bg-opacity));
    }
    #feature .showcase i{
      font-size: 6rem;
      background-color: #f4f0eb;
      min-height: 250px;
      display: flex;
      justify-content: center;
      align-items: center;
      /* color: #f9cf6d; */
    }
    #highlight1 .showcase i{
      font-size: 4rem;
      background-color: #f4f0eb;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }
    #highlight2 .showcase{
      background-color: #f4f0eb;
      padding: 1rem;
    }
    #highlight2 .showcase h2{
      font-size: 1.3rem;
      font-weight: 600;
    }
    #highlight1 .image, #highlight2 .image{
      min-width: 550px;
    }
    .md\:my-4 {
      margin-left: 1rem;
      margin-right: 1rem;
    }
    .gbi--221677373-xuftajYGdgi2LeuLzk3C1t:after {
      z-index: -1;
    }
    </style>
    <noscript>
      <style>
        .gatsby-image-wrapper noscript [data-main-image] {
          opacity: 1 !important;
        }
        .gatsby-image-wrapper [data-placeholder-image] {
          opacity: 0 !important;
        }
      </style>
    </noscript>
    <script type="module">
      const e = "undefined" != typeof HTMLImageElement && "loading" in HTMLImageElement.prototype;
      e &&
        document.body.addEventListener(
          "load",
          function (e) {
            if (void 0 === e.target.dataset.mainImage) return;
            if (void 0 === e.target.dataset.gatsbyImageSsr) return;
            const t = e.target;
            let a = null,
              n = t;
            for (; null === a && n; ) void 0 !== n.parentNode.dataset.gatsbyImageWrapper && (a = n.parentNode), (n = n.parentNode);
            const o = a.querySelector("[data-placeholder-image]"),
              r = new Image();
            (r.src = t.currentSrc),
              r
                .decode()
                .catch(() => {})
                .then(() => {
                  (t.style.opacity = 1), o && ((o.style.opacity = 0), (o.style.transition = "opacity 500ms linear"));
                });
          },
          !0
        );
    </script>
   
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <div id="___gatsby">
      <div style="outline: none" tabindex="-1" id="gatsby-focus-wrapper">
        <div class="flex flex-col min-h-screen font-body text-gray-800 dark:bg-gray-800 dark:text-gray-200">
          
          <header class="z-20 bg-white">
            <?= $this->renderPartial('/layouts/header'); ?>
          </header>
          <main class="flex-1 w-full">

          <?= $content; ?>

          </main>
          <footer class="bg-gray-50 dark:bg-gray-800 py-8 md:py-20">
            <nav class="flex flex-wrap md:flex-nowrap flex-col sm:flex-row justify-between max-w-6xl p-4 mx-auto text-sm md:space-x-10 border-b border-gray-200 dark:border-gray-600">
              <div class="w-full sm:w-1/2 md:w-1/5 flex flex-col mb-5">
              </div>
            </nav>
            
          </footer>
        </div>
      </div>
      <div id="gatsby-announcer" style="position: absolute; top: 0; width: 1px; height: 1px; padding: 0; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0" aria-live="assertive" aria-atomic="true"></div>
    </div>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="<?= Constant::baseJsUrl().'/jquery-2.1.0.min.js'; ?>"></script>
    <script src="<?= Constant::baseJsUrl().'/jquery-migrate.js'; ?>"></script>
    <script>
      if (typeof frontFunction === "function") {
        frontFunction();
      }
    </script>

<script>
            /*   function frontFunction(){ 
                  $('.harga').on('click', function(e){
                  e.preventDefault();
                    swal({
                      title: "Good job!",
                      text: "You clicked the button!",
                      icon: "success",
                      button: "Aww yiss!",
                    });
                });
              } */
    $("#navbar-header a").click(function() {
      var el = $(this).attr('data-href');
        $('html, body').animate({
            scrollTop: $(el).offset().top
        }, 1000);
    });
    </script>
  </body>
</html>
