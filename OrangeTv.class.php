<?php

class OrangeTv
{
    private $ip;
    private $port;

    public function __construct($ip, $port = 8080)
    {
        $this->ip = $ip;
        $this->port = $port;
    }

    private function keyToRemoteCode($key)
    {
        switch($key) {
            case '0':
                return 512;
            case '1':
                return 513;
            case '2':
                return 514;
            case '3':
                return 515;
            case '4':
                return 516;
            case '5':
                return 517;
            case '6':
                return 518;
            case '7':
                return 519;
            case '8':
                return 520;
            case '9':
                return 521;
            case 'ONOFF':
                return 116;
            case 'CH+':
                return 402;
            case 'CH-':
                return 403;
            case 'VOL+':
                return 115;
            case 'VOL-':
                return 114;
            case 'MUTE':
                return 113;
            case 'UP':
                return 103;
            case 'DOWN':
                return 108;
            case 'LEFT':
                return 105;
            case 'RIGHT':
                return 116;
            case 'OK':
                return 352;
            case 'BACK':
                return 158;
            case 'MENU':
                return 139;
            case 'PLAYPAUSE':
                return 164;
            case 'RWD':
                return 168;
            case 'FWD':
                return 159;
            case 'REC':
                return 167;
            case 'VOD':
                return 393;
            default:
                return 0;
        }
    }

    private function sendCommand($operation, $key = NULL, $mode = NULL) {
        $url = "http://{$this->ip}:{$this->port}/remoteControl/cmd?operation={$operation}";

        if($key !== NULL) {
            $url .= "&key={$key}";
        }

        if($mode !== NULL) {
            $url .= "&mode={$mode}";
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        $result = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if($code != 200) {
            return false;
        }

        $result = json_decode($result);

        if(!$result) {
            return false;
        }

        if($result->result->responseCode != 0) {
            return false;
        }

        return $result;
    }

    public function getSystemInfo()
    {
        return $this->sendCommand(10)->result->data;
    }

    public function sendKeyPress($key, $mode = 0)
    {
        return $this->sendCommand("01", $this->keyToRemoteCode($key), $mode);
    }
}

?>
