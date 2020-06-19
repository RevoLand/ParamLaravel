<?php

namespace RevoLand\ParamLaravel;

use Exception;
use SoapClient;
use stdClass;

class Param
{
    const ISLEMAKSIYON_IPTAL = 'IPTAL';
    const ISLEMAKSIYON_IADE = 'IADE';
    protected Client $client;

    public function __construct(Client $client = null)
    {
        $this->client = $client ?? new Client();
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function setClient(Client $client): Param
    {
        $this->client = $client;

        return $this;
    }

    public function getSoapClient(): SoapClient
    {
        return new SoapClient($this->client->getEndpointUrl(), $this->client->getSoapOptions());
    }

    public function getKsSoapClient(): SoapClient
    {
        return new SoapClient($this->client->getKsEndpointUrl(), $this->client->getSoapOptions());
    }

    public function DekontIdIleIslemBilgiGetir(int $dekont_id): stdClass
    {
        $islemBilgiIstekObjesi = $this->client->istekObjesiTemeliGetir(true);
        $islemBilgiIstekObjesi->Dekont_ID = $dekont_id;

        try
        {
            $paramSoapYanit = $this->getSoapClient()->TP_Islem_Sorgulama($islemBilgiIstekObjesi)->TP_Islem_SorgulamaResult;
            if ($islemDetay = $paramSoapYanit->Sonuc > 0)
            {
                if ($xmlData = Param_XmlStringOlustur($paramSoapYanit->DT_Bilgi->any))
                {
                    $islemDetay = (object) $xmlData->diffgram->NewDataSet->DT_Islem_Sorgulama;
                }
            }

            return (object) [
                'Sonuc' => $paramSoapYanit->Sonuc,
                'Sonuc_Str' => $paramSoapYanit->Sonuc_Str,
                'Sonuc_Aciklama' => config('paramlaravel.error_messages.' . $paramSoapYanit->Sonuc, 'Tanımsız hata.'),
                'DT_Bilgi' => $islemDetay,
            ];
        }
        catch (Exception $ex)
        {
            return (object) [
                'Sonuc' => false,
                'Sonuc_Str' => $ex->getMessage(),
            ];
        }
    }

    public function SiparisIdIleIslemBilgiGetir(string $siparis_id): stdClass
    {
        $islemBilgiIstekObjesi = $this->client->istekObjesiTemeliGetir(true);
        $islemBilgiIstekObjesi->Siparis_ID = $siparis_id;

        try
        {
            $paramSoapYanit = $this->getSoapClient()->TP_Islem_Sorgulama($islemBilgiIstekObjesi)->TP_Islem_SorgulamaResult;
            if ($islemDetay = $paramSoapYanit->Sonuc > 0)
            {
                if ($xmlData = Param_XmlStringOlustur($paramSoapYanit->DT_Bilgi->any))
                {
                    $islemDetay = (object) $xmlData->diffgram->NewDataSet->DT_Islem_Sorgulama;
                }
            }

            return (object) [
                'Sonuc' => $paramSoapYanit->Sonuc,
                'Sonuc_Str' => $paramSoapYanit->Sonuc_Str,
                'Sonuc_Aciklama' => config('paramlaravel.error_messages.' . $paramSoapYanit->Sonuc, 'Tanımsız hata.'),
                'DT_Bilgi' => $islemDetay,
            ];
        }
        catch (Exception $ex)
        {
            return (object) [
                'Sonuc' => false,
                'Sonuc_Str' => $ex->getMessage(),
            ];
        }
    }

    public function IslemIdIleIslemBilgiGetir(string $islem_id): stdClass
    {
        $islemBilgiIstekObjesi = $this->client->istekObjesiTemeliGetir(true);
        $islemBilgiIstekObjesi->Islem_ID = $islem_id;
        try
        {
            $paramSoapYanit = $this->getSoapClient()->TP_Islem_Sorgulama($islemBilgiIstekObjesi)->TP_Islem_SorgulamaResult;
            if ($islemDetay = $paramSoapYanit->Sonuc > 0)
            {
                if ($xmlData = Param_XmlStringOlustur($paramSoapYanit->DT_Bilgi->any))
                {
                    $islemDetay = (object) $xmlData->diffgram->NewDataSet->DT_Islem_Sorgulama;
                }
            }

            return (object) [
                'Sonuc' => $paramSoapYanit->Sonuc,
                'Sonuc_Str' => $paramSoapYanit->Sonuc_Str,
                'Sonuc_Aciklama' => config('paramlaravel.error_messages.' . $paramSoapYanit->Sonuc, 'Tanımsız hata.'),
                'DT_Bilgi' => $islemDetay,
            ];
        }
        catch (Exception $ex)
        {
            return (object) [
                'Sonuc' => false,
                'Sonuc_Str' => $ex->getMessage(),
            ];
        }
    }

    public function IslemOzetleriGetir(string $tarih_baslangic, string $tarih_bitis): stdClass
    {
        $islemOzetIstekObjesi = $this->client->istekObjesiTemeliGetir(true);
        $islemOzetIstekObjesi->Tarih_Bas = $tarih_baslangic;
        $islemOzetIstekObjesi->Tarih_Bit = $tarih_bitis;

        try
        {
            $paramSoapYanit = $this->getSoapClient()->TP_Mutabakat_Ozet($islemOzetIstekObjesi)->TP_Mutabakat_OzetResult;
            if ($islemListesi = $paramSoapYanit->Sonuc > 0)
            {
                if ($xmlData = Param_XmlStringOlustur($paramSoapYanit->DT_Bilgi->any))
                {
                    $islemListesi = (object) $xmlData->diffgram->NewDataSet->DT_Mutabakat_Ozet;
                }
            }

            return (object) [
                'Sonuc' => $paramSoapYanit->Sonuc,
                'Sonuc_Str' => $paramSoapYanit->Sonuc_Str,
                'Sonuc_Aciklama' => config('paramlaravel.error_messages.' . $paramSoapYanit->Sonuc, 'Tanımsız hata.'),
                'DT_Bilgi' => $islemListesi,
            ];
        }
        catch (Exception $ex)
        {
            return (object) [
                'Sonuc' => false,
                'Sonuc_Str' => $ex->getMessage(),
            ];
        }
    }

    public function IslemDekontuGonder(int $dekont_id, string $gonderilecek_eposta): stdClass
    {
        $islemDekontuGondermeIstegiObjesi = $this->client->istekObjesiTemeliGetir(true);
        $islemDekontuGondermeIstegiObjesi->Dekont_ID = $dekont_id;
        $islemDekontuGondermeIstegiObjesi->E_Posta = $gonderilecek_eposta;

        try
        {
            return $this->getSoapClient()->TP_Islem_Dekont_Gonder($islemDekontuGondermeIstegiObjesi)->TP_Islem_Dekont_GonderResult;
        }
        catch (Exception $ex)
        {
            return (object)
            [
                'Sonuc' => false,
                'Sonuc_Str' => $ex->getMessage(),
            ];
        }
    }

    public function BinSanalPosGetir(string $bin = ''): stdClass
    {
        $binSanalPosObjesi = $this->client->istekObjesiTemeliGetir(false);
        $binSanalPosObjesi->BIN = substr(trim($bin), 0, 6);

        try
        {
            $binListesi = [];
            $paramSoapYanit = $this->getSoapClient()->BIN_SanalPos($binSanalPosObjesi)->BIN_SanalPosResult;
            if ($xmlData = Param_XmlStringOlustur($paramSoapYanit->DT_Bilgi->any))
            {
                foreach ($xmlData->diffgram->NewDataSet->Temp as $card)
                {
                    $binListesi[] = (array) $card;
                }
            }

            return (object) [
                'Sonuc' => $paramSoapYanit->Sonuc,
                'Sonuc_Str' => $paramSoapYanit->Sonuc_Str,
                'Sonuc_Aciklama' => config('paramlaravel.error_messages.' . $paramSoapYanit->Sonuc, 'Tanımsız hata.'),
                'DT_Bilgi' => $binListesi,
            ];
        }
        catch (Exception $ex)
        {
            return (object) [
                'Sonuc' => false,
                'Sonuc_Str' => $ex->getMessage(),
            ];
        }
    }

    public function OzelOranSkListeGetir(): stdClass
    {
        $ozelOranObject = $this->client->istekObjesiTemeliGetir(true);

        try
        {
            $paramSoapYanit = $this->getSoapClient()->TP_Ozel_Oran_SK_Liste($ozelOranObject)->TP_Ozel_Oran_SK_ListeResult;
            if ($ozelOranListesi = $paramSoapYanit->Sonuc > 0)
            {
                $ozelOranListesi = [];
                if ($xmlData = Param_XmlStringOlustur($paramSoapYanit->DT_Bilgi->any))
                {
                    foreach ($xmlData->diffgram->NewDataSet->DT_Ozel_Oranlar_SK as $card)
                    {
                        $ozelOranListesi[] = (array) $card;
                    }
                }
            }

            return (object) [
                'Sonuc' => $paramSoapYanit->Sonuc,
                'Sonuc_Str' => $paramSoapYanit->Sonuc_Str,
                'Sonuc_Aciklama' => config('paramlaravel.error_messages.' . $paramSoapYanit->Sonuc, 'Tanımsız hata.'),
                'DT_Bilgi' => $ozelOranListesi,
            ];
        }
        catch (Exception $ex)
        {
            return (object) [
                'Sonuc' => false,
                'Sonuc_Str' => $ex->getMessage(),
            ];
        }
    }

    public function IslemIptalIade(string $durum, int $dekont_id, string $tutar): stdClass
    {
        $islemIptalIadeObjesi = $this->client->istekObjesiTemeliGetir(true);
        $islemIptalIadeObjesi->Durum = $durum;
        $islemIptalIadeObjesi->Dekont_ID = $dekont_id;
        $islemIptalIadeObjesi->Tutar = $tutar;

        try
        {
            return $this->getSoapClient()->TP_Islem_Iptal_Iade_Kismi($islemIptalIadeObjesi)->TP_Islem_Iptal_Iade_KismiResult;
        }
        catch (Exception $ex)
        {
            return (object) [
                'Sonuc' => false,
                'Sonuc_Str' => $ex->getMessage(),
            ];
        }
    }

    public function SakliKartListesiGetir(string $kart_no = null, string $kart_saklama_kisi_id = null): stdClass
    {
        $kartListesiIstekObjesi = $this->client->istekObjesiTemeliGetir(false);
        if (isset($kart_no))
        {
            $kartListesiIstekObjesi->Kart_No = $kart_no;
        }
        if (isset($kart_saklama_kisi_id))
        {
            $kartListesiIstekObjesi->KS_KK_Kisi_ID = $kart_saklama_kisi_id;
        }

        try
        {
            $paramSoapYanit = $this->getSoapClient()->KK_Sakli_Liste($kartListesiIstekObjesi)->KK_Sakli_ListeResult;
            if ($kartListesi = $paramSoapYanit->Sonuc > 0)
            {
                $kartListesi = [];
                if ($xmlData = Param_XmlStringOlustur($paramSoapYanit->DT_Bilgi->any))
                {
                    foreach ($xmlData->diffgram->NewDataSet->Temp as $card)
                    {
                        $kartListesi[] = (array) $card;
                    }
                }
            }

            return (object) [
                'Sonuc' => $paramSoapYanit->Sonuc,
                'Sonuc_Str' => $paramSoapYanit->Sonuc_Str,
                'Sonuc_Aciklama' => config('paramlaravel.error_messages.' . $paramSoapYanit->Sonuc, 'Tanımsız hata.'),
                'DT_Bilgi' => $kartListesi,
            ];
        }
        catch (Exception $ex)
        {
            return (object) [
                'Sonuc' => false,
                'Sonuc_Str' => $ex->getMessage(),
            ];
        }
    }
}
