<?php

namespace RevoLand\ParamLaravel;

use stdClass;

class Client
{
    protected string $client_code;
    protected string $client_username;
    protected string $client_password;
    protected string $guid;
    protected bool $test_mode = false;
    protected array $soap_options = [];

    private string $prod_endpoint_url = 'https://dmzws.param.com.tr/turkpos.ws/service_turkpos_prod.asmx?WSDL';
    private string $test_endpoint_url = 'http://test-dmz.ew.com.tr:8080/turkpos.ws/service_turkpos_test.asmx?WSDL';

    private string $ks_prod_endpoint_url = 'https://dmzws.param.com.tr/out.ws/service_ks.asmx?wsdl';
    private string $ks_test_endpoint_url = 'http://test-dmz.ew.com.tr:8080/out.ws/service_ks.asmx?wsdl';

    public function __construct(string $client_code = null, string $client_username = null, string $client_password = null, string $guid = null, bool $test_mode = null, array $soap_options = null)
    {
        $this->client_code = $client_code ?? env('PARAM_CLIENT_CODE', '10738');
        $this->client_username = $client_username ?? env('PARAM_CLIENT_USERNAME', 'Test');
        $this->client_password = $client_password ?? env('PARAM_CLIENT_PASSWORD', 'Test');
        $this->guid = $guid ?? env('PARAM_GUID', '0c13d406-873b-403b-9c09-a5766840d98c');
        $this->test_mode = $test_mode ?? env('PARAM_TEST_MODE', true);

        $this->soap_options = $soap_options ?? [
            'soap_version' => 'SOAP_1_1',
            'trace' => 1,
            'stream_context' => stream_context_create([
                'ssl' => [
                    'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
                ],
            ]),
        ];
    }

    public function getClientCode(): string
    {
        return $this->client_code;
    }

    public function setClientCode(string $client_code): Client
    {
        $this->client_code = $client_code;

        return $this;
    }

    public function setClientUsername(string $client_username): Client
    {
        $this->client_username = $client_username;

        return $this;
    }

    public function setClientPassword(string $client_password): Client
    {
        $this->client_password = $client_password;

        return $this;
    }

    public function getGuid(): string
    {
        return $this->guid;
    }

    public function setGuid(string $guid): Client
    {
        $this->guid = $guid;

        return $this;
    }

    public function setTestMode(bool $test_mode): Client
    {
        $this->test_mode = $test_mode;

        return $this;
    }

    public function getSoapOptions(): array
    {
        return $this->soap_options;
    }

    public function setSoapOptions(array $soap_options): Client
    {
        $this->soap_options = $soap_options;

        return $this;
    }

    public function getEndpointUrl(): string
    {
        return $this->test_mode ? $this->test_endpoint_url
                                : $this->prod_endpoint_url;
    }

    public function getKsEndpointUrl(): string
    {
        return $this->test_mode ? $this->ks_test_endpoint_url
                                : $this->ks_prod_endpoint_url;
    }

    public function setEndpointUrl(string $new_endpoint_url): Client
    {
        $this->test_mode ? $this->test_endpoint_url = $new_endpoint_url
                                : $this->prod_endpoint_url = $new_endpoint_url;

        return $this;
    }

    public function getProdEndpointUrl(): string
    {
        return $this->prod_endpoint_url;
    }

    public function setProdEntPointUrl(string $new_endpoint_url): Client
    {
        $this->prod_endpoint_url = $new_endpoint_url;

        return $this;
    }

    public function getTestEndpointUrl(): string
    {
        return $this->test_endpoint_url;
    }

    public function setTestEntPointUrl(string $new_endpoint_url): Client
    {
        $this->test_endpoint_url = $new_endpoint_url;

        return $this;
    }

    public function getParamSecurityObject(): stdClass
    {
        return (object) [
            'CLIENT_CODE' => $this->client_code,
            'CLIENT_USERNAME' => $this->client_username,
            'CLIENT_PASSWORD' => $this->client_password,
        ];
    }

    public function istekObjesiTemeliGetir(bool $guid_dahil = true): stdClass
    {
        $istekObjesiTemeli = new stdClass();
        $istekObjesiTemeli->G = $this->getParamSecurityObject();

        if ($guid_dahil)
        {
            $istekObjesiTemeli->GUID = $this->getGuid();
        }

        return $istekObjesiTemeli;
    }
}
