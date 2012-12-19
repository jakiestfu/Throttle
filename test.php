<?PHP 

session_start();

require('throttle.php');


if(isset($_GET['postComment'])){
	throttle(array(
		'throttleKey' 	=> 'rateLimitYo',
		'id'        	=> 'submit-comment', // ID for the action you're trying to accomplish
		'timeout'   	=> 60,	// Throttle user for 60 seconds
		'passes'    	=> 3,	// if they attemps this action MORE than 3 times
		'interval'  	=> 15,	// within 15 seconds
		'throttled' 	=> function($seconds){ // They've been throttles
			die("Cannot login, you've been throttled, baby. ".$seconds." seconds left. <a href=\"javascript:window.location.reload()\">Refresh</a>");
		}
	));
	// Continue Code
}


?><!doctype html>
<html lang="en">
	<head>
		<title>Throttle Test</title>
	</head>
	<body>
		<p>Here is an example of the rate throttler. If you click "Submit Comment" link below <b>more</b> than 3 times within 15 seconds, you will see a message throttling you for 60 seconds.</p>
		<a href="?postComment">Submit Comment</a>
		<?PHP echo '<pre>'.print_r($_SESSION, true).'</pre>'; ?>
	</body>
</html>
