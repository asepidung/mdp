<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $settings['meta_title'] ?? 'Mbok Dewor Puding - Premium F&B Dessert' }}</title>
  <meta name="description" content="{{ $settings['meta_description'] ?? 'Sempurnakan Momen Spesialmu dengan Kelembutan Puding Mbok Dewor. Puding premium susu asli dengan kualitas rasa premium & kemasan elegan.' }}">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">

  <!-- Google Fonts: Poppins (Mandatory) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,600&display=swap" rel="stylesheet">

  <!-- AOS CSS for Scroll Animations -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand: {
              cream: '#FAFAFA',       // Vanilla light background
              creamDark: '#F3EFE9',   // Accent cream for contrast
              gold: '#D97706',        // Caramel Gold primary
              goldDark: '#B45309',    // Caramel Hover Gold
              chocolate: '#1F1109',   // Deep dark chocolate text
              chocolateLight: '#4A3525' // Subtitle text
            }
          },
          fontFamily: {
            sans: ['Poppins', 'sans-serif'],
          }
        }
      }
    }
  </script>

  <!-- Custom Stylesheet -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

  <!-- Alpine.js CDN (Replacing Custom Vanilla JS for cleaner CMS integration) -->
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

  <style>
    [x-cloak] { display: none !important; }
  </style>
