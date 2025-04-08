<?php

namespace Tynkr\Sdk\Internal;

class Request
{
    private \CurlHandle $curlHandle;

    /**
     * @throws \Exception
     */
    public function get($url)
    {
        $this->initCurl($url, "GET");
        return $this->execute();
    }

    /**
     * @throws \Exception
     */
    public function post($url, $data)
    {
        $this->initCurl($url, "POST");
        curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, json_encode($data));
        return $this->execute();
    }

    /**
     * @throws \Exception
     */
    public function put($url, $data)
    {
        $this->initCurl($url, "PUT");
        curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, json_encode($data));
        return $this->execute();
    }

    /**
     * @throws \Exception
     */
    public function patch($url, $data)
    {
        $this->initCurl($url, "PATCH");
        curl_setopt($this->curlHandle, CURLOPT_POSTFIELDS, json_encode($data));
        return $this->execute();
    }

    /**
     * @throws \Exception
     */
    public function delete($url)
    {
        $this->initCurl($url, "DELETE");
        return $this->execute();
    }

    private function initCurl($url, $method)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Content-Type: application/json",
        ]);
        $this->curlHandle = $ch;
    }

    /**
     * @throws \Exception
     */
    private function execute()
    {
        $response = curl_exec($this->curlHandle);

        if ($response === false) {
            $error = curl_error($this->curlHandle);
            curl_close($this->curlHandle);
            throw new \Exception($error);
        }
        curl_close($this->curlHandle);
        $data = json_decode($response, true);
        if(is_null($data)) {
            throw new \Exception("Invalid JSON response");
        }
        if(!$data['success']) {
            throw new \Exception($data['message']);
        }
        return $data['data'];
    }
}
