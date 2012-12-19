# Throttle

A PHP function that can be used to throttle any actions you want, as to prevent flooding.

Personally, I've found this script to work best with Ajax requests, but truly, you can use it for almost anything.

## Usage

```php
$canPost = true;

rateThrottle(array(
	'throttleKey' 	=> $throttleKey,
	'id'        	=> 'submit-comment',
	'timeout'   	=> 60,	// Throttle user for 60 seconds
	'passes'    	=> 3,	// if they attemps this action MORE than 3 times
	'interval'  	=> 15,	// within 15 seconds
	'throttled' 	=> function($seconds){ // They've been throttled
		$canPost = false;
		$timeLeft = $seconds;
	}
));

if(!$canPost){
	echo "Hey, you're posting to quickly. Try again in $timeLeft seconds.";
} else {
	// Post Comment
}

```

## Ajax Usage

```php
rateThrottle(array(
	'throttleKey' 	=> $throttleKey,
	'id'        	=> 'submit-comment',
	'timeout'   	=> 60,	// Throttle user for 60 seconds
	'passes'    	=> 3,	// if they attemps this action MORE than 3 times
	'interval'  	=> 15,	// within 15 seconds
	'throttled' 	=> function($seconds){ // They've been throttled
		echo json_encode(array(
			'success' => false,
			'reason' => "Hey, you're posting to quickly. Try again in $timeLeft seconds."
		)); die();
	}
));

// Submit Comment

```

## Parameters

* `throttleKey`: String, an identifier/key for the throttler to work with in the `$_SESSION` array
* `id`: String, unique identifier for whatever action you're performing, so the throttler can keep track of multiple actions
* `timeout`: Int, the length in seconds to disallow the user from doing an action if they have been throttled
* `passes`: Int, number of times the user can do this action BEFORE they are throttled
* `interval`: Int, number of seconds a user must do action in in order to be throttled
* `throttled`: Function, the function that will be executed if the user has been throttled. Number of seconds left of timeout is passed as a parameter.

## Licensing
`````
Copyright (c) 2012 Jacob Kelley, @jakiestfu, http://jakiestfu.com

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
`````
