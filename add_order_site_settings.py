import re

filepath = 'app/Filament/Resources/SiteSettingResource.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Add Illuminate\Database\Eloquent\Builder import
if 'use Illuminate\\Database\\Eloquent\\Builder;' not in content:
    content = content.replace('use Filament\\Tables\\Table;', 'use Filament\\Tables\\Table;\nuse Illuminate\\Database\\Eloquent\\Builder;')

# Add getEloquentQuery method
method_to_add = """
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->orderByRaw("FIELD(key, 'hero_image', 'hero_title', 'hero_description', 'hero_badge', 'about_title', 'about_text', 'whatsapp_number', 'instagram_url', 'google_maps_url', 'address')");
    }
"""

if 'getEloquentQuery' not in content:
    content = content.replace('public static function canCreate(): bool', method_to_add + '\n    public static function canCreate(): bool')

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)
