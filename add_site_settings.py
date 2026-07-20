import re

# 1. Update DatabaseSeeder
with open('database/seeders/DatabaseSeeder.php', 'r', encoding='utf-8') as f:
    seeder = f.read()

settings_replacement = """        $settings = [
            ['key' => 'whatsapp_number', 'value' => '081335374099'],
            ['key' => 'hero_title', 'value' => 'Rasakan Kelezatan Puding Asli Mbok Dewor'],
            ['key' => 'hero_description', 'value' => 'Sensasi dessert lumer berkelas dunia yang dibuat secara higienis menggunakan susu segar murni dan bahan organik premium. Tekstur selembut sutra yang siap memanjakan setiap suapan.'],
            ['key' => 'hero_badge', 'value' => 'Premium Quality'],
            ['key' => 'about_title', 'value' => 'Dibuat dengan Bahan Susu Premium Pilihan & Penuh Kasih Sayang'],
            ['key' => 'about_text', 'value' => 'Setiap puding dari Mbok Dewor dibuat secara eksklusif menggunakan susu segar berkualitas tinggi, buah-buahan terbaik, dan tanpa pengawet buatan.'],
            ['key' => 'instagram_url', 'value' => 'https://www.instagram.com/mbokdeworpuding/'],
            ['key' => 'google_maps_url', 'value' => 'https://share.google/tS77CW3sIQk78KZ2S'],
            ['key' => 'address', 'value' => 'Jl. Dasana Indah blok RD VI No.19 - 20, Bojong Nangka, Kecamatan Kelapa Dua, Kabupaten Tangerang, Banten 15810'],
        ];"""

seeder = re.sub(r'\$settings = \[.*?\];', settings_replacement, seeder, flags=re.DOTALL)
with open('database/seeders/DatabaseSeeder.php', 'w', encoding='utf-8') as f:
    f.write(seeder)

# 2. Update SiteSettingResource
with open('app/Filament/Resources/SiteSettingResource.php', 'r', encoding='utf-8') as f:
    resource = f.read()

format_replacement = """                      ->formatStateUsing(function ($state) {
                          return match($state) {
                              'whatsapp_number' => 'Nomor WhatsApp',
                              'hero_title' => 'Judul Utama (Hero)',
                              'hero_description' => 'Deskripsi Utama (Hero)',
                              'hero_badge' => 'Teks Badge (Hero)',
                              'about_title' => 'Judul Tentang Kami',
                              'about_text' => 'Teks Tentang Kami',
                              'instagram_url' => 'Link Instagram',
                              'google_maps_url' => 'Link Google Maps',
                              'address' => 'Alamat Lengkap',
                              default => $state,
                          };
                      }),"""

resource = re.sub(r'->formatStateUsing\(function \(\$state\) \{.*?\}\),', format_replacement, resource, flags=re.DOTALL)
with open('app/Filament/Resources/SiteSettingResource.php', 'w', encoding='utf-8') as f:
    f.write(resource)

# 3. Update welcome.blade.php
with open('resources/views/welcome.blade.php', 'r', encoding='utf-8') as f:
    blade = f.read()

# Hero Description
blade = re.sub(
    r'<p class="text-sm sm:text-base md:text-lg text-brand-chocolateLight max-w-xl mb-10 leading-relaxed font-light">\s*Sensasi dessert lumer.*?\s*</p>',
    r'<p class="text-sm sm:text-base md:text-lg text-brand-chocolateLight max-w-xl mb-10 leading-relaxed font-light">\n                {{ $settings[\'hero_description\'] ?? \'Sensasi dessert lumer berkelas dunia yang dibuat secara higienis menggunakan susu segar murni dan bahan organik premium. Tekstur selembut sutra yang siap memanjakan setiap suapan.\' }}\n              </p>',
    blade, flags=re.DOTALL
)

# Hero Badge
blade = blade.replace(
    '<span class="text-[10px] font-bold text-brand-chocolate tracking-wider uppercase">Premium Quality</span>',
    '<span class="text-[10px] font-bold text-brand-chocolate tracking-wider uppercase">{{ $settings[\'hero_badge\'] ?? \'Premium Quality\' }}</span>'
)

# About Title
blade = re.sub(
    r'<h2 class="text-3xl md:text-4xl font-black text-brand-chocolate leading-tight mb-6">\s*Dibuat dengan Bahan Susu Premium Pilihan & Penuh Kasih Sayang\s*</h2>',
    r'<h2 class="text-3xl md:text-4xl font-black text-brand-chocolate leading-tight mb-6">\n              {{ $settings[\'about_title\'] ?? \'Dibuat dengan Bahan Susu Premium Pilihan & Penuh Kasih Sayang\' }}\n            </h2>',
    blade, flags=re.DOTALL
)

# Instagram
blade = blade.replace(
    '<a href="#" class="hover:text-brand-gold transition-colors text-white font-medium">@mbokdeworpuding</a>',
    '<a href="{{ $settings[\'instagram_url\'] ?? \'#\' }}" target="_blank" class="hover:text-brand-gold transition-colors text-white font-medium">@mbokdeworpuding</a>'
)

# Workshop/Address/Maps
address_html_old = """              <div class="flex flex-col">
                <span class="text-[10px] uppercase tracking-wider text-brand-creamDark/40 font-bold mb-0.5">Workshop</span>
                <span class="text-white font-medium leading-relaxed">Surabaya, Jawa Timur, Indonesia</span>
              </div>"""

address_html_new = """              <div class="flex flex-col">
                <span class="text-[10px] uppercase tracking-wider text-brand-creamDark/40 font-bold mb-0.5">Workshop</span>
                <a href="{{ $settings['google_maps_url'] ?? '#' }}" target="_blank" class="text-white font-medium leading-relaxed hover:text-brand-gold transition-colors">{{ $settings['address'] ?? 'Surabaya, Jawa Timur, Indonesia' }}</a>
              </div>"""

blade = blade.replace(address_html_old, address_html_new)

with open('resources/views/welcome.blade.php', 'w', encoding='utf-8') as f:
    f.write(blade)

print("Done updating files!")
