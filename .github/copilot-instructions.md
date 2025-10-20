## Copilot instructions for the BANGLA24 (modern-news-portal) WordPress theme

Keep this short, actionable, and specific to this repository so an AI coding agent can be productive immediately.

1. Big picture
   - This repository is a WordPress theme (BANGLA24 / modern-news-portal). PHP templates live at the repo root (index.php, single.php, archive.php, etc.). Small reusable parts are under `template-parts/` and `templates/`.
   - Theme behavior and integration points are implemented in `functions.php` and `inc/*.php` (notably `inc/template-functions.php`, `inc/performance.php`, `inc/customizer.php`, `inc/widgets.php`). Use these to find filters/actions and feature flags.
   - Frontend assets are authored in `css/` and `js/` and compiled with Tailwind/PostCSS. Tailwind input: `css/main.css` -> output: `style.css` (theme stylesheet).

2. Build / dev / deploy commands (exact)
   - Install dev deps: npm ci
   - Development watch (rebuild Tailwind on change): npm run dev  (runs `tailwindcss -i ./css/main.css -o ./style.css --watch`)
   - Production build: npm run build  (runs `tailwindcss -i ./css/main.css -o ./style.css --minify`)
   - CI uses the above `npm run build` and then rsync to deploy (see `.github/workflows/deploy.yml`).

3. Project-specific conventions and patterns
   - CSS: Tailwind is used; `style.css` is the compiled theme stylesheet and must be enqueued via `get_stylesheet_uri()` in `functions.php`. When editing design tokens, change `tailwind.config.js` and `css/main.css` then run the build.
   - Scripts: Theme JavaScript lives in `js/`. Enqueues and handles are registered in `modern_news_portal_scripts()` in `functions.php`. Common handles: `modern-news-portal-main`, `modern-news-portal-navigation`, `modern-news-portal-ticker`, `modern-news-portal-responsive`.
   - Performance hooks: `inc/performance.php` handles CSS/JS optimizations (critical CSS, defer attributes, image sizes). For changes to how assets are loaded, update enqueuing in `functions.php` and the logic in `inc/performance.php`.
   - Theme options & meta: Post options (breaking/featured) are stored as post meta keys `_breaking_news` and `_featured_post` and the theme exposes helper functions like `modern_news_portal_get_breaking_news()` and `modern_news_portal_get_featured_posts()` (see `functions.php` and `inc/template-functions.php`).
   - Dark mode: Controlled by a body class `dark-mode`, persisted via cookie/localStorage; toggle script is added via `modern_news_portal_dark_mode_script()` in `inc/template-functions.php`.

4. When editing PHP templates
   - Prefer adding small helper functions in `inc/template-functions.php` or `functions.php` and call them from templates. This keeps templates thin and reusable.
   - Keep translations: Use the text domain `modern-news-portal` (see `load_theme_textdomain()` in `functions.php`). Use `esc_html__()`, `esc_html_e()`, `esc_url()` where appropriate.
   - Use registered image sizes (`modern-news-portal-featured-large|medium|small`) when outputting post thumbnails.

5. Debugging and tests
   - There are no automated tests in the repo. For quick dev QA: run `npm run dev`, activate the theme in a local WordPress instance, and exercise pages (index, single, archive, and a post edit to toggle meta boxes).
   - To reproduce deployment: the GitHub action runs `npm ci` then `npm run build` then rsync to the server. Check `.github/workflows/deploy.yml` for exclusions and SSH setup.

6. Common fixes & anti-patterns to avoid (codebase specific)
   - Do not edit compiled `style.css` directly: change `css/main.css`/`tailwind.config.js` and rebuild.
   - When adding new JS modules, add them to `js/`, then register/enqueue in `modern_news_portal_scripts()` with a unique handle and include them in the defer list in `inc/performance.php` if non-critical.
   - Avoid adding large inline styles in templates; prefer critical CSS in `inc/performance.php`'s `modern_news_portal_add_critical_css()` for above-the-fold rules.

7. Quick references (examples)
   - Enqueue styles/scripts: `functions.php` -> `modern_news_portal_scripts()`
   - Tailwind content paths: `tailwind.config.js` -> content includes `./*.php`, `./template-parts/**/*.php`, `./inc/**/*.php`, `./js/**/*.js`
   - Post meta keys: `_breaking_news`, `_featured_post` (see `modern_news_portal_post_options_callback` and `modern_news_portal_save_post_options` in `functions.php`)

If anything here is incomplete or you want additional examples (sample PR checklist, testing checklist, or preferred commit/message style), tell me which area to expand and I'll update this file.
