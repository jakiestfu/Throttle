<?PHP

function throttle($opts){
  if(is_array($opts) && isset($opts['id']) && isset($opts['throttled'])){
	                
		$now = time();  
		extract($opts);
		
		$passes = (isset($passes)) ? $passes : 1;
		$timeout = (isset($timeout)) ? $timeout : 60;
		$interval = (isset($interval)) ? $interval : 20;
		$throttleKey = (isset($throttleKey)) ? $throttleKey : $throttleKey;
		
		if(isset($_SESSION[$throttleKey][$id]['allowed'])){
			
			$allowedTime = $now + ($timeout*60);
			$timeLeft = $now - $_SESSION[$throttleKey][$id]['allowed'];
			$secondsLeft = ($timeLeft*(-1));
			
			if($timeLeft<0){
		        $throttled($secondsLeft);
			} else {
		        unset($_SESSION[$throttleKey][$id]);
		        $_SESSION[$throttleKey][$id]['pass'] = 1;
		        $_SESSION[$throttleKey][$id]['setAt'] = $now;
		                
		        if($_SESSION[$throttleKey][$id]['pass']==($passes)){
		                $_SESSION[$throttleKey][$id]['allowed'] = $now + ($timeout);
		        }
			}
		} else {
		        
			if(!isset($_SESSION[$throttleKey][$id]['setAt'])) {
			    $_SESSION[$throttleKey][$id]['setAt'] = $now;
			} else {
		        if($now > ($_SESSION[$throttleKey][$id]['setAt']+$interval)){
	                unset($_SESSION[$throttleKey][$id]);
	                $_SESSION[$throttleKey][$id]['setAt'] = $now;
	                $_SESSION[$throttleKey][$id]['pass'] = 0;
		        }
			}
			
			if(isset($_SESSION[$throttleKey][$id]['pass'])){
		        $_SESSION[$throttleKey][$id]['pass']++;
			} else {
		        $_SESSION[$throttleKey][$id]['pass']=1;
			}
			
			if($_SESSION[$throttleKey][$id]['pass']==($passes)){
		        $_SESSION[$throttleKey][$id]['allowed'] = $now + ($timeout);
			}
		}
	}
}
