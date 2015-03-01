<?php

namespace nickurt\postcodeapi\Providers\en_GB;

use \nickurt\PostcodeApi\Providers\Provider;
use \nickurt\PostcodeApi\Entity\Address;

class GeoPostcodeOrgUk extends Provider {
	
    protected $apiKey;
    protected $requestUrl;

    /**
     * @return mixed
     */
    protected function request()
    {
        $client = $this->getHttpClient();
        $response = $client->get($this->getRequestUrl())->json();

        return $response;
    }

    /**
     * @param $postCode
     * @return Address
     */
    public function find($postCode)
    {
        $this->setRequestUrl($this->getRequestUrl().'/'.$postCode.'.json');
        $response = $this->request();

        $address = new Address();
        $address
            ->setLatitude($response['wgs84']['lat'])
            ->setLongitude($response['wgs84']['lon']);

        return $address;
    }

    public function findByPostcode($postCode) {}
    public function findByPostcodeAndHouseNumber($postCode, $houseNumber) {}
}