<?php
if (!defined('ABSPATH')) {
  exit;
}
class UACF7_MAILCHIMP
{

  public $mailchimlConnection = '';
  public static $mailchimp = null;
  private $mailchimp_api = '';

  public function __construct()
  {
    require_once('inc/functions.php');
    add_action('wpcf7_editor_panels', array($this, 'uacf7_cf_add_panel'));
    add_action('uacf7_admin_tab_button', array($this, 'add_mailchimp_tab'), 10);
    add_action('uacf7_admin_tab_content', array($this, 'add_mailchimp_tab_content'));
    add_action('admin_enqueue_scripts', array($this, 'admin_scripts'));
    add_action("wpcf7_before_send_mail", array($this, 'send_data'));
    add_action('wpcf7_after_save', array($this, 'uacf7_save_contact_form'));

    $this->get_api_key();
  }

  //Internet check
  public static function is_connected()
  {
    $connected = @fsockopen("www.example.com", 80);
    if ($connected) {
      return true;
      fclose($connected);
    } else {
      return false;
    }
  }

  public function get_api_key() {
    
    $mailchimp_options = get_option('uacf7_mailchimp_option_name');

    if( is_array($mailchimp_options) && !empty($mailchimp_options) ) {
      return $this->$mailchimp_api = $mailchimp_options['uacf7_mailchimp_api_key'];
    }

    $this->mailchiml_connection();

  }

  public function mailchiml_connection()
  {

    $api_key = $this->$mailchimp_api;

    if ($api_key != '') {

      $response = $this->set_config($api_key, 'ping');
      $response = json_decode($response);

      if (isset($response->health_status)) { //Display success message
        $this->$mailchimlConnection = true;
      } else {
        $this->$mailchimlConnection = false;
      }
    }
  }


  private function set_config($api_key = '', $path = '')
  {

    $url = "https://us20.api.mailchimp.com/3.0/$path";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
      "Authorization: Bearer $api_key"
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);

