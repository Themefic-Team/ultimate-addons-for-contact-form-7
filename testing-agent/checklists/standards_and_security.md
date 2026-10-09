# Organization & WordPress Coding Standards Checklist

When auditing new code in Tourfic, evaluate every commit against these standards:

### 1. Security & Permissions
- **Nonces:** Every form submission (`<input type="hidden" name="tf_nonce">`) and AJAX action (`wp_ajax_*`) must verify a nonce with `check_ajax_referer()` or `wp_verify_nonce()`.
- **Capability Checks:** Administrative functions and settings modifications must check user capabilities using `current_user_can( 'manage_options' )` or appropriate capability.
- **REST Endpoints:** Any custom REST routes must declare a valid `permission_callback`.

### 2. Data Sanitization (Input)
- Text inputs: `sanitize_text_field( $_POST['field'] )`
- Textarea inputs: `sanitize_textarea_field( $_POST['notes'] )`
- Numbers/IDs: `absint( $_POST['post_id'] )` or `intval()`
- URLs: `esc_url_raw( $_POST['redirect_url'] )`
- Emails: `sanitize_email( $_POST['email'] )`
- Arrays: Arrays must be mapped and sanitized recursively.

### 3. Data Escaping (Output)
- HTML text: `esc_html( $text )`
- HTML attributes: `esc_attr( $attr )`
- URLs: `esc_url( $url )`
- Rich HTML / WYSIWYG: `wp_kses_post( $content )`
- JavaScript inline data: `wp_json_encode( $data )`

### 4. Database Hygiene
- **Never concatenate raw user input into SQL.**
- Always use `$wpdb->prepare()`, for example:
  ```php
  $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$wpdb->prefix}tf_order WHERE post_id = %d", $post_id ) );
  ```

### 5. Debugging Cleanliness
- No `var_dump()`, `print_r()`, `die()`, or `echo` used for debugging.
- No `console.log()` left behind in JavaScript assets.
- No hardcoded test credentials or API keys.

### 6. Internationalization (i18n)
- All user-facing strings must be wrapped in WordPress translation functions with the `'tourfic'` textdomain:
  - `__( 'Book Now', 'tourfic' )`
  - `_e( 'Search Hotels', 'tourfic' )`
  - `esc_html__( 'Please select a date', 'tourfic' )`
