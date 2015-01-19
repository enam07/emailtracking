<?php
/**
 * send.php
 * Used to send messages with tracking info to users
 * Has config.inc.php included for database information and file info
 * http://www.phpdevtips.com/2013/06/email-open-tracking-with-php-and-mysql
 *
 * @author Bennett Stone
 * @version 1.0
 * @date 07-Jun-2013
 * @website www.phpdevtips.com
 * @package Email Open Tracker
 **/

//Include the configuration file that has the MESSAGE_SENDER and THIS_WEBSITE_URI constants
require( 'config.inc.php' );

//Assign default empty variables for message output
$success = '';
$error = '';

//Only initiate the actual sending action IF the form is submitted
if( isset( $_POST['send'] ) && $_POST['send'] == 'Send' )
{
    
    //Assign the $_POST data to variables for continued usage
    $message = $_POST['message'];
    $subject = $_POST['subject'];
    $to = $_POST['recipient'];
    $from = MESSAGE_SENDER;
    
    //Since the tracking URL is a bit long, I usually put it in a variable of it's own
    $tracker = THIS_WEBSITE_URI . '/record.php?log=true&subject=' . urlencode( $subject ) . '&user=' . urlencode( $to );
	//$website = THIS_WEBSITE_URI;
    
    //Add the tracker to the message.
    $message .= '<img border="0" src="'.$tracker.'" width="1" height="1" />';
    
    //Since this must be HTML email, we'll need to set some headers
    //See "Example #4 Sending HTML email" at http://php.net/manual/en/function.mail.php
    $headers = "From: $from  <".$from.">\r\n";
    $headers.= "Return-Path: " . $from . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    //mail returns a bool which we can use to assign success or failure messages
    $send = mail( $to, $subject, $tracker, $headers );
    if( $send )
    {
        $success = 'Message sent with tracking!';
    }
    else
    {
        $error = 'Message send failure!';
    }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>

        <title>Email Open Tracker Example</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    
    </head>
    <body>
    
        <p>This is an example of how to effectively track email open rates.</p>
        
        <p>Configuration variables for this example are located in config.inc.php, and blank.gif is included for output.</p>
        
        <p>This example also uses the mysqli database class found here: <a href="http://www.phpdevtips.com/2013/06/updated-mysqli-database-class/" target="_blank" title="MySQLI Database class on PHP Dev tips">http://www.phpdevtips.com/2013/06/updated-mysqli-database-class/</a>, which database connections details included in config.inc.php, however, feel free to use any database connections/details you would like.</p>
        
        <p>The full article for this set of scripts is located at: <a href="http://www.phpdevtips.com/2013/06/email-open-tracking-with-php-and-mysql" title="Email open tracking with PHP and MySQL" target="_blank">http://www.phpdevtips.com/2013/06/email-open-tracking-with-php-and-mysql</a>
        
        <p>Of note: email open tracking only works with HTML emails as plain text emails (obviously) cannot retrieve graphics or other included file references.</p>
        
        <?php
        //Output success messages if they exist
        if( !empty( $success ) )
        {
            echo '<div class="success" style="background: green;padding: 15px;">' . $success . '</div>';
        }
        //Output error messages if they exist
        if( !empty( $error ) )
        {
            echo '<div class="error" style="background: red; padding: 15px;">' . $error . '</div>';
        }
        ?>
        <form action="" method="post">
        
            <p>
                <label>Subject (Used as the tracking identifier [usually used in the form of a message ID])</label>
                <input type="text" name="subject" value="" />
            </p>
            
            <p>
                <label>Message</label>
                <textarea name="message" rows="5" cols="15"></textarea>
            </p>
            
            <p>
                <label>Recipient Email</label>
                <input type="text" name="recipient" value="" />
            
            <p>
                <input type="submit" name="send" value="Send" />
            </p>
            
        </form>
    
    </body>
</html>