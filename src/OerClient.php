<?php

namespace BukkuAccounting\OpenExchangeRatesSdk;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

/**
 * Open Exchange Rates SDK in PHP.
 *
 * @version 1.0
 *
 * @link https://docs.openexchangerates.org/reference/api-introduction
 */

class OerClient
{
    /**
     * API base URL.
     */
    const ENDPOINT = 'https://openexchangerates.org/api/';
    
    /**
     * API endpoint parameters.
     */
    private $app_id = null;
    private $base = null;
    private $show_bid_ask = false;
    private $symbols = null;
    private $date = null;
    private $start = null;
    private $start_time = null;
    private $end = null;
    private $value = null;
    private $from = null;
    private $to = null;
    private $period = null;
    private $prettyprint = true;
    private $show_alternative = false;
    private $show_inactive = false;

    /**
     * Constructor.
     */
    public function __construct($app_id)
    {
        $this->app_id = $app_id;
    }

    /**
     * @param $app_id
     * string
     * Your unique App ID
     *
     * @return $this
     */
    public function app_id($app_id)
    {
        $this->app_id = $app_id;
        return $this;
    }

    /**
     * @param $base
     * string
     * Change base currency (3-letter code, default: USD)
     *
     * @return $this
     */
    public function base($base)
    {
        $this->base = $base;
        return $this;
    }

    /**
     * @param $show_bid_ask
     * boolean
     * Request bid, ask and mid prices for all currencies, where available.
     *
     * @return $this
     */
    public function show_bid_ask($show_bid_ask)
    {
        $this->show_bid_ask = $show_bid_ask;
        return $this;
    }

    /**
     * @param $symbols
     * string
     * Limit results to specific currencies (comma-separated list of 3-letter codes)
     *
     * @return $this
     */
    public function symbols($symbols)
    {
        $this->symbols = $symbols;
        return $this;
    }

    /**
     * @param $date
     * date
     * The requested date in YYYY-MM-DD format
     * @return $this
     */
    public function date($date)
    {
        $this->date = $date;
        return $this;
    }

    /**
     * @param $start
     * date
     * The time series start date in YYYY-MM-DD format
     *
     * @return $this
     */
    public function start($start)
    {
        $this->start = $start;
        return $this;
    }

    /**
     * @param $start_time
     * date
     * The start time for the requested OHLC period (ISO-8601 format, UTC only). 
     * Restrictions apply, refer to link.
     *
     * @return $this
     */
    public function start_time($start_time)
    {
        $this->start_time = $start_time;
        return $this;
    }

    /**
     * @param $end
     * date
     * The time series end date in YYYY-MM-DD format
     *
     * @return $this
     */
    public function end($end)
    {
        $this->end = $end;
        return $this;
    }

    /**
     * @param $value
     * int32
     * The value to be converted
     *
     * @return $this
     */
    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param $from
     * string
     * The base ('from') currency (3-letter code)
     *
     * @return $this
     */
    public function from($from)
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @param $to
     * string
     * The target ('to') currency (3-letter code)
     *
     * @return $this
     */
    public function to($to)
    {
        $this->to = $to;
        return $this;
    }

    /**
     * @param $period
     * string
     * The requested period (starting on the start_time), e.g. "1m", "30m", "1d". 
     * Please see link for supported OHLC periods.
     *
     * @return $this
     */
    public function period($period)
    {
        $this->period = $period;
        return $this;
    }

    /**
     * @param $pretty_print
     * boolean
     * Set to false to reduce response size (removes whitespace)
     * Set to true for human-readable response for debugging (response size will be much larger)
     *
     * @return $this
     */
    public function prettyprint($prettyprint)
    {
        $this->prettyprint = $prettyprint;
        return $this;
    }

    /**
     * @param $show_alternative
     * boolean
     * Extend returned values with alternative, black market and digital currency rates
     *
     * @return $this
     */
    public function show_alternative($show_alternative)
    {
        $this->show_alternative = $show_alternative;
        return $this;
    }

    /**
     * @param $show_inactive
     * boolean
     * Include historical/inactive currencies
     *
     * @return $this
     */
    public function show_inactive($show_inactive)
    {
        $this->show_inactive = $show_inactive;
        return $this;
    }

    /**
     * Request the API's "lastest" endpoint.
     *
     * @return object
     */
    public function latest()
    {
        return $this->request('/latest.json', [
            'base' => $this->base,
            'show_bid_ask' => $this->show_bid_ask,
            'symbols' => $this->symbols,
            'prettyprint' => $this->prettyprint,
            'show_alternative' => $this->show_alternative,
        ]);
    }

    /**
     * Request the API's "historical" endpoint.
     *
     * @return object
     */
    public function historical()
    {
        return $this->request('/historical/'.$this->date.'.json', [
            'base' => $this->base,
            'show_bid_ask' => $this->show_bid_ask,
            'symbols' => $this->symbols,
            'prettyprint' => $this->prettyprint,
            'show_alternative' => $this->show_alternative,
        ]);
    }

    /**
     * Request the API's "currencies" endpoint.
     *
     * @return object
     */
    public function currencies()
    {
        return $this->request('/currencies.json', [
            'prettyprint' => $this->prettyprint,
            'show_alternative' => $this->show_alternative,
            'show_inactive' => $this->show_inactive,
        ]);
    }

    /**
     * Request the API's "time-series" endpoint.
     *
     * @return object
     */
    public function time_series()
    {
        return $this->request('/time-series.json', [
            'start' => $this->start,
            'end' => $this->end,
            'base' => $this->base,
            'show_bid_ask' => $this->show_bid_ask,
            'symbols' => $this->symbols,
            'prettyprint' => $this->prettyprint,
            'show_alternative' => $this->show_alternative,
        ]);
    }

    /**
     * Request the API's "convert" endpoint.
     *
     * @return object
     */
    public function convert()
    {
        return $this->request('/convert/'.$this->value.'/'.$this->from.'/'.$this->to, [
            'show_bid_ask' => $this->show_bid_ask,
            'prettyprint' => $this->prettyprint,
        ]);
    }

    /**
     * Request the API's "ohlc" endpoint.
     *
     * @return object
     */
    public function ohlc()
    {
        return $this->request('/ohlc.json', [
            'start_time' => $this->start_time,
            'period' => $this->period,
            'base' => $this->base,
            'show_bid_ask' => $this->show_bid_ask,
            'symbols' => $this->symbols,
            'prettyprint' => $this->prettyprint,
        ]);
    }

    /**
     * Request the API's "usage" endpoint.
     *
     * @return object
     */
    public function usage()
    {
        return $this->request('/usage.json', [
            'prettyprint' => $this->prettyprint,
        ]);
    }


    /**
     * Execute the API request.
     *
     * @param string $endpoint
     * @param array  $params
     *
     * @throws abort
     * 
     * @return object
     */
    protected function request($endpoint, $params)
    {   
        // Client
        $client = new Client();
        $url = self::ENDPOINT;
        try {
            $response = $client->request('GET', $url.$endpoint.'?'.http_build_query($params), [
                'headers' => [
                    'Authorization' => 'Token ' . $this->app_id,
                ],
            ]);  
        }
        catch (ClientException $e) {
            $error = $e->getResponse()->getBody();
            $error = json_decode($error);
            abort($error->status, $error->description);
        }

        return json_decode($response->getBody());
    }

}