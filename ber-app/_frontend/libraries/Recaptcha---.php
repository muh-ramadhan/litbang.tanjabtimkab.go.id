<?php class Recaptcha {
	
	//Google verify URL
	private $captcha_url = "https://www.google.com/recaptcha/api/siteverify";
	
	//Keys
	//You can define your keys here or load them from the database in a __construct function if you have a admin panel to modify them
	public  $site_key = "6Lf1jx0TAAAAAARRcVYNy-fdXUKO1QVWqkF2iLXz";
	private $secret   = "6Lf1jx0TAAAAAOSF1qqncUt-P5oIIWT7vmz8IXXh";
	
	//Error store
	public $errors = "";
	
	//Error responses
	private $error_responses = array(
									 //No Capcha code entered
									 "missing-input-response" => "Captcha field is required!",
									 
									 //Invalid repsonse
									 "invalid-input-response" => "Invalid capcha",
									 
									 //Unknown response or valid to connect to Google service
									 "unknown-response" => "We could not validate your capture, please try again",
									 );
									 
	//Default error response
	private $default_error_response = "unknown-response";
	
	//All $this calls will now use the instance of CI by default
	//For more info see: http://codeigniterlab.com/using-this-inside-a-library/
	function __get($var)
	{
 	     return get_instance()->$var;
	} 
	
	function __construct()
	{
		//Get keys from database settings
		/*
		Example
		$this->site_key = $this->db->get_where("settings", array("setting_name" => "recaptcha_site_key"))->row()->setting;
		$this->secret = $this->db->get_where("settings", array("setting_name" => "recaptcha_secret"))->row()->setting;
		*/
	}
	
	//Validate
	public function validate($response)
	{
		//Clear current errors if any
		$this->errors = "";
		
		//If empty, return error now
		if(empty($response))
		{
			//Set error
			$this->set_error("missing-input-response");
			return false;
		}
		
		//Post to google server
		$fields = array(
						'secret'   => urlencode($this->secret),
						'response' => urlencode($response),
						'remoteip' => urlencode($_SERVER['REMOTE_ADDR'])
				       );
 
		//url-ify the data for the POST
		$post_string = http_build_query($fields);
 
		//Start curl
		$ch = curl_init();
		
		//Set URL, amoutn of fields and the post string
		curl_setopt($ch, CURLOPT_URL, $this->captcha_url);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		//Execute post
		$result = curl_exec($ch);
		
		//close connection
		curl_close($ch);
		
		//If result failed (NULL or FALSE)
		if(!$result)
		{
			//Set message
			$this->set_error("unknown-response");
			return false;	
		}
		
		//JSON decode result
		$data = json_decode($result, true);
		
		//Check repsonse from Google
		
		//Successful reply
		if(isset($data['success']) && $data['success'] == true)
		{
			//Captcha OK
			return true;
		}
		
		//Capcha failed
		$this->set_error("invalid-input-response");
		return false;
	}
	
	//Set error function, good to handle unkown error types
	private function set_error($type)
	{
		//Check type is in error_responses array
		if(!isset($this->error_responses[$type]))
		{
			//Use default
			$type = $this->default_error_response;
		}
		
		//Set error
		$this->errors = $this->error_responses[$type];			
	} 
}
 
 
 
 
 
 
?>