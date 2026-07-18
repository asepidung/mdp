import re
import os

with open('resources/views/welcome.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Clean blade comments and hints
content = re.sub(r'<!--\s*@(if|foreach|endforeach|endif|section|endsection).*?-->\n?', '', content)
content = re.sub(r'<!-- Hint for Blade:.*?-->\n?', '', content)

# 2. Fix Assets
content = re.sub(r'(src|href)="assets/([^"]+)"', r'\1="{{ asset(\'assets/\2\') }}"', content)
content = content.replace("lightboxImage = 'assets/", "lightboxImage = '{{ asset(\'assets/")
content = content.replace(".jpg'", ".jpg\') }}'")

# 3. Dynamic Products
pattern = r'<!-- Card 1 -->.*?<div class="group bg-white.*?<!-- Card 8 -->.*?</div>'
replacement = """@forelse($products as $product)
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
@endforelse"""
content = re.sub(pattern, replacement, content, flags=re.DOTALL)

# 4. Dynamic Testimonials
pattern_testi = r'<!-- Card 1 -->.*?<div class="relative overflow-hidden bg-white.*?<!-- \(Static Dummy Reviews\) -->.*?</div>\s*</div>'
replacement_testi = """@forelse($testimonials as $testimonial)
          <div class="relative overflow-hidden bg-white border border-brand-creamDark/80 rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col h-full group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="absolute right-6 top-6 text-brand-creamDark text-7xl font-serif select-none pointer-events-none opacity-50 z-10 group-hover:text-brand-gold/10 transition-colors">“</div>
            
            <div class="flex items-center gap-4 mb-6 relative z-20">
              <div class="w-14 h-14 rounded-2xl bg-amber-50 border border-brand-creamDark flex items-center justify-center font-bold text-xl text-brand-gold shrink-0 shadow-inner">
                {{ strtoupper(substr($testimonial->customer_name, 0, 2)) }}
              </div>
              <div>
                <h4 class="font-bold text-base text-brand-chocolate leading-none">{{ $testimonial->customer_name }}</h4>
                <div class="flex gap-1 mt-2 text-brand-gold text-xs">
                  {!! str_repeat('<span>★</span>', $testimonial->rating) !!}
                </div>
              </div>
            </div>

            <p class="text-sm md:text-base text-brand-chocolateLight italic font-light leading-relaxed flex-grow line-clamp-4 relative z-20">
              "{{ $testimonial->content }}"
            </p>
          </div>
@empty
          <div class="col-span-full text-center text-brand-chocolateLight py-10">Belum ada ulasan yang ditambahkan.</div>
@endforelse"""
content = re.sub(pattern_testi, replacement_testi, content, flags=re.DOTALL)

# 5. WhatsApp
content = re.sub(r'0813 3537 4099', '{{ $settings[\'whatsapp_number\'] ?? \'0813 3537 4099\' }}', content)
content = re.sub(r'6281335374099', '62{{ ltrim($settings[\'whatsapp_number\'] ?? \'081335374099\', \'0\') }}', content)

# 6. Clean up stray dummy testimonials if any missed
content = re.sub(r'<!-- \(Static Dummy Reviews\) -->.*?</div>\s*</div>', '', content, flags=re.DOTALL)

with open('resources/views/welcome.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)
