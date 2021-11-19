<?php 

class WS_Curl
{
    var $endpointUrl;
    var $userId;
    var $userName;
    var $userKey;
    var $token;
    var $curl_handler;

    public $followers_arr = array();

    var $defaults = array(
        CURLOPT_HEADER => 0,
        // CURLOPT_FRESH_CONNECT => 1,
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_TIMEOUT => 10,
        CURLOPT_SSL_VERIFYPEER => false,	// ssl fix
        CURLOPT_SSL_VERIFYHOST => false	// ssl fix
    );

    function __construct($url, $name, $key)
    {
        $this->endpointUrl=$url;
        $this->userId=0;
        $this->userName=$name;
        $this->userKey=$key;
        $this->token=0;
    }

    function getChallenge()
    {
        $curl_handler = curl_init();
        $params = array(
            'operation' => 'getChallenge',
            'username' => $this->userName,
        );
        $options = array(
            CURLOPT_URL => $this->endpointUrl."?".http_build_query($params)
        );
        curl_setopt_array($curl_handler,($this->defaults + $options));
        $results = curl_exec($curl_handler);
        
        if(!$results)
        {
            die(curl_error($curl_handler));
        }

        $jsonResp = json_decode($results,true);
        if($jsonResp['success']== false)
        {
            die("getChallenge failed: ".$jsonResp["error"]["message"]."<br>");
        }

        $challengeToken = $jsonResp["result"]["token"];

		return $challengeToken;

    }

    function login()
    {
        $curl_handler = curl_init();
        $token = $this->getChallenge();
        $genKey = md5($token.$this->userKey);

        $params = array(
            'operation' => 'login',
            'username' => $this->userName,
            'accessKey' => $genKey
        );
        
        $options = array(
            CURLOPT_URL => $this->endpointUrl,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => http_build_query($params)
        );

        curl_setopt_array($curl_handler,$this->defaults + $options);
        $result = curl_exec($curl_handler);
        if(!$result)
        {
            die(curl_error($curl_handler));
        }
        
        $jsonResp = json_decode($result,true);

        $this->userId = $jsonResp['result']['userId'];

        if($jsonResp['success']== false)
        {
            die("Login failed: ".$jsonResp["error"]["message"]."<br>");
        }

        $sessionId = $jsonResp['result']['sessionName'];
        $this->token = $sessionId;
        $test = $this->token;
        // echo $sessionId;
        $objects = $jsonResp['result'];
        return $objects;
        return true;
    }

    

    function create($type, $element, $filepath = '')
    {
        $curl_handler = curl_init();
        $params = array(
            'operation' => 'create',
            'format' => 'json',
            'sessionName' => $this->token,
            'elementType' => $type,
            'element' => json_encode($element)
        );

        $options = array(
            CURLOPT_URL => $this->endpointUrl,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => http_build_query($params)
        );
        curl_setopt_array($curl_handler,$this->defaults+$options);
        if ($filepath != '') {
            $filename = pathinfo($filepath, PATHINFO_BASENAME);
            $size = filesize($filepath);
            $add_options = array(CURLOPT_HTTPHEADER => array("Content-Type: multipart/form-data"), CURLOPT_INFILESIZE => $size);
            if (!function_exists('curl_file_create')) {
                $add_params = array("filedata" => "@$filepath", "filename" => $filename);
            } else {
                $cfile = curl_file_create($filepath, '', $filename);
                $add_params = array('tmp_file' => $cfile);
            }
            
            $options += $add_options;
            // $this->defaults[CURLOPT_HEADER] = 1;
            $options[CURLOPT_POSTFIELDS] = $params + $add_params;
        }
    
        curl_setopt_array($curl_handler, ($this->defaults + $options));
        // $this->defaults[CURLOPT_HEADER] = 0;
        $result = curl_exec($curl_handler);

        if (!$result) {
			die(curl_error($curl_handler));
		}

        $jsonResp = json_decode($result,true);
        if($jsonResp['success']== true)
        {
            echo json_encode(array('success' => 'ok'));
        }
        else 
        {
            die("Update failed: ".$jsonResp["error"]["message"]."<br>");
        }

        return $jsonResp['result'];
    }


}

    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
?>