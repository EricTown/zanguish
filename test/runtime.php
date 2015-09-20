<?php
   
   /**
    * Page execution time
    * Test code performance
    */
	class runtime  
	{  
	    var $StartTime = 0;  
	    var $StopTime = 0;  
	   
	    function get_microtime()  
	    {  
	        list($usec, $sec) = explode(' ', microtime());  
	        return ((float)$usec + (float)$sec);  
	    }  
	   
	    function start()  
	    {  
	        $this->StartTime = $this->get_microtime();  
	    }  
	   
	    function stop()  
	    {  
	        $this->StopTime = $this->get_microtime();  
	    }  
	   
	    function spent()  
	    {  
	        return round(($this->StopTime - $this->StartTime) * 1000, 2);  
	    }  
	   
	}  
	   
	   
	//example  
	$runtime= new runtime;  
	$runtime->start();  
	   
	/*============coding-start==========*/  
	   
	$a = 0;  
	for($i=0; $i<1000000; $i++)  
	{  
	    $a += $i;  
	}  
	
	// echo time();
	
	// echo $_SERVER['REQUEST_TIME'];
	
	/*============coding-end=================*/
	   
	$runtime->stop();  
	echo "Page execution time: ".$runtime->spent()." Millisecond";  

?> 
