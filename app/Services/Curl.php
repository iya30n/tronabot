<?php

namespace App\Services;

class Curl
{
    protected $url;

    protected $method;

    protected $data;

    protected $headers = [];

    protected $options;

    protected $httpStatusCode;

    protected $result;

    /**
     * Set properties
     *
     * @param String $url
     * @param String $method
     * @param Array $data
     */
    public function __construct($url, $method = 'GET', $data = [])
    {
        $this->url = $url;

        $this->setHeaders([
            "Content-Type: application/x-www-form-urlencoded"
            // "Content-Type: application/json"
        ]);

        $this->method = $method;

        $this->data = $this->makeData($data);

        return $this;
    }

    /**
     * Set description to data and convert it to json
     *
     * @param Array|String $data
     *
     * @return Array|String $data
     */
    public function makeData($data = [])
    {
        return http_build_query($data);
        
        /* if (is_array($data) && array_key_exists('inline_query_id', $data))
            return json_encode($data);

        if ($this->method == "GET")
            return http_build_query($data);
        else
            return json_encode($data); */
    }
    

    /**
     * Set headers for curl request
     */
    public function setHeaders($headers = [])
    {
        $this->headers = array_merge($this->headers, $headers);
        $this->setOptions();
        return $this;
    }

    /**
     * Set options for curl
     */
    private function setOptions()
    {
        $this->options = [
            CURLOPT_URL => $this->url,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_CUSTOMREQUEST => $this->method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_POSTFIELDS => $this->data
        ];
    }

    /**
     * execute curl
     */
    public function send()
    {
        // TODO: refactor setHeaders method to accept additionals (two methods one for set defaults and one for additionals)
        $this->setHeaders();
        $this->setOptions();

        $ch = curl_init($this->url);
        curl_setopt_array($ch, $this->options);
        $this->result = curl_exec($ch);
        $this->httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return $this;
    }

    /**
     * Get result
     *
     * @param Boolean $decode
     *
     * @return Array|String
     */
    public function getResult($decode = true)
    {
        $status = $this->httpStatusCode;
        $result = $decode ? json_decode($this->result, true) : $this->result;

        return [$status, $result];
    }
}
