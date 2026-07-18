import re

with open('resources/views/welcome.blade.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Remove dummy reviews
content = re.sub(r'<!-- \(Static Dummy Reviews\) -->.*?</div>\s*</div>\s*<!-- @endif -->', '</div>\n        <!-- @endif -->', content, flags=re.DOTALL)

# Add Language Switcher to navbar
switcher_html = """
          <!-- Language Switcher -->
          <a href="{{ route('lang.switch', app()->getLocale() == 'id' ? 'en' : 'id') }}" class="flex items-center gap-1 font-bold text-brand-chocolate hover:text-brand-gold transition-colors duration-200">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path></svg>
            <span class="uppercase">{{ app()->getLocale() == 'id' ? 'EN' : 'ID' }}</span>
          </a>
"""

# Insert switcher before "<!-- Desktop Menu -->"
content = content.replace("<!-- Desktop Menu -->", switcher_html + "\n        <!-- Desktop Menu -->")

with open('resources/views/welcome.blade.php', 'w', encoding='utf-8') as f:
    f.write(content)
