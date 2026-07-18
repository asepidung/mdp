import re

filepath = 'resources/views/welcome.blade.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Remove the Language Switcher block
# It looks like: <!-- Language Switcher --> ... </a>
content = re.sub(r'<!-- Language Switcher -->\s*<a href="\{\{\s*route\(\'lang\.switch\'.*?</a>', '', content, flags=re.DOTALL)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print('Removed Language Switcher')
