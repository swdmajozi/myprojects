<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Payfast extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

        $this->load->library('grocery_CRUD');
        $this->load->model('Customers_model');
	}

public function itn()
{



    //let  check  if  its  eveen  get  here and  do  a  small  insert  




    define( 'PAYFAST_SERVER', 'TEST' );
    define( 'USER_AGENT', 'Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)' );
    define( 'PF_ERR_AMOUNT_MISMATCH', 'Amount mismatch' );
    define( 'PF_ERR_BAD_SOURCE_IP', 'Bad source IP address' );
    define( 'PF_ERR_CONNECT_FAILED', 'Failed to connect to PayFast' );
    define( 'PF_ERR_BAD_ACCESS', 'Bad access of page' );
    define( 'PF_ERR_INVALID_SIGNATURE', 'Security signature mismatch' );
    define( 'PF_ERR_CURL_ERROR', 'An error occurred executing cURL' );
    define( 'PF_ERR_INVALID_DATA', 'The data received is invalid' );
    define( 'PF_ERR_UKNOWN', 'Unkown error occurred' );
    define( 'PF_MSG_OK', 'Payment was successful' );
    define( 'PF_MSG_FAILED', 'Payment has failed' );
    header( 'HTTP/1.0 200 OK' );
    flush();
    $pfError = false;
    $pfErrMsg = '';
    $filename = 'notify.txt';
    $output = '';
    $pfParamString = '';
    $pfHost = ( PAYFAST_SERVER == 'LIVE' ) ?
    'www.payfast.co.za' : 'sandbox.payfast.co.za';
    $pfData = [];

    if( !$pfError )
    {
        $output = $_POST;
        foreach( $_POST as $key => $val )
            $pfData[$key] = stripslashes( $val );

        foreach( $pfData as $key => $val )
        {
            if( $key != 'signature' )
                $pfParamString .= $key .'='. urlencode( $val ) .'&';
        }

        $pfParamString = substr( $pfParamString, 0, -1 );
        $pfTempParamString = $pfParamString;

        $passPhrase = 'RePaw96FgpGh';
        if( !empty( $passPhrase ) )
        {
            $pfTempParamString .= '&passphrase='.urlencode( $passPhrase );
        }
        $signature = md5( $pfTempParamString );

        $result = ( $_POST['signature'] == $signature );

        $output .= "Security Signature:\n\n";
        $output .= "- posted     = ". $_POST['signature'] ."\n";
        $output .= "- calculated = ". $signature ."\n";
        $output .= "- result     = ". ( $result ? 'SUCCESS' : 'FAILURE' ) ."\n";
        echo "<pre>";
        var_dump($output);
        echo "</pre>";
        die();
    }

    if( !$pfError )
    {
        $validHosts = array(
            'www.payfast.co.za',
            'sandbox.payfast.co.za',
            'w1w.payfast.co.za',
            'w2w.payfast.co.za',
            );

        $validIps = array();

        foreach( $validHosts as $pfHostname )
        {
            $ips = gethostbynamel( $pfHostname );

            if( $ips !== false )
                $validIps = array_merge( $validIps, $ips );
        }
        $validIps = array_unique( $validIps );

        if( !in_array( $_SERVER['REMOTE_ADDR'], $validIps ) )
        {
            $pfError = true;
            $pfErrMsg = PF_ERR_BAD_SOURCE_IP;
        }
    }

    if( !$pfError )
    {
        if( function_exists( 'curl_init' ) )
        {
            $output .= "\n\nUsing cURL\n\n";
            $ch = curl_init();
            $curlOpts = array(
                CURLOPT_USERAGENT => USER_AGENT,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HEADER => false,
                CURLOPT_SSL_VERIFYHOST => 2,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_URL => 'https://'. $pfHost . '/eng/query/validate',
                CURLOPT_POST => true,
                CURLOPT_POSTFIELDS => $pfParamString,
                );
            curl_setopt_array( $ch, $curlOpts );
            $res = curl_exec( $ch );
            curl_close( $ch );

            if( $res === false )
            {
                $pfError = true;
                $pfErrMsg = PF_ERR_CURL_ERROR;
            }
        }
        else
        {
            $output .= "\n\nUsing fsockopen\n\n";
            $header = "POST /eng/query/validate HTTP/1.0\r\n";
            $header .= "Host: ". $pfHost ."\r\n";
            $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
            $header .= "Content-Length: " . strlen( $pfParamString ) . "\r\n\r\n";
            $socket = fsockopen( 'ssl://'. $pfHost, 443, $errno, $errstr, 10 );
            fputs( $socket, $header . $pfParamString );
            $res = '';
            $headerDone = false;

            while( !feof( $socket ) )
            {
                $line = fgets( $socket, 1024 );
                if( strcmp( $line, "\r\n" ) == 0 )
                {
                    $headerDone = true;
                }
                else if( $headerDone )
                {
                    $res .= $line;
                }
            }
        }
    }

    if( !$pfError )
    {
        $lines = explode( "\n", $res );
        $output .= "\n\nValidate response from server:\n\n";
        foreach( $lines as $line )
            $output .= $line ."\n";
    }

    if( !$pfError )
    {
        $result = trim( $lines[0] );
        $output .= "\nResult = ". $result;

        if( strcmp( $result, 'VALID' ) == 0 )
        {

        }
        else
        {
            $pfError = true;
            $pfErrMsg = PF_ERR_INVALID_DATA;
        }
    }

    if( $pfError )
    {
        $output .= "\n\nAn error occurred!";
        $output .= "\nError = ". $pfErrMsg;
    }

    echo "<pre>";
    var_dump($pfError);
    echo "</pre>";
    file_put_contents( $filename, $output );
}


}