</head>
<body x-data="{ lightboxOpen: false, lightboxImage: '' }" class="bg-brand-cream text-brand-chocolate min-h-screen overflow-x-hidden antialiased">

    <!-- Header / Navbar (Alpine.js State) -->
  <header x-data="{ mobileMenuOpen: false, scrolled: false }" 
          @scroll.window="scrolled = (window.pageYOffset > 20)"
          :class="scrolled ? 'nav-scrolled py-2' : 'bg-transparent py-4'"
          class="fixed top-0 inset-x-0 z-50 transition-all duration-300 border-b border-transparent"
          data-aos="fade-down" data-aos-duration="800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex justify-between items-center">
        
        <!-- Logo -->
        <a href="#" class="flex items-center gap-3 group">
                    <img src="{{ asset('assets/img/logo.png') }}" alt="Mbok Dewor Puding Logo" class="h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105">
                    <div class="flex flex-col">
                        <span class="text-base md:text-lg font-extrabold tracking-tight text-brand-chocolate leading-none">Mbok Dewor</span>
                        <span class="text-[9px] uppercase tracking-widest text-brand-gold font-bold">Premium Dessert</span>
          </div>
        </a>

        
          

        <!-- Desktop Menu -->
        <nav class="hidden md:flex items-center space-x-8">
                    <a href="#beranda" class="font-medium text-brand-chocolate hover:text-brand-gold transition-colors duration-200">Beranda</a>
          <a href="#tentang" class="font-medium text-brand-chocolate hover:text-brand-gold transition-colors duration-200">Tentang Kami</a>
          <a href="#menu" class="font-medium text-brand-chocolate hover:text-brand-gold transition-colors duration-200">Galeri</a>
          <a href="#testimoni" class="font-medium text-brand-chocolate hover:text-brand-gold transition-colors duration-200">Testimoni</a>
          <a href="#kontak" class="font-medium text-brand-chocolate hover:text-brand-gold transition-colors duration-200">Kontak</a>
                  </nav>

        <!-- Mobile Menu Toggle Button -->
        <div class="flex items-center md:hidden">
          <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" 
                  class="inline-flex items-center justify-center p-2.5 rounded-xl text-brand-chocolate hover:bg-brand-creamDark focus:outline-none transition-colors duration-200"
                  aria-label="Toggle Menu">
            <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="mobileMenuOpen" x-cloak class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>

      </div>
    </div>

    <!-- Mobile Drawer -->
    <div x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         x-cloak
         class="md:hidden bg-white/95 backdrop-blur-lg border-b border-brand-creamDark px-4 pt-2 pb-6 space-y-2 absolute w-full shadow-xl">
            <a @click="mobileMenuOpen = false" href="#beranda" class="block px-4 py-2.5 rounded-xl font-medium text-brand-chocolate hover:bg-brand-creamDark transition-all">Beranda</a>
      <a @click="mobileMenuOpen = false" href="#tentang" class="block px-4 py-2.5 rounded-xl font-medium text-brand-chocolate hover:bg-brand-creamDark transition-all">Tentang Kami</a>
      <a @click="mobileMenuOpen = false" href="#menu" class="block px-4 py-2.5 rounded-xl font-medium text-brand-chocolate hover:bg-brand-creamDark transition-all">Menu Bento</a>
      <a @click="mobileMenuOpen = false" href="#testimoni" class="block px-4 py-2.5 rounded-xl font-medium text-brand-chocolate hover:bg-brand-creamDark transition-all">Ulasan</a>
      <a @click="mobileMenuOpen = false" href="#kontak" class="block px-4 py-2.5 rounded-xl font-medium text-brand-chocolate hover:bg-brand-creamDark transition-all">Kontak</a>
            <div class="pt-4 border-t border-brand-creamDark">
        <a href="https://wa.me/62{{ ltrim($settings['whatsapp_number'] ?? '081335374099', '0') }}" 
           target="_blank"
           class="flex items-center justify-center w-full py-3.5 rounded-full bg-brand-gold text-white font-semibold shadow-md gap-2">
          <span>Pesan via WhatsApp</span>
        </a>
      </div>
    </div>
  </header>
  
  <main id="beranda" class="pt-24 md:pt-32">
        <!-- Hero Section -->
    <section class="relative pb-20 md:pb-32 overflow-hidden">
      <!-- Fluid background shapes for modern look -->
      <div class="absolute -top-24 -left-20 w-80 h-80 bg-brand-gold/10 rounded-full blur-3xl opacity-60"></div>
      <div class="absolute top-1/2 -right-32 w-96 h-96 bg-amber-200/20 rounded-full blur-3xl opacity-40 animate-pulse"></div>

      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
          
          <!-- Text Content -->
          <div class="lg:col-span-7 text-center lg:text-left flex flex-col items-center lg:items-start z-10" data-aos="fade-right" data-aos-duration="1000">
            
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-creamDark/60 border border-brand-creamDark text-brand-gold font-bold text-xs uppercase tracking-widest mb-6">
              <span class="w-1.5 h-1.5 rounded-full bg-brand-gold animate-ping"></span>
              F&B Premium Artisan Pudding
            </div>

                        <h1 class="text-4xl sm:text-5xl md:text-6xl font-black tracking-tight text-brand-chocolate leading-[1.15] mb-6">
              {{ $settings['hero_title'] ?? 'Sempurnakan Momen Spesialmu dengan Kelembutan Puding Mbok Dewor.' }}
            </h1>
            
                        <p class="text-sm sm:text-base md:text-lg text-brand-chocolateLight max-w-xl mb-10 leading-relaxed font-light">
                {{ $settings['hero_description'] ?? 'Sensasi dessert lumer berkelas dunia yang dibuat secara higienis menggunakan susu segar murni dan bahan organik premium. Tekstur selembut sutra yang siap memanjakan setiap suapan.' }}
              </p>
            
            <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">
                            <a href="https://wa.me/62{{ ltrim($settings['whatsapp_number'] ?? '081335374099', '0') }}" 
                 target="_blank"
                 class="inline-flex items-center justify-center px-8 py-4 rounded-full bg-brand-gold hover:bg-brand-goldDark text-white font-bold transition-all duration-300 shadow-lg hover:shadow-brand-gold/30 hover:shadow-2xl transform hover:-translate-y-1 gap-2.5 text-sm md:text-base group">
                <span>Pesan Sekarang</span>
                <svg class="w-5 h-5 fill-current transform group-hover:translate-x-1 transition-transform" viewBox="0 0 24 24">
                  <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
                </svg>
              </a>
                            <a href="#menu" 
                 class="inline-flex items-center justify-center px-8 py-4 rounded-full bg-white hover:bg-brand-creamDark text-brand-chocolate border border-brand-creamDark font-bold transition-all duration-300 shadow-sm hover:shadow-md transform hover:-translate-y-1 text-sm md:text-base">
                Explore Menu
              </a>
            </div>

          </div>

          <!-- Visual Showcase -->
          <div class="lg:col-span-5 flex justify-center lg:justify-end z-10 mt-12 lg:mt-0" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="200">
            <div class="relative w-72 h-72 sm:w-96 sm:h-96 md:w-[440px] md:h-[440px]">
              <!-- Glassmorphic framing backdrop -->
              <div class="absolute -inset-4 bg-white/40 backdrop-blur-sm rounded-[2.5rem] border border-white/60 -rotate-3 shadow-xl transition-transform duration-700 hover:rotate-0"></div>
              <!-- Gold solid backup card -->
              <div class="absolute inset-2 bg-gradient-to-tr from-brand-gold/30 to-amber-200/40 rounded-[2.5rem] rotate-3 shadow-lg transition-transform duration-700 hover:rotate-0"></div>
              
                              @if(!empty($settings['hero_image']))
                  <img src="{{ Storage::url($settings['hero_image']) }}" alt="Puding Mewah Mbok Dewor" class="absolute inset-0 w-full h-full object-cover rounded-[2.5rem] shadow-2xl border-4 border-white transition-transform duration-700 hover:scale-[1.02]">
                @endif
                            
              <!-- Premium Badge Floating -->
              <div class="absolute top-6 right-6 bg-white/90 backdrop-blur-md px-4 py-2 rounded-2xl shadow-lg border border-white flex items-center gap-2 animate-bounce">
                <span class="text-brand-gold text-lg">⭐</span>
                <span class="text-[10px] font-bold text-brand-chocolate tracking-wider uppercase">{{ $settings['hero_badge'] ?? 'Premium Quality' }}</span>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>
    
        <!-- Tentang Kami -->
    <section id="tentang" class="py-20 bg-brand-creamDark/30 border-y border-brand-creamDark/60 relative overflow-hidden">
      <!-- Decorative circle -->
      <div class="absolute -right-40 bottom-0 w-96 h-96 border-[40px] border-white/50 rounded-full blur-sm opacity-50"></div>
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
          
          <!-- Video Player Left -->
          <div class="relative w-full rounded-[2rem] overflow-hidden shadow-2xl border border-brand-creamDark/50 group" data-aos="fade-up" data-aos-delay="100">
            <div class="absolute inset-0 bg-brand-gold/10 rounded-[2rem] blur-2xl -z-10"></div>
            <video 
              class="w-full h-auto max-h-[500px] object-cover rounded-[2rem] transform transition-transform duration-700 group-hover:scale-105"
              autoplay 
              loop 
              muted 
              playsinline>
              <source src="{{ asset('assets/videos/video.mp4') }}" type="video/mp4">
              Browser Anda tidak mendukung tag video.
            </video>
            
            <!-- Subtle overlay gradient -->
            <div class="absolute inset-0 bg-gradient-to-t from-brand-chocolate/40 to-transparent pointer-events-none rounded-[2rem]"></div>
          </div>

          <!-- Content Right -->
          <div data-aos="fade-left" data-aos-duration="1000">
            <span class="text-xs font-bold text-brand-gold uppercase tracking-widest block mb-3">Filosofi Rasa</span>
                        <h2 class="text-3xl md:text-4xl font-black text-brand-chocolate leading-tight mb-6">
              {{ $settings['about_title'] ?? 'Dibuat dengan Bahan Susu Premium Pilihan & Penuh Kasih Sayang' }}
            </h2>
                        
            <div class="space-y-4 text-sm sm:text-base text-brand-chocolateLight leading-relaxed mb-10 font-light">
                            {{ $settings['about_text'] ?? 'Setiap puding dari Mbok Dewor dibuat secara eksklusif (artisan).' }}
                          </div>

            <!-- Occasions grid cards -->
            <div class="grid grid-cols-3 gap-4">
              <div class="p-4 bg-white/80 backdrop-blur rounded-2xl shadow-sm border border-brand-creamDark hover:shadow-md transition-shadow text-center group">
                <span class="text-2xl block mb-2 transform group-hover:scale-125 transition-transform duration-300">🎂</span>
                <span class="text-[10px] sm:text-xs font-bold text-brand-chocolate uppercase tracking-wide">Ulang Tahun</span>
              </div>
              <div class="p-4 bg-white/80 backdrop-blur rounded-2xl shadow-sm border border-brand-creamDark hover:shadow-md transition-shadow text-center group">
                <span class="text-2xl block mb-2 transform group-hover:scale-125 transition-transform duration-300">💝</span>
                <span class="text-[10px] sm:text-xs font-bold text-brand-chocolate uppercase tracking-wide">Hantaran</span>
              </div>
              <div class="p-4 bg-white/80 backdrop-blur rounded-2xl shadow-sm border border-brand-creamDark hover:shadow-md transition-shadow text-center group">
                <span class="text-2xl block mb-2 transform group-hover:scale-125 transition-transform duration-300">🎉</span>
                <span class="text-[10px] sm:text-xs font-bold text-brand-chocolate uppercase tracking-wide">Perayaan</span>
              </div>
            </div>

          </div>

        </div>
      </div>
    </section>
    
        <!-- Menu / Gallery Section (Bento Grid) -->
    <section id="menu" class="py-20 md:py-28 relative">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
          <span class="text-xs font-bold text-brand-gold uppercase tracking-widest block mb-3">Signature Menu</span>
                    <h2 class="text-3xl md:text-4xl font-black text-brand-chocolate">Galeri Kreasi Puding</h2>
                    <div class="w-16 h-1.5 bg-brand-gold mx-auto mt-6 rounded-full"></div>
        </div>

        <!-- Modern Bento Grid with CMS Safeguards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          
          @forelse($products as $product)
          <div class="group bg-white rounded-[2rem] p-3 border border-brand-creamDark/50 shadow-sm hover:shadow-2xl transition-all duration-500 flex flex-col h-full hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
            <div class="overflow-hidden rounded-3xl w-full relative">
              <img src="{{ $product->image_path ? Storage::url($product->image_path) : asset('assets/img/puding-1.jpg') }}" alt="{{ $product->name }}" class="w-full aspect-square object-cover rounded-3xl transform group-hover:scale-110 transition-transform duration-700">
              <div class="absolute inset-0 bg-brand-chocolate/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center backdrop-blur-[2px]">
                <button type="button" @click.prevent="lightboxOpen = true; lightboxImage = '{{ $product->image_path ? Storage::url($product->image_path) : asset('assets/img/puding-1.jpg') }}'" class="px-5 py-2.5 bg-brand-gold text-white text-xs font-bold uppercase tracking-wider rounded-full shadow-lg transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-brand-goldDark flex items-center gap-2">
                  <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7" /></svg> Perbesar
                </button>
              </div>
            </div>
            <div class="px-3 pt-5 pb-3 flex flex-col flex-grow text-center">
              <h3 class="font-bold text-sm md:text-base text-brand-chocolate mb-1 line-clamp-2">{{ $product->name }}</h3>
              <p class="text-[11px] md:text-xs text-brand-chocolateLight font-light line-clamp-3">{{ $product->description }}</p>
            </div>
          </div>
