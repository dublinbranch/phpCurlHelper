<?php

class CURLTiming
{
    public $info;
    public $curl;
    public $url;
    public function execute($curl, $url)
    {
        $this->url = $url;
        $this->curl = $curl;

        curl_setopt($curl, CURLOPT_URL, url);
        $response = curl_exec($curl);
        $this->info = curl_getinfo($curl);
        return $response;
    }

    public function toSql()
    {
        $info = $this->info;
        $curl = $this->curl;
        $errno = curl_errno($curl);
        $now = time();
        $u64 = base64this($this->url);
        $sql = <<<EOD
INSERT INTO curlLog
ts = $now
,totalTime = {$info["CURLINFO_TOTAL_TIME"]}
,preTransfer = {$info["CURLINFO_PRETRANSFER_TIME"]}
,curlCode = $errno
,httpCode = {$info["CURLINFO_HTTP_CODE"]}
,get = $u64
,post = ''
,response = 
,errBuf
,category
EOD;

    }


}

;