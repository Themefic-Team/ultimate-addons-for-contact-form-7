# 📋 Ultimate Addons for Contact Form 7 - Code Audit & Release QA Report

**Plugin:** `Ultimate Addons for Contact Form 7`  
**Baseline Release:** `= 3.5.52 - 23/09/2026 =` (`fefeb8b6`)  
**Latest Target Commit:** `481a2289` (Branch: `preprod`)  
**Audit Executed On:** 2026-10-04  
**Overall Release Verdict:** 🟢 **READY FOR MERGE**

---

## 1. 🔍 Executive Summary of Changes

### Commits Audited Since Baseline (`3.5.52`):
1. **`481a2289`** | `extenddeveloper` | 2026-10-04  
   *Updated Plugin Parent Menu Title and slug*
2. **`95b3aa78`** | `extenddeveloper` | 2026-10-01  
   *Fixed style addon scaping issue*
3. **`cb22c7d1`** | `extenddeveloper` | 2026-09-24  
   *Merge branch 'org-report-plugin-check' of https://github.com/Themefic-Team/ultimate-addons-for-contact-form-7 into org-report-plugin-check*
4. **`b4844a62`** | `extenddeveloper` | 2026-09-24  
   *Fixed Text editor html scaping issue on save*

### Summary of Modifications:
- **Admin Menu Title & Screen Hook Consistency (`481a2289`):**  
  The top-level menu title was updated from `"UACF7"` to `"UACF7 Addons"` in `admin/tf-options/options/uacf7-settings.php`. In WordPress core, submenu screen IDs and body classes derive from `sanitize_title( $parent_menu_title )`. As a result, screen identifiers updated from `uacf7_page_*` to `uacf7-addons_page_*`. The developer appropriately updated all script/style enqueue screen arrays in `TF_Options.php`, `ultimate-addons-for-contact-form-7.php`, `database.php`, `pdf-generator.php`, and `database-modern-style.css`.
- **CF7 Styler HTML Escaping Resolution (`95b3aa78`):**  
  In `addons/styler/uacf7style.php`, `wp_kses_post( $form )` was previously stripping interactive form elements (`<input>`, `<select>`, `<button>`). The form is generated and filtered upstream by Contact Form 7 core; changing this to `$form` with a `// phpcs:ignore` tag correctly preserves all rendered form inputs on styled forms.
- **Metabox HTML Preservation on Save (`b4844a62`):**  
  In `admin/tf-options/classes/UACF7_Metabox.php`, sanitized post requests via `map_deep` were previously using `sanitize_text_field`, which stripped valid HTML tags from WYSIWYG / rich text fields. Updating this to `wp_kses_post` allows HTML formatting tags while keeping malicious tags/attributes filtered.

### Total Files Changed:
- **8 files changed** (18 insertions, 16 deletions)

---

## 2. 🚨 Error & Warning Assessment

| Severity | Type | File & Line | Description | Fix / Verification Status |
| :--- | :--- | :--- | :--- | :--- |
| **PASS** | PHP Syntax Check | Modified PHP files | `php -l` executed on all 7 changed PHP files | ✅ **0 Syntax Errors Detected** |
| **PASS** | Logic & Scope | `addons/styler/uacf7style.php:969` | Unescaped `$form` output check | ✅ **Safe:** `$form` originates directly from Contact Form 7 core output; `wp_kses_post` stripped inputs. |
| **PASS** | Sanitization Scope | `admin/tf-options/classes/UACF7_Metabox.php:230` | `wp_kses_post` instead of `sanitize_text_field` | ✅ **Safe:** User capability checked (`edit_post`), nonce verified, and `wp_kses_post` preserves safe markup. |
| **PASS** | Screen ID Uniformity | `admin/tf-options/TF_Options.php` etc. | Submenu screen hook alignment for new menu title | ✅ **Clean:** All references to `uacf7_page_` updated to `uacf7-addons_page_`. |
| **PASS** | Debug Residue | All modified files | Check for `var_dump`, `console.log`, `error_log` | ✅ **Clean:** Zero debug statements introduced. |

---

## 3. 🛡️ Org & WordPress Standards Compliance

