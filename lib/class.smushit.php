<?PHP
    // smushit-php - a PHP client for Yahoo!'s Smush.it web service
    //
    // June 24, 2010
    // Tyler Hall <tylerhall@gmail.com>
    // http://github.com/tylerhall/smushit-php/tree/master

    class SmushIt
    {
        const SMUSH_URL = 'http://www.smushit.com/ysmush.it/ws.php?';

        public $filename;
        public $url;
        public $compressedUrl;
        public $size;
        public $compressedSize;
        public $savings;
        public $error;

        public function __construct($data = null)
        {
            if(!is_null($data))
            {
                if(preg_match('/https?:\/\//', $data) == 1)
                    $this->smushURL($data);
                else
                    $this->smushFile($data);
            }
        }

        public function smushURL($url)
        {
            $this->url = $url;

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, self::SMUSH_URL . 'img=' . $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            $json_str = curl_exec($ch);
            curl_close($ch);

            return $this->parseResponse($json_str);
        }

        public function smushFile($filename)
        {
            $this->filename = $filename;

            if(!is_readable($filename))
            {
                $this->error = 'Could not read file';
                return false;
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, self::SMUSH_URL);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, array('files' => '@' . $filename));
            $json_str = curl_exec($ch);
            curl_close($ch);

            return $this->parseResponse($json_str);
        }

        private function parseResponse($json_str)
        {
            $this->size           = null;
            $this->compressedUrl  = null;
            $this->compressedSize = null;
            $this->savings        = null;
	
            $this->error = null;
            $json = json_decode($json_str);

            if(is_null($json))
            {
                $this->error = 'Bad response from Smush.it web service';
                return false;
            }

            if(isset($json->error))
            {
                $this->error = $json->error;
                return false;
            }

            $this->size           = $json->src_size;
            $this->compressedUrl  = $json->dest;
            $this->compressedSize = $json->dest_size;
            $this->savings        = $json->percent;
            return true;
        }
    }