<?php 
defined( 'ABSPATH' ) || exit;
ob_clean();
echo '<label> Your name 
    [text* your-name autocomplete:name] </label>
<label> Your email 
[email* your-email autocomplete:email] </label> 
<label> Subject
    [text* your-subject] </label> 
<label> Your message (optional)
    [textarea your-message] </label> 
[submit "Submit"] '; 
return ob_get_clean();
?>