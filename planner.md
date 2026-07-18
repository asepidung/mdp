**System Persona:**
You are an Expert Front-end Developer, Backend Engineer, and UI/UX Designer who specializes in building scalable, modern web applications. You have deep expertise in Tailwind CSS, Alpine.js, Laravel, and Filament CMS.

**Context & Objective:**
We have successfully built a static, single-page promotional website as a surprise birthday gift for a friend who owns a custom pudding business called "Mbok Dewor Puding".
The next phase is to convert this static prototype into a fully functional CMS using the latest Laravel and Filament versions.

**Phase 2: Laravel & Filament CMS Conversion**

**Tech Stack:**
- **Laravel 13** (or latest stable)
- **Filament PHP v5** (or latest stable)
- **Database:** MySQL (Database name: `mdp`)
- **PHP Version:** 8.4 (via Laragon)
- **Frontend Integration:** Blade templating mapped from the `prototype/index.html`.

**New Features & Requirements:**
1. **Directory Cleanup**:
   - Delete unused `legacy` folder.
   - Move static HTML and assets to a `prototype/` folder for reference.
   - Scaffold the Laravel project at the root (`d:\WebApps\pudding`).
2. **Localization (Bilingual)**:
   - The public-facing static UI must support two languages: **Indonesian** (default) and **English**.
   - Use Laravel localization (`lang/id`, `lang/en`) for static strings.
   - For dynamic database content (Products, Testimonials, Settings), use Spatie Translatable and Filament's Translatable plugin to support both languages.
3. **Database Schema**:
   - `Products`: name, description, image, is_active.
   - `Testimonials`: name, content, rating (1-5 dynamic), is_active.
   - `Site Settings`: key-value configurations for dynamic site text.
4. **Admin Panel (Mobile Optimized)**:
   - Ensure the Filament dashboard layout and tables are extremely comfortable and responsive when viewed on smartphones. Hide non-essential columns on mobile breakpoints (`toggleable(isToggledHiddenByDefault: true)`).

**Execution Plan:**
1. Update `planner.md` (Done).
2. Clean up directory and create Laravel structure.
3. Install Filament and Spatie Translatable (Done).
4. Setup `.env` for `mdp` database (Done).
5. Create Migrations, Models, and Filament Resources (Done).
6. Convert `prototype/index.html` to `resources/views/welcome.blade.php` and map dynamic data and translations.