<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\Setting;
use Illuminate\Http\Request;
use Shopify\Clients\Rest;
use Shopify\Utils;

class AppController extends Controller
{
    /**
     * Enable/Disable app
     *
     * @route POST /app/(enable|disable)
     * @param string $mode enable|disable
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Psr\Http\Client\ClientExceptionInterface
     * @throws \Shopify\Exception\MissingArgumentException
     * @throws \Shopify\Exception\UninitializedContextException
     */
    public function index(string $mode, Request $request)
    {
//        $shop = $request->get('shop');
//        $client = $this->getClient($shop);
//        $response = $client->get(
//            'products/count'
//        );
//        dd($response->getDecodedBody());

        $file = resource_path() . '/liquid/example-php-app.liquid';

        $setting = Setting::firstOrNew(['id' => 1]);

        if ($mode == 'enable') {
            $setting->enabled = true;
        } else {
            $setting->enabled = false;
        }

        $setting->save();

        return response(['mode' => $mode]);
    }

    private function getClient($shop)
    {
        $session = Session::where('shop', $shop)
            ->where('is_online', true)
            ->first();

        return new Rest($session->shop, $session->access_token);
    }
}
