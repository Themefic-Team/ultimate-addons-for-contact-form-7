<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class UACF7_MAILCHIMP {

  public static $mailchimlConnection;
  public static $mailchimp = null;

  public function __construct() {
    require_once('inc/functions.php');
    add_action( 'wpcf7_editor_panels', array( $this, 'uacf7_cf_add_panel' ) );
    add_action( 'uacf7_admin_tab_button', array( $this, 'add_mailchimp_tab' ), 10 );
    add_action( 'uacf7_admin_tab_content', array( $this, 'add_mailchimp_tab_content' ) );

    if( $this->is_connected() == true ){
      require_once('vendor/autoload.php');
    }
  }

  //Internet check
  public static function is_connected() {
    $connected = @fsockopen("www.example.com", 80);
    if($connected) {
       return true;
       fclose($connected);
    } else {
      return false;
    }
  
  }

  private function mailchimp(){
    
    if( $this->is_connected() == true ){
      $mailchimp = new \MailchimpMarketing\ApiClient();
      $this->$mailchimp = $mailchimp;
    }
    
  }

  private function set_config($api_key) {
    
   /*  $mailchimp->setConfig([
      'apiKey' => $api_key,
      'server' => 'us20'
    ]);

    $response = $mailchimp->ping->get();
 */

    $url = "https://us20.api.mailchimp.com/3.0/ping";

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $headers = array(
      "Authorization: Bearer $api_key",
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    //for debug only!
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    $resp = curl_exec($curl);
    curl_close($curl);

    return $resp;

  }

  public function connection_status() {
    $api_key = '3e9461b86e36ff4cc339de9152617be5-us20';
    $response = $this->set_config($api_key);

    if( $response ){
      //$this->$mailchimlConnection = true;
      return $response;
    }
    
  }

  public function add_mailchimp_tab(){
    ?>
    <a class="tablinks" onclick="uacf7_settings_tab(event, 'uacf7_mailchimp')">Mailchimp</a>
    <?php
  }

  public function add_mailchimp_tab_content(){
    ?>
    <div id="uacf7_mailchimp" class="uacf7-tabcontent uacf7-mailchimp">
			
    <form method="post" action="options.php">
        <?php
        echo $this->connection_status();

            settings_fields( 'uacf7_mailchimp_option' );
            do_settings_sections( 'ultimate-mailchimp-admin' );
            submit_button();
        ?>
    </form>

    </div>
    <?php
  }
 
  //Create tab panel
 
  public function uacf7_cf_add_panel( $panels ) {

    $panels['uacf7-cf-panel'] = array(
      'title'    => __( 'UACF7 Mailchimp', 'ultimate-addons-cf7' ),
      'callback' => array( $this, 'uacf7_create_conditional_panel_fields' ),
    );
    return $panels;
  }

  public function uacf7_create_conditional_panel_fields( $post ) {
    
  }

}
new UACF7_MAILCHIMP();




if( UACF7_MAILCHIMP::is_connected() == true ){
  echo '<h1>---------------Connection is in a normal state</h1>';
}else {
  echo '<h1>---------------Connection is not normal state</h1>';
  return;
}


$mailchimp = new \MailchimpMarketing\ApiClient();

$mailchimp->setConfig([
	'apiKey' => '3e9461b86e36ff4cc339de9152617be5-us20',
	'server' => 'us20'
]);

$response = $mailchimp->ping->get();

print_r($response);
//print_r($mailchimp->lists->getAllLists());
//$response = $mailchimp->root->getRoot();

$list_id = "ba14564c81";


//member status Check
$email = "xixmdraihan1443@gmail.com";

$response = $mailchimp->searchMembers->search($email);

$exist_subscriber = $response->exact_matches->total_items;

if( $exist_subscriber == 0 ) {
  //$subscriber_hash = md5(strtolower($email));

  /* try {
      $response = $mailchimp->lists->getListMember($list_id, $subscriber_hash);
      print_r($response);
  } catch (MailchimpMarketing\ApiException $e) {
      echo $e->getMessage();
  } */

try {
    $response = $mailchimp->lists->addListMember($list_id, [
        "email_address" => $email,
        "status" => "subscribed",
        "merge_fields" => [
          "FNAME" => "Prudence",
          "LNAME" => "McVankab",
          "COMMENT" => "My first comment"
        ]
    ]);
    print_r($response);
} catch (MailchimpMarketing\ApiException $e) {
    echo $e->getMessage();
}

}


//$response = $mailchimp->ping->get();
//$response = $mailchimp->root->getRoot();
/* $response = $mailchimp->campaigns->create(["type" => "absplit"]);
print_r($response); */

//$mailchimp->lists->createList(array("name" => "MD Raihan","email_type_option" => false));

//return;

/* try {
    $response = $mailchimp->lists->createList([
      "name" => "MD Raihan",
      "permission_reminder" => "permission_reminder",
      "email_type_option" => false,
      "contact" => [
        "company" => "Mailchimp",
        "address1" => "675 Ponce de Leon Ave NE",
        "city" => "Atlanta",
        "state" => "GA",
        "zip" => "30308",
        "country" => "US",
      ],
      "campaign_defaults" => [
        "from_name" => "Gettin' Together",
        "from_email" => "gettingtogether@example.com",
        "subject" => "PHP Developer's Meetup",
        "language" => "EN_US",
      ],
    ]);
    print_r($response);
  } catch (MailchimpMarketing\ApiException $e) {
    echo $e->getMessage();
  }
 */


