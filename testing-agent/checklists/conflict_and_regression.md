# Tourfic Feature Conflict & Regression Analysis Matrix

Use this matrix to determine if changes made in the latest commit could break or conflict with existing Tourfic functionality operating in production (`v2.23.5`).

---

### Core Module Breakdown

#### 1. Hotel / Room Booking Module (`tf_hotel`)
- **Key Functions:** Room availability check, datepicker ranges, adult/child price calculations, extra service add-ons.
- **Potential Conflicts:**
  - Changes to date calculation logic affecting booking calendars.
  - Changes to room capacity constraints causing false "sold out" or overbooking errors.
  - Modifying the hotel single template override structure.

#### 2. Tour / Activity Booking Module (`tf_tours`)
- **Key Functions:** Fixed / continuous tour dates, ticket type pricing (adult, child, infant), group size limits, custom itineraries.
- **Potential Conflicts:**
  - Date/time slot generation breaking recurring tour schedules.
  - Pricing filter alterations causing wrong total in cart.

#### 3. Apartment Rental Module (`tf_apartment`)
- **Key Functions:** Nightly booking, security deposits, cleaning fees, minimum/maximum stay requirements.
- **Potential Conflicts:**
  - Custom fee calculations colliding with WooCommerce tax settings.
  - Check-in/check-out time validation regressions.

#### 4. WooCommerce Cart & Checkout Integration
- **Key Functions:** `woocommerce_add_cart_item_data`, `woocommerce_calculate_totals`, `woocommerce_checkout_create_order_line_item`.
- **Potential Conflicts:**
  - Altering cart item metadata structure causing missing booking details in completed orders.
  - Price override filters failing when coupon codes or currency switchers are applied.
  - Session or cookie conflicts on AJAX cart updates.

#### 5. Search & Filter Bar
- **Key Functions:** Search shortcode, AJAX destination autocomplete, date range filters, price sliders.
- **Potential Conflicts:**
  - Database query alterations causing empty search results for existing published tours/hotels.
  - JavaScript conflict with third-party themes or page builders.

#### 6. Page Builder Widgets (Elementor & Gutenberg)
- **Key Functions:** Tourfic Elementor blocks, search forms, featured listings sliders.
- **Potential Conflicts:**
  - Changed widget control IDs breaking layouts on already-built live pages.
