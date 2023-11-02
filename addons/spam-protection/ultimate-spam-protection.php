<?php
    if ( !defined( 'ABSPATH' ) ) {
        exit;
    }

    class UACF7_SPAM_PROTECTION{
        public function __construct(){
            require_once('inc/spam-protection.php');
        }
    }

    new UACF7_SPAM_PROTECTION();