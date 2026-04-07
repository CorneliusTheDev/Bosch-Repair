# Bosch Repair Pro – WordPress Theme Installation Guide

## Theme Structure

```
bosch-repair-theme/
├── style.css                    ← Theme declaration + base CSS
├── functions.php                ← Theme setup, CPTs, taxonomies, helpers
├── header.php                   ← Site header with sticky nav
├── footer.php                   ← Footer with disclaimer + floating phone button
├── index.php                    ← Fallback template
├── front-page.php               ← Homepage template
├── page.php                     ← Default page template
├── single.php                   ← Single post/CPT template
├── archive.php                  ← Archive listing template
├── 404.php                      ← 404 error page
├── assets/
│   ├── css/main.css             ← Component styles
│   └── js/main.js               ← JavaScript (nav, FAQ, phone button, lazy load)
├── page-templates/
│   ├── template-service.php     ← Individual service pages (washer, dryer, etc.)
│   ├── template-city.php        ← City service area pages
│   ├── template-error-codes-hub.php      ← Error codes main page
│   ├── template-error-codes-appliance.php ← Error codes by appliance
│   ├── template-guides.php      ← Guides hub
│   ├── template-blog.php        ← Blog hub with topic sections
│   ├── template-recalls.php     ← Recalls page
│   ├── template-about.php       ← About Us page
│   └── template-legal.php       ← Privacy Policy / Terms of Use / Mobile Terms
└── inc/
    └── setup-pages.php          ← One-time setup script (creates all pages/posts)
```

---

## Installation Steps

### Step 1: Upload the Theme

1. Zip the entire `bosch-repair-theme/` folder
2. Go to **WordPress Admin → Appearance → Themes → Add New → Upload Theme**
3. Upload the zip file and click **Activate**

### Step 2: Run the Page Setup Script

This script creates ALL pages, service posts, city posts, and error code posts automatically.

**Option A – Via WordPress Code (temporary)**

Add to the bottom of `functions.php` temporarily:

```php
add_action('init', function() {
    if (isset($_GET['brp_setup']) && current_user_can('manage_options')) {
        include get_template_directory() . '/inc/setup-pages.php';
        exit;
    }
}, 99);
```

Then visit: `https://yoursite.com/?brp_setup=1`

Remove the code from functions.php after running.

**Option B – Via WP-CLI**

```bash
wp eval-file wp-content/themes/bosch-repair-theme/inc/setup-pages.php
```

### Step 3: Configure WordPress Settings

1. **Settings → Reading**
   - Front page: **Home**
   - Posts page: **Blog**

2. **Settings → Permalinks**
   - Select: **Post name** (`/%postname%/`)
   - Save to flush rewrite rules

### Step 4: Set Up Navigation Menus

Go to **Appearance → Menus** and create these menus:

**Primary Navigation:**
- Home
- About Us
- Services (dropdown with all 12 service pages)
- Cities (dropdown with 6 city pages)
- Error Codes
- Guides
- Blog
- Recalls

**Footer Menus:**
- Footer – Services (8 most popular services)
- Footer – Cities (6 cities)
- Footer – Resources (About, Error Codes, Guides, Blog, Recalls, Book Appointment)
- Footer Legal (Privacy Policy, Terms of Use, Mobile Terms of Use)

Assign each menu to its location in the **Manage Locations** tab.

### Step 5: Update Phone Number

In `functions.php`, update:

```php
define( 'BRP_PHONE', '(800) 555-0199' );         // Display format
define( 'BRP_PHONE_RAW', '18005550199' );          // tel: link format
define( 'BRP_EMAIL', 'service@boschrepairpro.com' );
```

### Step 6: Add Appliance Images

For each service post (Washer, Dryer, etc.):
1. Go to **WordPress Admin → Services**
2. Open each service post
3. Set a **Featured Image** — professional photo of the appliance
4. Recommended size: 900×500px

### Step 7: Install Recommended Plugins

| Plugin | Purpose |
|--------|---------|
| **Yoast SEO** or **RankMath** | Meta titles, descriptions, sitemaps |
| **WP Rocket** or **LiteSpeed Cache** | Page caching and speed |
| **Imagify** or **ShortPixel** | Image compression |
| **WP Mail SMTP** | Email deliverability |
| **Really Simple SSL** | Force HTTPS |
| **MonsterInsights** | Google Analytics integration |

