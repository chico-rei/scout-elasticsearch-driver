<?php

namespace ScoutElastic;

trait NormalizesClientResponse
{
    /**
     * Normalize an Elasticsearch client response to an array.
     *
     * The elasticsearch/elasticsearch v8 client returns a read-only
     * Elastic\Elasticsearch\Response\Elasticsearch object, while the v7
     * client returns a plain array. This keeps the package working with both.
     *
     * @param  mixed  $response
     * @return array
     */
    protected function clientResponseToArray($response)
    {
        if (is_object($response) && method_exists($response, 'asArray')) {
            return $response->asArray();
        }

        return (array) $response;
    }

    /**
     * Normalize an Elasticsearch client response to a boolean.
     *
     * The v8 client returns an Elasticsearch response object (always truthy)
     * for existence checks, while the v7 client returns a boolean directly.
     *
     * @param  mixed  $response
     * @return bool
     */
    protected function clientResponseToBool($response)
    {
        if (is_object($response) && method_exists($response, 'asBool')) {
            return $response->asBool();
        }

        return (bool) $response;
    }
}
