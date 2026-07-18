import os

filepath = 'resources/views/welcome.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

content = content.replace(
    "{{ $settings['whatsapp_number'] ?? '{{ $settings['whatsapp_number'] ?? '0813 3537 4099' }}' }}",
    "{{ $settings['whatsapp_number'] ?? '0813 3537 4099' }}"
)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print('Fixed blade')
