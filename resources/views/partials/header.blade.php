<header id="main-header" class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-transparent text-white lg:py-2">
    <div class="max-w-7xl mx-auto px-4 lg:px-8 flex items-center justify-between relative">
        
        <button id="mobile-menu-btn" class="lg:hidden p-2 text-current hover:text-cyan-400 transition-colors focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
            </svg>
        </button>

        <a href="/" class="flex items-center justify-center lg:justify-start gap-2 lg:gap-3 group shrink-0 flex-1 lg:flex-none">
            <img src="{{ asset('images/doan.png') }}" alt="Logo Đoàn" class="h-8 lg:h-10 w-auto object-contain">
            <img src="{{ asset('images/tnvn.png') }}" alt="Logo Hội LHTN" class="h-7 lg:h-9 w-auto object-contain">
            <span class="text-xl lg:text-2xl font-bold tracking-tighter uppercase group-hover:text-cyan-400 transition-colors shadow-black drop-shadow-md">
                Phước Hải
            </span>
        </a>

        <nav class="hidden lg:flex items-center gap-6 xl:gap-8">
            <a href="#explore" class="text-sm font-semibold uppercase tracking-wide hover:text-cyan-400 transition-colors">Về Phước Hải</a>
            <a href="#location-highlights" class="text-sm font-semibold uppercase tracking-wide hover:text-cyan-400 transition-colors">Điểm đến nổi bật</a>
            <a href="#categories" class="text-sm font-semibold uppercase tracking-wide hover:text-cyan-400 transition-colors">Khám phá</a>
            <a href="#contact" class="text-sm font-semibold uppercase tracking-wide hover:text-cyan-400 transition-colors">Liên hệ</a>
        </nav>

        <div class="flex items-center gap-4">
            <div class="hidden lg:block relative group">
                <input type="text" 
                    placeholder="Tìm kiếm..." 
                    class="bg-white/10 border border-current/30 text-current placeholder-current/60 rounded-full py-2 pl-4 pr-10 
                            w-48 focus:w-72 
                            focus:outline-none focus:bg-white/20 
                            transition-all duration-300 ease-in-out text-sm backdrop-blur-sm">
                
                <button class="absolute right-3 top-1/2 -translate-y-1/2 text-current/80 hover:text-cyan-400 transition-colors pointer-events-none">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>

            <button id="mobile-search-trigger" class="lg:hidden p-2 text-current hover:text-cyan-400 transition-colors focus:outline-none shrink-0">
                 <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
        </div>
    </div>

    <div id="mobile-search-bar" class="absolute top-full left-0 w-full bg-white text-slate-900 shadow-xl origin-top transition-all duration-300 transform scale-y-0 opacity-0 lg:hidden overflow-hidden">
        <div class="p-2 border-t border-gray-100">
            <div class="relative max-w-md mx-auto">
                <input id="mobile-search-bar-input" type="text" placeholder="Tìm kiếm..." 
                       class="w-full bg-slate-100 border border-slate-200 rounded-full py-2.5 pl-5 pr-12 text-slate-800 focus:outline-none focus:bg-white focus:border-cyan-500 transition-colors shadow-inner">
                <button class="absolute right-2 top-1/2 -translate-y-1/2 p-1.5 text-slate-500 hover:text-cyan-600 bg-white rounded-full shadow-sm hover:shadow transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </button>
            </div>
        </div>
    </div>
</header>

<div id="mobile-menu-overlay" class="fixed inset-0 bg-slate-900/95 z-[60] transform -translate-x-full transition-transform duration-300 backdrop-blur-sm flex flex-col justify-center items-center hidden">
    <a href="/" class="absolute top-6 left-6 flex items-center gap-3 text-white hover:text-cyan-400 transition-colors z-10">
        <img src="{{ asset('images/doan.png') }}" alt="Logo Đoàn" class="h-8 w-auto object-contain">
        <img src="{{ asset('images/tnvn.png') }}" alt="Logo Hội LHTN" class="h-7 w-auto object-contain">
        <span class="text-xl font-bold tracking-tighter uppercase shadow-black drop-shadow-md">
            Phước Hải
        </span>
    </a>

    <button id="close-mobile-menu" class="absolute top-4 right-6 text-white p-2 hover:text-cyan-400 transition-colors z-10">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
    
    <nav class="flex flex-col items-center gap-8 text-white text-xl font-bold uppercase tracking-widest">
        <a href="#explore" class="hover:text-cyan-400 transition-colors mobile-link">Về Phước Hải</a>
        <a href="#location-highlights" class="hover:text-cyan-400 transition-colors mobile-link">Điểm đến nổi bật</a>
        <a href="#categories" class="hover:text-cyan-400 transition-colors mobile-link">Khám phá</a>
        <a href="#contact" class="hover:text-cyan-400 transition-colors mobile-link">Liên hệ</a>
    </nav>
</div>
<script src="{{ asset('js/header.js') }}"></script>