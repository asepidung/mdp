import os
import re

directory = 'app/Filament/Resources'
for root, dirs, files in os.walk(directory):
    for file in files:
        if file.endswith('.php'):
            filepath = os.path.join(root, file)
            with open(filepath, 'r', encoding='utf-8') as f:
                content = f.read()
            
            # Remove use Translatable traits inside classes
            content = re.sub(r'\s*use\s+.*?Concerns\\Translatable;', '', content)
            
            # Remove use Translatable from SiteSettingResource
            content = re.sub(r'\s*use Filament\\Resources\\Concerns\\Translatable;', '', content)
            content = re.sub(r'class SiteSettingResource extends Resource\n\{\n\s*use Translatable;', 'class SiteSettingResource extends Resource\n{', content)

            # Remove LocaleSwitcher
            content = re.sub(r'\s*Actions\\LocaleSwitcher::make\(\),', '', content)
            
            with open(filepath, 'w', encoding='utf-8') as f:
                f.write(content)

print('Cleaned up resources')