    return $resp;
  }

  public function connection_status()
  {
    $api_key = $this->$mailchimp_api;

    if ($api_key != '') {

      $response = $this->set_config($api_key, 'ping');
      $response = json_decode($response);

      $status = '';
      $status .= '<span class="status-title"><strong>' . esc_html__('Status: ', 'ultimate-addons-cf7') . '</strong>';

      if ($this->is_connected() == false) { //Checking internet connection
        $status .= '<span class="status-error">' . esc_html__('Can\'t connect to the server. Please check internet connection.', 'ultimate-addons-cf7') . '</span>';
      }

      if (isset($response->health_status)) { //Display success message
        $status .= '<span class="status-success">' . esc_html($response->health_status) . '</span>';
      }

      if (isset($response->title)) { //Display error title
        $status .= '<span class="status-error">' . esc_html($response->title) . '</span>';
      }

      $status .= '</span>';

      if (isset($response->detail)) { //Display error mdetails
        $status .= '<span class="status-details status-error">' . esc_html($response->detail) . '</span>';
      }
    } else {
      $status .= '<span class="status-details">' . esc_html('Please enter your Mailchimp API key.', 'ultimate-addons-cf7') . '</span>';
    }

    return $status;
  }

  public function add_mailchimp_tab()
  {
?>
    <a class="tablinks" onclick="uacf7_settings_tab(event, 'uacf7_mailchimp')">Mailchimp</a>
  <?php
  }

  public function add_mailchimp_tab_content()
  {
  ?>
    <div id="uacf7_mailchimp" class="uacf7-tabcontent uacf7-mailchimp">

      <form method="post" action="options.php">
        <?php
        settings_fields('uacf7_mailchimp_option');
        do_settings_sections('ultimate-mailchimp-admin');
        submit_button();
        ?>
      </form>

    </div>
  <?php
  }

  //Create tab panel

  public function uacf7_cf_add_panel($panels)
  {

    $panels['uacf7-mailchimp-panel'] = array(
      'title'    => __('UACF7 Mailchimp', 'ultimate-addons-cf7'),
      'callback' => array($this, 'uacf7_create_mailchimp_panel_fields'),
    );
    return $panels;
  }

  public function uacf7_create_mailchimp_panel_fields($post)
  {
  ?>
    <fieldset>
      <div class="ultimate-mailchimp-admin">
        <div class="ultimate-mailchimp-wrapper">

          <?php
          echo $this->connection_status();
          ?>
          <?php
          $form_enable = get_post_meta( $post->id(), 'uacf7_mailchimp_form_enable', true );
          $form_type = get_post_meta( $post->id(), 'uacf7_mailchimp_form_type', true );
          $audience = get_post_meta( $post->id(), 'uacf7_mailchimp_audience', true );
          $subscriber_email = get_post_meta( $post->id(), 'uacf7_mailchimp_subscriber_email', true );
          $subscriber_fname = get_post_meta( $post->id(), 'uacf7_mailchimp_subscriber_fname', true );
          $subscriber_lname = get_post_meta( $post->id(), 'uacf7_mailchimp_subscriber_lname', true );
          $uacf7_mailchimp_merge_fields = empty(get_post_meta( $post->id(), 'uacf7_mailchimp_merge_fields', true )) ? array() : get_post_meta( $post->id(), 'uacf7_mailchimp_merge_fields', true );
          
          ?>
          <div class="mailchimp_fields_row">
            <h3>Mailchimp form settings</h3>
            <label for="uacf7_mailchimp_form_enable">
              <input id="uacf7_mailchimp_form_enable" type="checkbox" value="enable" name="uacf7_mailchimp_form_enable" <?php checked( $form_enable, 'enable', true ); ?>> <strong>Enable mailchimp form</strong>
            </label>
          </div>
          <br>
          <br>
          <div class="mailchimp_fields_row">
            <label>
              <input type="radio" name="uacf7_mailchimp_form_type" checked="checked" value="subscribe" <?php checked( $form_type, 'subscribe', true ); ?>> <strong>Create Subscribe Form</strong>
            </label><br>
            <label>
              <input type="radio" name="uacf7_mailchimp_form_type" value="unsubscribe" <?php checked( $form_type, 'unsubscribe', true ); ?>> <strong>Create Unsubscribe Form</strong>
            </label>
          </div>
          <br>
          <br>
          <div class="mailchimp_fields_row">

            <label for="uacf7_mailchimp_audience">
              <strong>Select Audience</strong><br>
              <select name="uacf7_mailchimp_audience" id="uacf7_mailchimp_audience">
                <?php
                $api_key = $this->$mailchimp_api;

                if ($api_key != '') {

                  $response = $this->set_config($api_key, 'lists');

                  //$response = json_encode($response);
                  $response = json_decode($response, true);
                  $x = 0;
                  foreach ($response['lists'] as $list) {
                    echo '<option value="' . $list['id'] . '" '.selected( $audience, $list['id'] ).'>' . $list['name'] . '</option>';

                    $x++;
                  }
                } else {
                }
                ?>
              </select>
            </label>
          </div>
          <br>
          <br>
          <div class="mailchimp_fields_row">

            <table>
              <tr>
                <td>
                  <label for="uacf7_mailchimp_subscriber_email">
                    <strong>Subscriber Email</strong><br>
                    <select name="uacf7_mailchimp_subscriber_email" id="uacf7_mailchimp_subscriber_email">
                      <?php
                      $all_tags = $post->scan_form_tags(array('type' => 'email', 'type' => 'email*'));
                      foreach ($all_tags as $tag) {
                        echo '<option value="' . esc_attr($tag['name']) . '" '.selected( $subscriber_email, $tag['name'] ).'>' . esc_attr($tag['name']) . '</option>';
                      }
                      ?>
                    </select>
                  </label>
                </td>
                <td>
                  <label for="uacf7_mailchimp_subscriber_fname">
                    <strong>Subscriber First Name</strong><br>
                    <select name="uacf7_mailchimp_subscriber_fname" id="uacf7_mailchimp_subscriber_fname">
                      <?php
                      $fname_tags = $post->scan_form_tags(array('type' => 'text', 'type' => 'text*'));
                      foreach ($fname_tags as $tag) {
                        echo '<option value="' . esc_attr($tag['name']) . '" '.selected( $subscriber_fname, $tag['name'] ).'>' . esc_attr($tag['name']) . '</option>';
                      }
                      ?>
                    </select>
                  </label>
                </td>
                <td>
                  <label for="uacf7_mailchimp_subscriber_lname">
                    <strong>Subscriber Last Name</strong><br>
                    <select name="uacf7_mailchimp_subscriber_lname" id="uacf7_mailchimp_subscriber_lname">
                      <?php
                      $lname_tags = $post->scan_form_tags(array('type' => 'text', 'type' => 'text*'));
                      foreach ($lname_tags as $tag) {
                        echo '<option value="' . esc_attr($tag['name']) . '" '.selected( $subscriber_lname, $tag['name'] ).'>' . esc_attr($tag['name']) . '</option>';
                      }
                      ?>
                    </select>
                  </label>
                </td>
              </tr>
              <tr>
                <td><h3>Custom fields</h3></td>
              </tr>
              
              <?php
              $all_fields = $post->scan_form_tags();
              $x = 1;
              foreach( $all_fields as $field ){
                if( $field['type'] != 'submit' ){
                  $cf7_tag = $uacf7_mailchimp_merge_fields[$x]['mailtag'];
                  $mergefield = $uacf7_mailchimp_merge_fields[$x]['mergefield'];
                ?>
                <tr>
                  <td>
                    <label><strong>Contact form tag</strong><br>
                      <select name="uacf7_mailchimp_extra_field_mailtag_<?php echo esc_attr($x); ?>">
                        <?php
                        foreach ($all_fields as $tag) {
                          if( $tag['type'] != 'submit' ){
                            echo '<option value="' . esc_attr($tag['name']) . '" '.selected( $cf7_tag, $tag['name'] ).'>' . esc_attr($tag['name']) . '</option>';
                          }
                        }
                        ?>
                      </select>
                    </label>
                  </td>
                  <td>
                    <label> <strong>Mailchimp field</strong><br>
                        <input type="text" placeholder="Please enter mailchimp custom field name" name="uacf7_mailchimp_extra_field_mergefield_<?php echo esc_attr($x); ?>" value="<?php echo esc_attr($mergefield); ?>">
                    </label>
                  </td>
                </tr>
                <?php
                $x++;
                }
              }
              ?>

            </table>

          </div>

          <?php wp_nonce_field('uacf7_mailchimp_nonce_action', 'uacf7_mailchimp_nonce'); ?>

        </div>
      </div>
    </fieldset>
<?php
  }

  public function uacf7_save_contact_form($post)
  {
    if (!isset($_POST) || empty($_POST)) {
      return;
    }

    if (!wp_verify_nonce($_POST['uacf7_mailchimp_nonce'], 'uacf7_mailchimp_nonce_action')) {
      return;
    }

    update_post_meta( $post->id(), 'uacf7_mailchimp_form_enable', esc_attr($_POST['uacf7_mailchimp_form_enable']) );
    update_post_meta( $post->id(), 'uacf7_mailchimp_form_type', esc_attr($_POST['uacf7_mailchimp_form_type']) );
    update_post_meta( $post->id(), 'uacf7_mailchimp_audience', esc_attr($_POST['uacf7_mailchimp_audience']) );
    update_post_meta( $post->id(), 'uacf7_mailchimp_subscriber_email', esc_attr($_POST['uacf7_mailchimp_subscriber_email']) );
    update_post_meta( $post->id(), 'uacf7_mailchimp_subscriber_fname', esc_attr($_POST['uacf7_mailchimp_subscriber_fname']) );
    update_post_meta( $post->id(), 'uacf7_mailchimp_subscriber_lname', esc_attr($_POST['uacf7_mailchimp_subscriber_lname']) );

    $all_fields = $post->scan_form_tags();
    $x = 1;
    $data = [];
    foreach( $all_fields as $field ) {
      if( $field['type'] != 'submit' ){
        if( !empty( $_POST['uacf7_mailchimp_extra_field_mailtag_'.$x] ) && !empty( $_POST['uacf7_mailchimp_extra_field_mergefield_'.$x] ) ){

          $data[$x] = array(
            'mailtag' => sanitize_text_field($_POST['uacf7_mailchimp_extra_field_mailtag_'.$x]),
            'mergefield' => sanitize_text_field($_POST['uacf7_mailchimp_extra_field_mergefield_'.$x])
          );

        }

        $x++;
      }
    }

    update_post_meta( $post->id(), 'uacf7_mailchimp_merge_fields', $data );

  }

  public function add_members( $id, $audience, $posted_data ) {

    $api_key = $this->$mailchimp_api;

    $subscriber_email = get_post_meta( $id, 'uacf7_mailchimp_subscriber_email', true );
    $subscriber_email = !empty($subscriber_email) ? $posted_data[$subscriber_email] : '';

    if( $this->$mailchimlConnection == true && $api_key != '' && $subscriber_email != '' ) {

      $subscriber_fname = get_post_meta( $id, 'uacf7_mailchimp_subscriber_fname', true );
      $subscriber_fname = !empty($subscriber_fname) ? $posted_data[$subscriber_fname] : '';

      $subscriber_lname = get_post_meta( $id, 'uacf7_mailchimp_subscriber_lname', true );
      $subscriber_lname = !empty($subscriber_lname) ? $posted_data[$subscriber_lname] : '';

      $extra_fields = empty(get_post_meta( $id, 'uacf7_mailchimp_merge_fields', true )) ? array() : get_post_meta( $id, 'uacf7_mailchimp_merge_fields', true );
      
      $extra_merge_fields = '';
      foreach( $extra_fields as $extra_field ){
        $extra_merge_fields .= '"'.$extra_field['mergefield'] . '": "' . $posted_data[$extra_field['mailtag']].'",';
      }
      $extra_merge_fields = trim($extra_merge_fields,',');

      if( $extra_merge_fields != '' ){
        $extra_merge_fields = ','.$extra_merge_fields;
      }

      $url = "https://us20.api.mailchimp.com/3.0/lists/".$audience."/members";

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      $headers = array(
        "Authorization: Bearer $api_key",
        "Content-Type: application/json",
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

      //Mailchimp data
      $data = '{"email_address":"'.sanitize_text_field($subscriber_email).'","status":"subscribed","merge_fields":{"FNAME": "'.sanitize_text_field($subscriber_fname).'", "LNAME": "'.sanitize_text_field($subscriber_lname).'", "COMMENT" : "'.sanitize_text_field($extra_merge_fields).'"},"vip":false,"location":{"latitude":0,"longitude":0}}';
      
      curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

      //for debug only!
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

      $resp = curl_exec($curl);
      curl_close($curl);
      return $resp;
    }

  }

  public function send_data($cf7)
  {
    // get the contact form object
    $wpcf = WPCF7_Submission::get_instance();

    $posted_data = $wpcf->get_posted_data();

    $id = $cf7->id();
    
    $form_enable = get_post_meta( $id, 'uacf7_mailchimp_form_enable', true );
    $form_type = get_post_meta( $id, 'uacf7_mailchimp_form_type', true );
    $audience = get_post_meta( $id, 'uacf7_mailchimp_audience', true );

    if( $form_enable == 'enable' && $form_type == 'subscribe' && $audience != '' ){

      //$wpcf->skip_mail = true;
      $response = $this->add_members( $id, $audience, $posted_data );
      
    }
  }

  //Enqueue admin scripts
  public function admin_scripts()
  {
    wp_enqueue_style('mailchimp-css', UACF7_ADDONS . '/mailchimp/assets/css/admin-style.css');
  }
}
new UACF7_MAILCHIMP();
