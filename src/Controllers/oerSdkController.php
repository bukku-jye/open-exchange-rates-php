<?php
namespace BukkuAccounting\OpenExchangeRatesSdk\Controllers;

use Illuminate\Http\Request;
use BukkuAccounting\OpenExchangeRatesSdk\oerSdk;
use Illuminate\Routing\Controller as BaseController;

class oerSdkController extends BaseController
{
    // All the available functions

    public function latest(Request $request) {
        $oerSdk = new oerSdk($request->app_id);
        return $oerSdk->base($request->base)
            ->show_bid_ask($request->show_bid_ask)
            ->symbols($request->symbols)
            ->prettyprint($request->prettyprint)
            ->show_alternative($request->show_alternative)
            ->latest();
    }

    public function historical(Request $request) {
        $oerSdk = new oerSdk($request->app_id);
        return $oerSdk->date($request->date)
            ->base($request->base)
            ->show_bid_ask($request->show_bid_ask)
            ->symbols($request->symbols)
            ->prettyprint($request->prettyprint)
            ->show_alternative($request->show_alternative)
            ->historical();
    }

    public function currencies(Request $request) {
        $oerSdk = new oerSdk($request->app_id);
        return $oerSdk->prettyprint($request->prettyprint)
            ->show_alternative($request->show_alternative)
            ->show_inactive($request->show_inactive)
            ->currencies();
    }

    public function time_series(Request $request) {
        $oerSdk = new oerSdk($request->app_id);
        return $oerSdk->start($request->start)
            ->end($request->end)
            ->base($request->base)
            ->show_bid_ask($request->show_bid_ask)
            ->symbols($request->symbols)
            ->prettyprint($request->prettyprint)
            ->show_alternative($request->show_alternative)
            ->time_series();
    }

    public function convert(Request $request) {
        $oerSdk = new oerSdk($request->app_id);
        return $oerSdk->value($request->value)
            ->from($request->from)
            ->to($request->to)
            ->prettyprint($request->prettyprint)
            ->show_bid_ask($request->show_alternative)
            ->convert();
    }

    public function ohlc(Request $request) {
        $oerSdk = new oerSdk($request->app_id);
        return $oerSdk->start_time($request->start_time)
            ->period($request->period)
            ->base($request->base)
            ->show_bid_ask($request->show_alternative)
            ->symbols($request->symbols)
            ->prettyprint($request->prettyprint)
            ->ohlc();
    }

    public function usage(Request $request) {
        $oerSdk = new oerSdk($request->app_id);
        return $oerSdk
            ->prettyprint($request->prettyprint)
            ->usage();
    }
}