<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>FinTrack</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style> 
        body { font-family: 'Plus Jakarta Sans', sans-serif; } 
        .tooltip-text {
            visibility: hidden;
            background-color: #1e293b; /* slate-800 */
            color: #fff;
            text-align: center; border-radius: 6px;
            padding: 5px 10px; position: fixed;
            z-index: 100; opacity: 0;
            transition: opacity 0.2s; white-space: nowrap;
            pointer-events: none;
        }
        .tooltip-text.visible { visibility: visible; opacity: 1; }
    </style>
</head>
<body class="h-full overflow-hidden bg-white">
    <div class="h-full flex flex-col">
        <main class="flex-grow overflow-y-auto bg-slate-50">
            @yield('content')
        </main>
        <div class="flex-shrink-0">
            @include('components.mobile-bottom-nav')
        </div>
    </div>

    {{-- ====================================================== --}}
    {{--    JAVASCRIPT BARU (BISA UNTUK MOUSE & LAYAR SENTUH)    --}}
    {{-- ====================================================== --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const navLinks = document.querySelectorAll('.nav-link-tooltip');
            let tooltipTimeout;

            // Buat satu elemen tooltip untuk dipakai ulang
            const tooltipElement = document.createElement('div');
            tooltipElement.className = 'tooltip-text';
            document.body.appendChild(tooltipElement);
            
            // Fungsi untuk menampilkan tooltip
            const showTooltip = (link) => {
                const tooltipText = link.getAttribute('data-tooltip');
                if (tooltipText) {
                    tooltipElement.textContent = tooltipText;
                    const linkRect = link.getBoundingClientRect();
                    tooltipElement.style.left = `${linkRect.left + linkRect.width / 2}px`;
                    tooltipElement.style.top = `${linkRect.top - 10}px`;
                    tooltipElement.style.transform = 'translate(-50%, -100%)';
                    tooltipElement.classList.add('visible');
                }
            };

            // Fungsi untuk menyembunyikan tooltip
            const hideTooltip = () => {
                clearTimeout(tooltipTimeout);
                tooltipElement.classList.remove('visible');
            };

            navLinks.forEach(link => {
                // Mencegah menu konteks (klik kanan) muncul di HP
                link.addEventListener('contextmenu', e => e.preventDefault());

                // --- Untuk Layar Sentuh (Tekan Lama) ---
                link.addEventListener('touchstart', () => {
                    tooltipTimeout = setTimeout(() => showTooltip(link), 400); 
                });
                link.addEventListener('touchend', hideTooltip);
                link.addEventListener('touchcancel', hideTooltip);

                // --- Untuk Komputer/Mouse (Hover) ---
                link.addEventListener('mouseenter', () => showTooltip(link));
                link.addEventListener('mouseleave', hideTooltip);
            });
        });
    </script>
</body>
</html>
