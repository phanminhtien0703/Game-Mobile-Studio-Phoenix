<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/9599bda9420163a6.css') }}" data-precedence="next">
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/89c9f9bed05f369f.css') }}" data-precedence="next">
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/cfb18acb3accb3c3.css') }}" data-precedence="next">
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/c4fa705542f67be7.css') }}" data-precedence="next">
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/e6b54ef23715d9a1.css') }}" data-precedence="next">
    <link rel="stylesheet" href="{{ asset('assets/home/next/static/css/9706cae02c06bb94.css') }}" data-precedence="next">

    <!-- SEO Meta Tags -->
    <title>Game Mobile Studio - Phoenix | Cổng Game Online Hàng Đầu</title>
    <meta name="description" content="Công game online giải trí đa nền tảng với hàng trăm game hot, được cập nhật liên tục, đa dạng thể loại, từ giải trí nhẹ nhàng đến chiến thuật căng não. Chơi ngay mọi lúc mọi nơi.">
    <meta name="keywords" content="game mobile, game online, game phổ biến, game hot, game mới, game RPG, game action, game MMO">
    <meta name="robots" content="index, follow">
    <meta name="author" content="Game Mobile Studio">
    <meta name="theme-color" content="#1a1a1a">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ config('app.url') }}">
    
    <!-- Open Graph (Facebook, LinkedIn) -->
    <meta property="og:title" content="Game Mobile Studio - Phoenix | Cổng Game Online Hàng Đầu">
    <meta property="og:description" content="Công game online giải trí đa nền tảng với hàng trăm game hot, được cập nhật liên tục, đa dạng thể loại.">
    <meta property="og:url" content="{{ config('app.url') }}">
    <meta property="og:type" content="website">
    <meta property="og:image" content="{{ config('app.url') }}/images/og-image.jpg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:site_name" content="Game Mobile Studio - Phoenix">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Game Mobile Studio - Phoenix | Cổng Game Online Hàng Đầu">
    <meta name="twitter:description" content="Công game online giải trí đa nền tảng với hàng trăm game hot, được cập nhật liên tục.">
    <meta name="twitter:image" content="{{ config('app.url') }}/images/og-image.jpg">
    
    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" type="image/x-icon" sizes="32x32">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">
    
    @stack('styles')
</head>

