<header id="main-header" class="fixed top-0 left-0 w-full z-50 transition-all duration-300 bg-transparent text-white py-4">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 flex items-center justify-between">
        
        <a href="{{ route('home') }}" class="flex items-center gap-3 group shrink-0">
            <img src="{{ asset('images/doan.png') }}" 
                 alt="Logo Đoàn" 
                 class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110 drop-shadow-sm">
            
            <img src="{{ asset('images/tnvn.png') }}" 
                 alt="Logo Hội LHTN" 
                 class="h-10 w-auto object-contain transition-transform duration-300 group-hover:scale-110 drop-shadow-sm">

            <span class="text-2xl font-bold tracking-tighter uppercase group-hover:text-cyan-400 transition-colors ml-1 shadow-black drop-shadow-md">
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
            
            <div class="hidden md:block relative group">
                <input type="text" 
                       placeholder="Tìm kiếm..." 
                       class="bg-white/10 border border-current/30 text-current placeholder-current/60 rounded-full py-2 pl-4 pr-10 focus:outline-none focus:bg-white/20 focus:w-64 w-48 transition-all duration-300 text-sm backdrop-blur-sm">
                
                <button class="absolute right-3 top-1/2 -translate-y-1/2 text-current/80 hover:text-cyan-400 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
            </div>

            <button id="mobile-menu-btn" class="lg:hidden flex flex-col gap-1.5 p-2 rounded hover:bg-white/10">
                <span class="w-6 h-0.5 bg-current transition-all"></span>
                <span class="w-6 h-0.5 bg-current transition-all"></span>
                <span class="w-6 h-0.5 bg-current transition-all"></span>
            </button>
        </div>
    </div>
</header>

<div id="mobile-menu-overlay" class="fixed inset-0 bg-slate-900/95 z-[60] transform translate-x-full transition-transform duration-300 backdrop-blur-sm flex flex-col justify-center items-center hidden">
    <button id="close-mobile-menu" class="absolute top-6 right-6 text-white p-2">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
    </button>
    
    <nav class="flex flex-col items-center gap-8 text-white text-xl font-bold uppercase tracking-widest">
        <a href="#explore" class="hover:text-cyan-400 transition-colors mobile-link">Về Phước Hải</a>
        <a href="#location-highlights" class="hover:text-cyan-400 transition-colors mobile-link">Điểm đến nổi bật</a>
        <a href="#categories" class="hover:text-cyan-400 transition-colors mobile-link">Khám phá</a>
        <a href="#contact" class="hover:text-cyan-400 transition-colors mobile-link">Liên hệ</a>
    </nav>

    <div class="mt-12 w-3/4 max-w-sm relative">
        <input id="mobile-search-input" type="text" placeholder="Tìm kiếm..." class="w-full bg-white/10 border border-white/20 rounded-full py-3 px-6 text-white placeholder-gray-400 outline-none focus:border-cyan-400">
        <button id="mobile-search-btn" class="absolute right-4 top-3 text-gray-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </button>
    </div>
</div>
<script src="{{ asset('js/header.js') }}"></script>