### Step 8: Configure SEO

For each service page, set in the **Page Settings** meta box (right sidebar):
- **SEO Title**: e.g., "Bosch Washer Repair | Same-Day Service | Bosch Repair Pro"
- **Meta Description**: e.g., "Expert Bosch washer repair by certified technicians. Factory-certified parts, 90-day warranty, same-day service. Call (800) 555-0199."

### Step 9: Add Google Analytics / GTM

Add your GA4 or GTM tracking code in the theme (or via a plugin). The main.js file already includes event tracking hooks for phone clicks and appointment button clicks.

### Step 10: Test Everything

- [ ] Homepage loads correctly
- [ ] All 12 service pages accessible at /services/{slug}/
- [ ] All 6 city pages accessible at /cities/{slug}/
- [ ] Error codes hub at /error-codes/
- [ ] Appliance error code pages at /error-codes/dishwasher/ etc.
- [ ] Individual error codes at /error-codes/dishwasher/e15-anti-flood-protection/
- [ ] Guides at /guides/
- [ ] Blog at /blog/
- [ ] Recalls at /recalls/
- [ ] Privacy Policy, Terms of Use, Mobile Terms pages
- [ ] Appointment form loads (iframe from proleadservice.com)
- [ ] Floating phone button appears after scrolling 300px
- [ ] Mobile menu works correctly
- [ ] FAQ accordion opens/closes
- [ ] Phone number links work (tel: links)
- [ ] Footer disclaimer is visible

---

## URL Structure

```
/                                          ← Homepage
/about-us/                                 ← About Us
/services/                                 ← Services archive
/services/bosch-washer-repair/             ← Individual service
/services/bosch-dryer-repair/
/services/bosch-dishwasher-repair/
/services/bosch-refrigerator-repair/
/services/bosch-oven-repair/
/services/bosch-range-repair/
/services/bosch-cooktop-repair/
/services/bosch-freezer-repair/
/services/bosch-ice-maker-repair/
/services/bosch-microwave-repair/
/services/bosch-wall-oven-repair/
/services/bosch-speed-oven-repair/
/cities/                                   ← Cities archive
/cities/chicago/
/cities/san-francisco/
/cities/houston/
/cities/miami/
/cities/los-angeles/
/cities/new-york/
/error-codes/                              ← Error codes hub
/error-codes/dishwasher/                   ← By appliance
/error-codes/dishwasher/e15-anti-flood-protection/   ← Individual code
/error-codes/dishwasher/f63-door-slide-lock-latch-fault/
/error-codes/washer/
/error-codes/refrigerator/
/error-codes/oven/
/guides/                                   ← Guides hub
/guides/bosch-dishwasher-not-draining/    ← Individual guide
/blog/                                     ← Blog hub
/blog/topic/{topic-slug}/                  ← Blog by topic
/recalls/                                  ← Recalls
/privacy-policy/
/terms-of-use/
/mobile-terms-of-use/
```

---

## Content to Add Later

### Blog Posts (per Bosch.md: you will populate content)
Topic sections are already created. Add posts via **Posts → Add New** and assign the appropriate **Blog Topic** taxonomy term.

### Additional Error Codes
Add via **Error Codes → Add New**:
- Set title to: `{CODE} – {Description}`
- Assign **Appliance Type** taxonomy
- Set `_brp_error_code` meta field
- Write full explanation in the content editor

### Additional Guides
Add via **Guides → Add New** with full step-by-step content.

### Recalls
Add via **Recalls → Add New** with official CPSC information.

---

## Appointment Form

The form is already embedded on every page using the iframe provided:
```html
<iframe id="appointmentIframe"
        src="https://webform.proleadservice.com/?ref_id=478"
        width="100%"
        style="min-height: 450px;"
        frameborder="0">
</iframe>
```

It lazy-loads via IntersectionObserver for performance.

---

## Footer Disclaimer

The footer automatically shows this disclaimer (rotated for different pages via PHP):
> "Independent appliance repair service specializing in Bosch products. Professional diagnosis by experienced technicians. Not affiliated with or endorsed by Bosch. Brand names used for identification only."

---

## Support

For theme customization or additional development, contact the development team.
