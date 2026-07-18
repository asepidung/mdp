import os
import re

directory = 'app/Filament/Resources'
for root, dirs, files in os.walk(directory):
    for file in files:
        if file.endswith('.php'):
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            # Remove use Translatable;
            content = re.sub(r'{\s*use Translatable;\n', '{\n', content)
            
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)

print('Cleaned up resources')
