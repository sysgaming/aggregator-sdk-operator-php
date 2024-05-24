<?php

namespace Sysgaming\AggregatorSdkPhp\Helpers\Impls;

use Sysgaming\AggregatorSdkPhp\Dtos\AggregatorJsonObject;
use Sysgaming\AggregatorSdkPhp\Helpers\JsonHandler;

class JsonHandlerImpl implements JsonHandler
{

    /**
     * @param $value array|object
     * @return string
     */
    function jsonEncode($value)
    {

        if( $value instanceof AggregatorJsonObject )
            $value = $value->toArray();

        $value = $this->convertToUtf8($value);

        return json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);

    }

    /**
     * @param $raw string
     * @return array
     */
    function jsonDecode($raw)
    {

        return json_decode($raw, true);

    }

        /**
     * Convert data to UTF-8 encoding
     *
     * @param mixed $data
     * @return mixed
     */
    private function convertToUtf8($data)
    {
        if (is_string($data)) {
            return mb_convert_encoding($data, 'UTF-8', 'auto');
        } elseif (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->convertToUtf8($value);
            }
        } elseif (is_object($data)) {
            foreach ($data as $key => $value) {
                $data->$key = $this->convertToUtf8($value);
            }
        }
        return $data;
    }
}