- [x] **Nonce Verification:** Settings and metabox handlers maintain standard nonce verification (`check_ajax_referer` / `wp_verify_nonce`).
- [x] **User Permissions & Capabilities:** Metabox saving strictly checks `current_user_can( 'edit_post', $post_id )` and ignores autosaves/revisions. Options check `manage_options`.
- [x] **Input Sanitization:** Metabox save safely applies `wp_kses_post` to support rich text without accepting script injection.
- [x] **Output Escaping:** Form ID escaped with `esc_attr( $cfform->id() )`. Styler CSS sanitized with `wp_kses_post( $ua_custom_css )`. Form container output documented with proper PHPCS ignore annotation.
- [x] **Database Hygiene:** No direct database queries or raw SQL modified in these commits.
- [x] **Debug Hygiene:** No active `var_dump()`, `print_r()`, `console.log()`, or `die()` left behind.
- [x] **Internationalization (i18n):** Menu title translated via `__( 'UACF7 Addons', 'ultimate-addons-for-contact-form-7' )`.

---

## 4. ⚠️ Conflict & Regression Risk Analysis Matrix

| UACF7 Core Module | Modified in this Push? | Regression Risk Level | Analysis & Verdict |
| :--- | :---: | :---: | :--- |
| **Menu & Admin Navigation** | **Yes** | **Low** | Menu title updated to "UACF7 Addons". All dependent admin screen hooks were synchronously updated. |
| **CF7 Form Styler** | **Yes** | **Low** (Fixes High-Severity Bug) | Fixes major bug where `wp_kses_post()` previously stripped form inputs. Restores native CF7 form controls. |
| **Metabox Options / Field Save** | **Yes** | **Low** | Allows rich text formatting in metaboxes. `wp_kses_post` prevents XSS while preserving legitimate HTML. |
| **Database Entries Viewer** | **Yes** (Hook/CSS only) | **Low** | CSS selector and enqueue hook updated to `uacf7-addons_page_ultimate-addons-db`. Style rules and scripts load correctly. |
| **PDF Generator Addon** | **Yes** (Hook only) | **Low** | Enqueue hook updated to `uacf7-addons_page_ultimate-addons-db`. Script only loads on target database screen. |
| **PRO Plugin Compatibility** | Verified in PRO repo | **Low** | The PRO repository has already updated corresponding screen hooks to `uacf7-addons_page_*`. |

---

## 5. 🧪 Manual QA Testing Checklist

Please execute these manual checks in a staging WordPress environment before merging to production:

### 1. Admin Menu & Page Navigation
- [ ] Log in as Administrator and check the WordPress admin left-hand menu.
- [ ] Confirm the menu item now reads **"UACF7 Addons"** (previously "UACF7").
- [ ] Click into **UACF7 Addons -> All Addons**:
  - Verify that the Addons page loads with full styles and toggle switches work.
  - Check browser DevTools Console (`F12`) to verify no missing JS/CSS (HTTP 404 or JS errors).
- [ ] Click into **UACF7 Addons -> Database**:
  - Verify modern table styles load correctly (background color `#f0eef6` and zero left-padding).
  - Check that DataTables and PDF export scripts are loaded.

### 2. CF7 Styler Addon Form Rendering
- [ ] Open or create a Contact Form 7 form with standard fields (text, email, dropdown, checkboxes, submit button).
- [ ] Enable and configure styling under the **UACF7 Styler** tab.
- [ ] Embed the form shortcode on a test page and view it on the frontend.
- [ ] **Crucial Verification:** Confirm all `<input>`, `<textarea>`, `<select>`, and `<button>` elements render properly and are NOT stripped or missing.
- [ ] Submit a test entry to ensure submission completes successfully.

### 3. Metabox Rich Text / WYSIWYG Editor Save
- [ ] Navigate to an admin section containing a UACF7 rich text editor / metabox field (e.g., conditional field messages, custom text templates).
- [ ] Insert formatted text with bold (`<strong>`), links (`<a>`), and lists (`<ul><li>`).
- [ ] Click **Save / Update**.
- [ ] Reload the page and verify that the HTML formatting persists and is not stripped to plain text.
