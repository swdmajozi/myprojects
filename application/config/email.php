<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
| Email Settings
| -------------------------------------------------------------------
| Configuration of outgoing mail server.
| */

// custom values from CI Bootstrap
$config['from_email'] = "noreply@icswebserver.co.za";
$config['from_name'] = "ICS Web APp";
$config['subject_prefix'] = "[Subscription] ";

// Mailgun API (to be used in Email Client library)
$config['mailgun'] = array(
	'domain'				=> 'richessemondiale.co.za',
	'private_api_key'		=> 'key-23f8751c09efa7bdf12675943898386a',
);