@empty
          <div class="col-span-full text-center text-brand-chocolateLight py-10">Belum ada menu puding yang ditambahkan.</div>
@endforelse
          
        </div>
        
      </div>
    </section>
    
        <!-- Testimoni Section (Modern Cards) -->
    <section id="testimoni" class="py-20 bg-brand-creamDark/40 border-t border-b border-brand-creamDark/60 relative overflow-hidden">
      <!-- Background pattern -->
      <div class="absolute inset-0 bg-[radial-gradient(#D97706_1px,transparent_1px)] [background-size:24px_24px] opacity-[0.03]"></div>
      
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-2xl mx-auto mb-16" data-aos="fade-up">
          <span class="text-xs font-bold text-brand-gold uppercase tracking-widest block mb-3">Ulasan Pelanggan</span>
                    <h2 class="text-3xl font-black text-brand-chocolate">Apa Kata Mereka?</h2>
                    <div class="w-16 h-1.5 bg-brand-gold mx-auto mt-6 rounded-full"></div>
        </div>

                <!-- Clean CSS Grid for CMS robust display (replacing complex slider) -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          
          @forelse($testimonials as $testimonial)
          <div class="relative overflow-hidden bg-white border border-brand-creamDark/80 rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="absolute right-6 top-6 text-brand-creamDark text-7xl font-serif select-none pointer-events-none opacity-50 z-10 group-hover:text-brand-gold/10 transition-colors">“</div>
            
            <div class="flex items-center gap-4 mb-6 relative z-20">
              <div class="w-14 h-14 rounded-2xl bg-amber-50 border border-brand-creamDark flex items-center justify-center font-bold text-xl text-brand-gold shrink-0 shadow-inner uppercase">
                {{ substr($testimonial->customer_name, 0, 2) }}
              </div>
              <div>
                <h4 class="font-bold text-base text-brand-chocolate leading-none">{{ $testimonial->customer_name }}</h4>
                <div class="flex gap-1 mt-2 text-brand-gold text-xs">
                  @for($i = 0; $i < $testimonial->rating; $i++)
                  <span>★</span>
                  @endfor
                </div>
              </div>
            </div>

            <p class="text-sm md:text-base text-brand-chocolateLight italic font-light leading-relaxed flex-grow line-clamp-4 relative z-20">
              "{{ $testimonial->content }}"
            </p>
          </div>
          @empty
          <div class="col-span-full text-center text-brand-chocolateLight py-10">Belum ada ulasan pelanggan.</div>
          @endforelse
          
          </div>
        
      </div>
    </section>
      </main>

    <!-- Footer -->
  <footer id="kontak" class="bg-brand-chocolate text-brand-cream pt-20 pb-10 border-t-8 border-brand-gold relative overflow-hidden" data-aos="fade-up" data-aos-duration="1000">
    <!-- Abstract background -->
    <div class="absolute inset-0 opacity-5 bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white via-transparent to-transparent"></div>
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-16">
        
        <!-- Brand Info -->
        <div class="md:col-span-5 lg:col-span-4">
                    <a href="#" class="inline-flex items-center gap-3 mb-6">
            <img src="{{ asset('assets/img/logo.png') }}" alt="Mbok Dewor" class="h-14 w-auto brightness-0 invert opacity-90">
            <div class="flex flex-col">
              <span class="text-xl font-bold tracking-tight text-white leading-none">Mbok Dewor</span>
              <span class="text-[9px] uppercase tracking-widest text-brand-gold font-bold">Premium Dessert</span>
            </div>
          </a>
                    <p class="text-brand-creamDark/60 text-sm leading-relaxed mb-8 font-light pr-4">
            Menghadirkan kreasi dessert premium dengan bahan organik pilihan untuk menyempurnakan setiap momen bahagia Anda.
          </p>
        </div>
        
        <!-- Links -->
        <div class="md:col-span-3 lg:col-span-4 lg:pl-12">
          <h3 class="font-bold text-sm text-white uppercase tracking-widest mb-6">Tautan Cepat</h3>
          <ul class="space-y-4">
                        <li><a href="#beranda" class="text-brand-creamDark/60 hover:text-brand-gold transition-colors text-sm font-light flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-brand-gold"></span> Beranda</a></li>
            <li><a href="#tentang" class="text-brand-creamDark/60 hover:text-brand-gold transition-colors text-sm font-light flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-brand-gold"></span> Tentang Kami</a></li>
            <li><a href="#menu" class="text-brand-creamDark/60 hover:text-brand-gold transition-colors text-sm font-light flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-brand-gold"></span> Menu & Harga</a></li>
            <li><a href="#testimoni" class="text-brand-creamDark/60 hover:text-brand-gold transition-colors text-sm font-light flex items-center gap-2"><span class="w-1.5 h-1.5 rounded-full bg-brand-gold"></span> Ulasan</a></li>
                      </ul>
        </div>
        
        <!-- Contact -->
        <div class="md:col-span-4 lg:col-span-4">
          <h3 class="font-bold text-sm text-white uppercase tracking-widest mb-6">Hubungi Kami</h3>
          <ul class="space-y-5 text-sm font-light text-brand-creamDark/60">
                        <li class="flex items-start gap-4">
              <div class="w-8 h-8 rounded-full bg-brand-gold/20 text-brand-gold flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M1.026 22l1.639-5.986a10.945 10.945 0 01-1.488-5.545c0-6.046 4.922-10.969 10.971-10.969 2.932 0 5.688 1.142 7.761 3.216 2.074 2.073 3.217 4.829 3.217 7.761 0 6.047-4.922 10.969-10.97 10.969a10.943 10.943 0 01-5.261-1.34L1.026 22zm6.208-3.415l.394.234a9.141 9.141 0 004.53 1.2c5.05 0 9.167-4.116 9.167-9.168 0-2.449-.954-4.752-2.686-6.484A9.124 9.124 0 0012.158 1.68c-5.051 0-9.168 4.116-9.168 9.168 0 1.636.425 3.211 1.233 4.606l.257.444-1.076 3.93 4.025-1.058h-.001-.002z"/><path d="M16.92 13.911c-.244-.122-1.442-.712-1.666-.793-.224-.081-.387-.122-.55.122-.163.244-.63.793-.772.955-.142.163-.284.183-.528.061-.244-.122-1.028-.379-1.958-1.206-.723-.643-1.21-1.439-1.353-1.683-.142-.244-.015-.377.107-.499.111-.11.244-.285.366-.427.122-.142.163-.244.244-.407.081-.163.041-.305-.02-.427-.061-.122-.55-1.325-.753-1.815-.198-.477-.4-.412-.55-.419-.142-.007-.305-.007-.468-.007-.163 0-.427.061-.651.305-.224.244-.855.834-.855 2.035 0 1.201.875 2.363.997 2.525.122.163 1.721 2.628 4.168 3.684.582.253 1.037.404 1.393.517.585.186 1.117.159 1.536.096.47-.07 1.442-.589 1.646-1.16.204-.57.204-1.058.143-1.16-.062-.102-.225-.163-.469-.285z"/></svg>
              </div>
              <div class="flex flex-col">
                <span class="text-[10px] uppercase tracking-wider text-brand-creamDark/40 font-bold mb-0.5">WhatsApp Admin</span>
                <a href="https://wa.me/62{{ ltrim($settings['whatsapp_number'] ?? '081335374099', '0') }}" target="_blank" class="hover:text-brand-gold transition-colors text-white font-medium">{{ $settings['whatsapp_number'] ?? '0813 3537 4099' }}</a>
              </div>
            </li>
                        
                        <li class="flex items-start gap-4">
              <div class="w-8 h-8 rounded-full bg-brand-gold/20 text-brand-gold flex items-center justify-center shrink-0">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
              </div>
              <div class="flex flex-col">
                <span class="text-[10px] uppercase tracking-wider text-brand-creamDark/40 font-bold mb-0.5">Instagram</span>
                <a href="{{ $settings['instagram_url'] ?? '#' }}" target="_blank" class="hover:text-brand-gold transition-colors text-white font-medium">@mbokdeworpuding</a>
              </div>
            </li>
                        
                        <li class="flex items-start gap-4">
              <div class="w-8 h-8 rounded-full bg-brand-gold/20 text-brand-gold flex items-center justify-center shrink-0 mt-1">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
              </div>
              <div class="flex flex-col">
                <span class="text-[10px] uppercase tracking-wider text-brand-creamDark/40 font-bold mb-0.5">Workshop</span>
                <a href="{{ $settings['google_maps_url'] ?? '#' }}" target="_blank" class="text-white font-medium leading-relaxed hover:text-brand-gold transition-colors">{{ $settings['address'] ?? 'Surabaya, Jawa Timur, Indonesia' }}</a>
              </div>
            </li>
                      </ul>
        </div>
        
      </div>
      
      <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row justify-between items-center text-[11px] text-brand-creamDark/40">
        <p>&copy; 2026 Mbok Dewor Puding. Hak cipta dilindungi. <span class="mx-1 hidden md:inline">|</span> <span class="block md:inline mt-1 md:mt-0">The artisan <a href="https://instagram.com/asep_idung" target="_blank" class="text-brand-gold hover:text-white transition-colors font-semibold">saepullrock</a></span></p>
        <p class="mt-3 md:mt-0">Dirancang secara artisan untuk rasa yang tak terlupakan.</p>
      </div>
    </div>
  </footer>
  
  <!-- Floating WhatsApp Action Button (Pulse) -->
  <a href="https://wa.me/62{{ ltrim($settings['whatsapp_number'] ?? '081335374099', '0') }}" 
     target="_blank"
     class="fixed bottom-6 right-6 z-50 flex items-center justify-center w-14 h-14 bg-green-500 text-white rounded-full shadow-2xl hover:bg-green-600 hover:scale-110 transition-all duration-300 group">
    <span class="absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75 animate-ping"></span>
    <svg class="w-7 h-7 relative z-10" fill="currentColor" viewBox="0 0 24 24"><path d="M1.026 22l1.639-5.986a10.945 10.945 0 01-1.488-5.545c0-6.046 4.922-10.969 10.971-10.969 2.932 0 5.688 1.142 7.761 3.216 2.074 2.073 3.217 4.829 3.217 7.761 0 6.047-4.922 10.969-10.97 10.969a10.943 10.943 0 01-5.261-1.34L1.026 22zm6.208-3.415l.394.234a9.141 9.141 0 004.53 1.2c5.05 0 9.167-4.116 9.167-9.168 0-2.449-.954-4.752-2.686-6.484A9.124 9.124 0 0012.158 1.68c-5.051 0-9.168 4.116-9.168 9.168 0 1.636.425 3.211 1.233 4.606l.257.444-1.076 3.93 4.025-1.058h-.001-.002z"/><path d="M16.92 13.911c-.244-.122-1.442-.712-1.666-.793-.224-.081-.387-.122-.55.122-.163.244-.63.793-.772.955-.142.163-.284.183-.528.061-.244-.122-1.028-.379-1.958-1.206-.723-.643-1.21-1.439-1.353-1.683-.142-.244-.015-.377.107-.499.111-.11.244-.285.366-.427.122-.142.163-.244.244-.407.081-.163.041-.305-.02-.427-.061-.122-.55-1.325-.753-1.815-.198-.477-.4-.412-.55-.419-.142-.007-.305-.007-.468-.007-.163 0-.427.061-.651.305-.224.244-.855.834-.855 2.035 0 1.201.875 2.363.997 2.525.122.163 1.721 2.628 4.168 3.684.582.253 1.037.404 1.393.517.585.186 1.117.159 1.536.096.47-.07 1.442-.589 1.646-1.16.204-.57.204-1.058.143-1.16-.062-.102-.225-.163-.469-.285z"/></svg>
  </a>

  <!-- AOS Script Initialization -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true, // Animasi hanya berjalan satu kali saat pertama kali disorot
      offset: 50, // Muncul sedikit lebih cepat sebelum elemen masuk layar penuh
      duration: 800, // Durasi animasi standar 0.8 detik
      easing: 'ease-out-cubic', // Efek animasi halus
    });
  </script>

  <!-- Alpine Lightbox Modal -->
  <div @keydown.escape.window="lightboxOpen = false"
       x-show="lightboxOpen"
       x-cloak
       class="fixed inset-0 z-[100] flex items-center justify-center bg-black/90 backdrop-blur-sm"
       x-transition:enter="transition ease-out duration-300"
       x-transition:enter-start="opacity-0"
       x-transition:enter-end="opacity-100"
       x-transition:leave="transition ease-in duration-200"
       x-transition:leave-start="opacity-100"
       x-transition:leave-end="opacity-0">
    
    <!-- Close Button -->
    <button type="button" @click.prevent="lightboxOpen = false" class="absolute top-6 right-6 text-white hover:text-brand-gold transition-colors p-2 focus:outline-none">
      <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
    </button>
    
    <!-- Image with Zoom Animation -->
    <img :src="lightboxImage" alt="Zoomed Puding" 
         @click.away="lightboxOpen = false"
         x-show="lightboxOpen"
         x-transition:enter="transition ease-out duration-300 transform delay-75"
         x-transition:enter-start="scale-90 opacity-0"
         x-transition:enter-end="scale-100 opacity-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="scale-100 opacity-100"
         x-transition:leave-end="scale-95 opacity-0"
         class="max-w-[90vw] max-h-[90vh] object-contain rounded-xl shadow-2xl border-2 border-white/10" />
  </div>

</body>
</html>
