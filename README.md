# Throttle

A PHP function that can be used to throttle any actions you want, as to prevent flooding.

Personally, I've found this script to work best with Ajax requests, but truly, you can use it for almost anything.

## Usage

```php
rateThrottle(array(
	'throttleKey' 	=> $throttleKey,
	'id'        	=> 'submit-comment',
	'timeout'   	=> 60,	// Throttle user for 60 seconds
	'passes'    	=> 3,	// if they attemps this action MORE than 3 times
	'interval'  	=> 15,	// within 15 seconds
	'throttled' 	=> function($seconds){ // They've been throttles
		die("Cannot login, you've been throttled, baby. ".$seconds." seconds left. <a href=\"javascript:window.location.reload()\">Refresh</a>");
	}
));
// Submit Comment code here
```
