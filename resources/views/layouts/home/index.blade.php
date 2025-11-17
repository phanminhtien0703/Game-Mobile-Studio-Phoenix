<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/9599bda9420163a6.css') }}" data-precedence="next">
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/89c9f9bed05f369f.css') }}" data-precedence="next">
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/cfb18acb3accb3c3.css') }}" data-precedence="next">
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/c4fa705542f67be7.css') }}" data-precedence="next">
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/e6b54ef23715d9a1.css') }}" data-precedence="next">
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/9706cae02c06bb94.css') }}" data-precedence="next">

    <!-- Swiper CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="{{ asset('assets/home/next/static/chunks/677-46c0ad6c1f688d12.js') }}"></script>

    <!-- Title & Description -->
    <title>@yield('title', 'Game Mobile Studio - Phoenix ')</title>
    <meta name="description" content="@yield('description', 'Cổng game online giải trí đa nền tảng với hàng trăm game hot, được cập nhật liên tục, đa dạng thể loại, từ giải trí nhẹ nhàng đến chiến thuật căng não. Chơi ngay mọi lúc mọi nơi, có thể chơi trực tuyến trên website hoặc tải về mobile')">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', 'Game Mobile Studio - Phoenix ')" />
    <meta property="og:description" content="@yield('og_description', 'Cổng game online giải trí đa nền tảng với hàng trăm game hot, được cập nhật liên tục, đa dạng thể loại, từ giải trí nhẹ nhàng đến chiến thuật căng não. Chơi ngay mọi lúc mọi nơi, có thể chơi trực tuyến trên website hoặc tải về mobile')" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />
    <meta property="og:image" content="https://gamemobilestudio.cloud/images/pattern-bg.png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:title" content="@yield('twitter_title', 'Game Mobile Studio - Phoenix ')" />
    <meta name="twitter:description" content="@yield('twitter_description', 'Cổng game online giải trí đa nền tảng với hàng trăm game hot, được cập nhật liên tục, đa dạng thể loại, từ giải trí nhẹ nhàng đến chiến thuật căng não. Chơi ngay mọi lúc mọi nơi, có thể chơi trực tuyến trên website hoặc tải về mobile')" />
    <meta name="twitter:image" content="https://gamemobilestudio.cloud/images/pattern-bg.png" />

    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon" sizes="32x32">

    @stack('styles')

    <!-- Google Analytics & Tracking -->
    <script async="" src="https://www.googletagmanager.com/gtm.js?id=GTM-MWFF33CD"></script>
    <script src="{{ asset('assets/home/next/static/chunks/4bd1b696-34f60fd1602ffd77.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/684-980638f1a16870ba.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/main-app-3d980069dc484626.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/13b76428-1947e09b2321d766.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/942-f236060eb57babbb.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/540-e4e7117341beb0d8.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/677-46c0ad6c1f688d12.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/834-5e0b4e9522161a72.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/8-69d550d6642d40ee.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/180-6edbd74b11f0381b.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/353-2652e9daa7ff0ad7.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/app/layout-e2b4dd16cdb9c597.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/app/error-abb8551c2bbac876.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/app/not-found-9399bebdca6b9b4a.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/269-2f9324847535515e.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/212-21a0659bf8f85467.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/app/page-8872851b956d2833.js') }}" async=""></script>
    <script src="{{ asset('assets/home/next/static/chunks/app/download-flow.js') }}" async=""></script>

    <script>
        (self.__next_s = self.__next_s || []).push(["https://www.googletagmanager.com/gtag/js?id=G-QWZDCG2D5J", {
            "async": true
        }])
    </script>
    <script>
        (self.__next_s = self.__next_s || []).push([0, {
            "children": "\n            window.dataLayer = window.dataLayer || []; \n            function gtag(){window.dataLayer.push(arguments)}\n            gtag('js', new Date());\n            gtag('config', 'G-QWZDCG2D5J'); ",
            "id": "gtagJsScript"
        }])
    </script>
    <script>
        (self.__next_s = self.__next_s || []).push([0, {
            "children": "\n            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MWFF33CD');\n          ",
            "id": "gtagManagerScript"
        }])
    </script>
    <script>
        (self.__next_s = self.__next_s || []).push([0, {
            "children": "\n            (function(h,o,t,j,a,r){h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};h._hjSettings={hjid:5262487,hjsv:6};a=o.getElementsByTagName('head')[0];r=o.createElement('script');r.async=1;r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;a.appendChild(r);})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');\n          ",
            "id": "hotJarScript"
        }])
    </script>
    <script src="{{ asset('assets/home/next/static/chunks/polyfills-42372ed130431b0a.js') }}" nomodule=""></script>
    <script async="true" src="https://www.googletagmanager.com/gtag/js?id=G-QWZDCG2D5J"></script>
    <script id="gtagJsScript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            window.dataLayer.push(arguments)
        }
        gtag('js', new Date());
        gtag('config', 'G-QWZDCG2D5J');
    </script>
    <script id="gtagManagerScript">
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = 'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-MWFF33CD');
    </script>
    <script id="hotJarScript">
        (function(h, o, t, j, a, r) {
            h.hj = h.hj || function() {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {
                hjid: 5262487,
                hjsv: 6
            };
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    <script async="" src="https://static.hotjar.com/c/hotjar-5262487.js?sv=6"></script>
    <script>
        (self.__next_s = self.__next_s || []).push(["https://www.googletagmanager.com/gtag/js?id=G-QWZDCG2D5J", {
            "async": true
        }])
    </script>
    <script>
        (self.__next_s = self.__next_s || []).push([0, {
            "children": "\n            window.dataLayer = window.dataLayer || []; \n            function gtag(){window.dataLayer.push(arguments)}\n            gtag('js', new Date());\n            gtag('config', 'G-QWZDCG2D5J'); ",
            "id": "gtagJsScript"
        }])
    </script>
    <script>
        (self.__next_s = self.__next_s || []).push([0, {
            "children": "\n            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src='https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);})(window,document,'script','dataLayer','GTM-MWFF33CD');\n          ",
            "id": "gtagManagerScript"
        }])
    </script>
    <noscript></noscript>
    <script>
        (self.__next_s = self.__next_s || []).push([0, {
            "children": "\n            (function(h,o,t,j,a,r){h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};h._hjSettings={hjid:5262487,hjsv:6};a=o.getElementsByTagName('head')[0];r=o.createElement('script');r.async=1;r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;a.appendChild(r);})(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');\n          ",
            "id": "hotJarScript"
        }])
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-MR75NX67PE"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-MR75NX67PE');
    </script>
</head>

<body class="__className_73ee6c">
    <script src="{{ asset('assets/home/next/static/chunks/webpack-610916eae6fea10f.js') }}" async=""></script>
    <script>
        (self.__next_f = self.__next_f || []).push([0])
    </script>

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MWFF33CD"
                height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>

    <next-route-announcer style="position: absolute;"></next-route-announcer>

    <div class="vplay-wrap" style="min-height: calc(-60px + 100vh);">
        <!-- Header -->
        @include('layouts.home.header')

        <!-- Content -->
        <div class="vplay-content" style="background: rgb(255, 255, 255);">
            @yield('content')
        </div>

        <!-- Footer -->
        @include('layouts.home.footer')

        <!-- Bottom Navigation -->
        @include('layouts.home.bottom-nav')
    </div>

    <!-- Scripts -->
    @stack('scripts')

    <script>
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll("a[href^='http']").forEach(function(link) {
                link.addEventListener("click", function(e) {
                    var url = link.getAttribute("href");
                    if (/Android/i.test(navigator.userAgent)) {
                        window.location.href = "intent://" + url.replace(/^https?:\/\//, "") + "#Intent;scheme=https;package=com.android.chrome;end;";
                    } else if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
                        window.open(url, "_system");
                    } else {
                        window.open(url, "_blank");
                    }
                    e.preventDefault();
                });
            });
        });
    </script>
</body>
</html>
