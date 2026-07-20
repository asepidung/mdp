import re

filepath = 'resources/views/welcome.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace footer text
content = content.replace(
    '<p>&copy; 2026 Mbok Dewor Puding. Hak cipta dilindungi.</p>',
    '<p>&copy; 2026 Mbok Dewor Puding. Hak cipta dilindungi. <span class="mx-1 hidden md:inline">|</span> <span class="block md:inline mt-1 md:mt-0">Dibuat oleh <a href="https://instagram.com/asep_idung" target="_blank" class="text-brand-gold hover:text-white transition-colors font-semibold">Asep Idung</a></span></p>'
)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)
