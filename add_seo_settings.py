import re

# 1. Update SiteSettingResource.php
filepath = 'app/Filament/Resources/SiteSettingResource.php'
with open(filepath, 'r', encoding='utf-8') as f:
    resource = f.read()

resource = resource.replace(
    "'hero_image' => 'Gambar Utama (Hero)',",
    "'meta_title' => 'Judul SEO (Google)',\n                                'meta_description' => 'Deskripsi SEO (Google)',\n                                'hero_image' => 'Gambar Utama (Hero)',"
)

resource = resource.replace(
    "ORDER BY FIELD(`key`, 'hero_image'",
    "ORDER BY FIELD(`key`, 'meta_title', 'meta_description', 'hero_image'"
)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(resource)


# 2. Update DatabaseSeeder.php
filepath = 'database/seeders/DatabaseSeeder.php'
with open(filepath, 'r', encoding='utf-8') as f:
    seeder = f.read()

seeder = seeder.replace(
    "['key' => 'whatsapp_number', 'value' => '081335374099'],",
    "['key' => 'meta_title', 'value' => 'Mbok Dewor Puding - Premium F&B Dessert'],\n            ['key' => 'meta_description', 'value' => 'Sensasi dessert lumer berkelas dunia yang dibuat secara higienis menggunakan susu segar murni dan bahan organik premium.'],\n            ['key' => 'whatsapp_number', 'value' => '081335374099'],"
)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(seeder)


# 3. Update welcome.blade.php
filepath = 'resources/views/welcome.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    blade = f.read()

old_title = "<title>Mbok Dewor Puding - Premium F&B Dessert</title>"
new_title = "<title>{{ $settings['meta_title'] ?? 'Mbok Dewor Puding - Premium F&B Dessert' }}</title>"

old_desc = """<meta name="description" content="Sempurnakan Momen Spesialmu dengan Kelembutan Puding Mbok Dewor. Puding premium 
susu asli dengan kualitas rasa premium & kemasan elegan.">"""

new_desc = """<meta name="description" content="{{ $settings['meta_description'] ?? 'Sempurnakan Momen Spesialmu dengan Kelembutan Puding Mbok Dewor. Puding premium susu asli dengan kualitas rasa premium & kemasan elegan.' }}">"""

blade = blade.replace(old_title, new_title)
# the string matching might fail because of newlines in old_desc in the regex, let's use re
blade = re.sub(r'<meta name="description" content=".*?">', new_desc, blade, flags=re.DOTALL)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(blade)
