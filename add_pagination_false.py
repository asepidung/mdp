import re

filepath = 'app/Filament/Resources/SiteSettingResource.php'
with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# Add paginated(false) to the table
if '->paginated(false)' not in content:
    content = content.replace(r'->actions([', r'->actions([') # just finding the block
    content = re.sub(r'->actions\(\[\s*Tables\\Actions\\EditAction::make\(\),\s*\]\)', r'->actions([\n                  Tables\Actions\EditAction::make(),\n              ])\n              ->paginated(false)', content)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)