<body class="__className_73ee6c">
    <next-route-announcer style="position: absolute;"></next-route-announcer>
    <div class="vplay-wrap" style="min-height: calc(-60px + 100vh);">
        <!-- Header with Menu -->
        <div class="mainheader py-4 px-2">
            <div class="left-header">
                <div class="sidenav">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="36" viewBox="0 0 30 36" fill="none">
                        <path d="M3.75 23.3773C3.75 22.7834 4.16973 22.3019 4.6875 22.3019H25.3125C25.8303 22.3019 26.25 22.7834 26.25 23.3773C26.25 23.9713 25.8303 24.4527 25.3125 24.4527H4.6875C4.16973 24.4527 3.75 23.9713 3.75 23.3773Z" fill="#292B2D"></path>
                        <path d="M3.75 16.9249C3.75 16.3309 4.16973 15.8494 4.6875 15.8494H25.3125C25.8303 15.8494 26.25 16.3309 26.25 16.9249C26.25 17.5188 25.8303 18.0003 25.3125 18.0003H4.6875C4.16973 18.0003 3.75 17.5188 3.75 16.9249Z" fill="#292B2D"></path>
                        <path d="M3.75 10.4724C3.75 9.87845 4.16973 9.39697 4.6875 9.39697H25.3125C25.8303 9.39697 26.25 9.87845 26.25 10.4724C26.25 11.0663 25.8303 11.5478 25.3125 11.5478H4.6875C4.16973 11.5478 3.75 11.0663 3.75 10.4724Z" fill="#292B2D"></path>
                    </svg>
                </div>
            </div>
            
            <!-- User Info / Login Button -->
            <div style="display: flex; align-items: center; gap: 15px;">
                @if(auth()->check())
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <div style="text-align: right;">
                            <div style="font-size: 14px; color: #333; font-weight: 600;">{{ auth()->user()->username }}</div>
                            <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: #3366FF; font-size: 12px; cursor: pointer; text-decoration: underline;">
                                    Đăng xuất
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" style="background: linear-gradient(135deg, #3366FF 0%, #0047AB 100%); color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-weight: 600; font-size: 14px; display: inline-block; white-space: nowrap;">
                        Đăng Nhập
                    </a>
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <div class="vplay-content" style="background: rgb(255, 255, 255);">
            <!-- Banner Section -->
            @if(isset($bannerGames))
                @include('layouts.home.banner')
            @endif

            <!-- Menu Section -->
            @include('layouts.home.menu')

            <!-- Dynamic Content -->
            @yield('content')
        </div>

        <!-- Bottom Navigation -->
        @include('layouts.home.bottom-nav')

        <!-- Footer -->
        @include('layouts.home.footer')
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        // Internal Navigation Handler - navigate to internal links in same tab
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a');
            if (!link) return;

            // Check for special cases to skip
            if (link.getAttribute('data-ajax') ||
                link.hasAttribute('target') ||
                link.hasAttribute('download') ||
                e.ctrlKey || 
                e.metaKey || 
                e.button === 1) {
                return; // Let default behavior handle it
            }

            const href = link.getAttribute('href');
            if (!href || href.startsWith('javascript:')) {
                return;
            }

            // Handle relative links
            if (href.startsWith('/') || href.startsWith('.')) {
                e.preventDefault();
                window.location.href = href;
                return;
            }

            // Handle absolute URLs from same domain
            if (href.startsWith('http')) {
                try {
                    const url = new URL(href);
                    const currentUrl = new URL(window.location.href);
                    
                    // If same domain and protocol, navigate in same tab
                    if (url.hostname === currentUrl.hostname && 
                        url.protocol === currentUrl.protocol) {
                        e.preventDefault();
                        window.location.href = url.pathname + url.search + url.hash;
                    }
                } catch (err) {
                    // Invalid URL, let default behavior handle it
                }
            }
        });

        // AJAX Navigation Handler - only for data-ajax links
        document.addEventListener('click', function(e) {
            const link = e.target.closest('a[data-ajax]');
            if (!link) return;

            e.preventDefault();
            const url = link.getAttribute('href');
            
            // Load content via AJAX
            fetch(url, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Find content container and update only that
                const contentDiv = document.querySelector('.vplay-content');
                
                // Create temporary wrapper to extract scripts
                const temp = document.createElement('div');
                temp.innerHTML = data.content;
                
                // Get all scripts from new content
                const scripts = temp.querySelectorAll('script');
                
                // Update only the content part (after banner and menu)
                const contentTarget = contentDiv.querySelector('[data-ajax-target], .vplay-content > *:last-child') 
                    || contentDiv;
                
                // Replace only the dynamic content, not header/menu
                const mainContent = contentDiv.querySelector('div[style*="min-height"]') 
                    || Array.from(contentDiv.children).find(el => 
                        el.style.padding === '20px' || el.className.includes('welfare') || el.className.includes('flex')
                    );
                
                if (mainContent) {
                    mainContent.parentNode.replaceChild(temp.firstChild, mainContent);
                } else {
                    contentDiv.innerHTML = data.content;
                }
                
                // Execute scripts from new content
                scripts.forEach(script => {
                    const newScript = document.createElement('script');
                    newScript.textContent = script.textContent;
                    contentDiv.appendChild(newScript);
                });
                
                // Dispatch custom event for carousels to reinitialize
                document.dispatchEvent(new Event('ajaxContentLoaded'));
                
                // Scroll to top
                window.scrollTo(0, 0);
            })
            .catch(error => {
                console.error('Error loading content via AJAX:', error);
                window.location.href = url; // Fallback to regular navigation
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Get current domain
            const currentDomain = window.location.hostname;
            
            // Open external links in appropriate app
            document.querySelectorAll("a[href^='http']").forEach(function(link) {
                const linkUrl = new URL(link.getAttribute('href'), window.location.href);
                
                // Only treat as external if domain is different
                if (linkUrl.hostname !== currentDomain) {
                    link.addEventListener("click", function(e) {
                        var url = link.getAttribute("href");
                        if (/Android/i.test(navigator.userAgent)) {
                            // Android -> mở bằng Chrome
                            window.location.href = "intent://" + url.replace(/^https?:\/\//, "") + "#Intent;scheme=https;package=com.android.chrome;end;";
                        } else if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
                            // iOS -> mở Safari
                            window.open(url, "_system");
                        } else {
                            // Máy khác mở bình thường
                            window.open(url, "_blank");
                        }
                        e.preventDefault();
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
