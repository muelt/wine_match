<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Restaurant;

class RestaurantsController extends Controller
{
    private $data;
 
    public function __construct()
    {
        $this->data = array(
            'format' => config('app.gurunaviFormat'),
            'keyid' => config('app.gurunaviAcckey'),
            'hit_per_page' => config('app.gurunaviPage'),
            'latitude' => config('app.gurunaviBitalat'),
            'longitude' => config('app.gurunaviBitalon'),
            'range' => config('app.gurunaviRange'),
            'gurunaviInputCoordinatesMode' => config('GURUNAVI_INPUT_COORDINATES_MODE'),
            'gurunaviCoordinatesMode' => config('GURUNAVI_COORDINATES_MODE'),

            
        );
    }
 
    public function getGnaviApi($uri, $pageCount)
    {
        $url = config('app.gurunaviUri') . '?' . http_build_query(array_merge($this->data, array('offset_page' => $pageCount)));
        if ($this->getApiDataCurl($url) == []) {
            return false;
        }
        // APIからのresponse情報
        $ApiDataResult = $this->getApiDataCurl($url);
        foreach ($ApiDataResult['rest'] as $shop) {
            //APIから取得した情報を変数に格納
            $shop_id = empty($shop['id']) ? '' : $shop['id'];
            $shop_name           = empty($shop['name']) ? '' : $shop['name'];
            $url                 = empty($shop['url']) ? '' : $shop['url'];
            $address             = empty($shop['address']) ? '' : $shop['address'];
            $tel                 = empty($shop['tel']) ? '' : $shop['tel'];
            $opentime            = empty($shop['opentime']) ? '' : $shop['opentime'];
            $holiday             = empty($shop['holiday']) ? '' : $shop['holiday'];
            $image_url           = empty($shop['image_url']['shop_image1']) ? $arrayPhotoApiData['image_url'] : $shop['image_url']['shop_image1'];
            $update_date         = empty($shop['update_date']) ? '' : $shop['update_date'];
            $category_name = array();
            foreach ($shop['code']['category_name_s'] as $v) {
                if (isset($v) && !is_array($v)) {
                    $category_name[] = $v;
                }
            }
 
            $shop = new Shop;
            // 変数に格納した情報APIからの取得データをDBに登録
            if (empty($shop->where('id', $shop_id)->value('id'))) {
                $shop->insert(['shop_id' => $shop_id, 'shop_name' => $shop_name, 'image_url' => $image_url, 'url' => $url, 'address' => $address, 'tel' => $tel, 'category_name' => $category_names, 'open_time' => $opentime, 'holiday' => $holiday, 'updated_at' => $update_date, 'created_at' => $created_date]);
            }
        }
        return true;
    }
 
    public function getApiDataCurl($url)
    {
        $option = [CURLOPT_RETURNTRANSFER => true, CURLOPT_TIMEOUT => 3];
        $ch = curl_init($url);
        curl_setopt_array($ch, $option);
        $json = curl_exec($ch);
        $info = curl_getinfo($ch);
        $errorNo = curl_errno($ch);
        if ($errorNo !== CURLE_OK) {
            return [];
        }
        if ($info['http_code'] !== 200) {
            return [];
        }
        return json_decode($json, true);
    }
}

