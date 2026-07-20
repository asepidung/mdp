import os

filepath = 'resources/views/welcome.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Fix escaped quotes in blade tags
content = content.replace(r"{{ $settings[\'hero_description\'] ?? \'Sensasi dessert lumer berkelas dunia yang dibuat secara higienis menggunakan susu segar murni dan bahan organik premium. Tekstur selembut sutra yang siap memanjakan setiap suapan.\' }}",
                          r"{{ $settings['hero_description'] ?? 'Sensasi dessert lumer berkelas dunia yang dibuat secara higienis menggunakan susu segar murni dan bahan organik premium. Tekstur selembut sutra yang siap memanjakan setiap suapan.' }}")

content = content.replace(r"{{ $settings[\'about_title\'] ?? \'Dibuat dengan Bahan Susu Premium Pilihan & Penuh Kasih Sayang\' }}",
                          r"{{ $settings['about_title'] ?? 'Dibuat dengan Bahan Susu Premium Pilihan & Penuh Kasih Sayang' }}")

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)
