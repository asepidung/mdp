import re

with open('resources/views/welcome.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace assets
content = re.sub(r'(src|href)="assets/([^"]+)"', r'\1="{{ asset(\'assets/\2\') }}"', content)
content = content.replace("lightboxImage = 'assets/", "lightboxImage = '{{ asset('assets/")

with open('resources/views/welcome.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)
