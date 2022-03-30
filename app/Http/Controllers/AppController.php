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
     * @throws \Shopify\Exception\UninitializedContextException
     */
    public function index(string $mode, Request $request)
    {
        $setting = Setting::firstOrNew(['id' => 1]);

        if ($mode == 'enable') {
            $shop = $request->get('shop');
            $file = resource_path() . '/liquid/example-php-app.liquid';

            $client = $this->getClient($shop);
            $response = $client->put(
                "themes/123985330233/assets",
                [
                    "asset" => [
                        "key" => "snippets/example-php-app.liquid",
                        "value" => file_get_contents($file),
                    ]
                ]
            );

            if ($response->getStatusCode() == 200) {
                $setting->enabled = true;
            }
        } else {
            $setting->enabled = false;
        }

        $setting->save();

        return response(['mode' => $mode]);
    }

    /**
     * Get Rest Client
     * @param string $shop
     * @return Rest
     * @throws \Shopify\Exception\MissingArgumentException
     */
    private function getClient(string $shop): Rest
    {
        $session = Session::where('shop', $shop)
            ->where('is_online', true)
            ->first();

        return new Rest($session->shop, $session->access_token);
    }
}
