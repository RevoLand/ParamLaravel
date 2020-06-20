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

    public function OzelOranListeGetir(): stdClass
    {
        $ozelOranListeObjesi = $this->client->istekObjesiTemeliGetir(true);

        try
        {
            $paramSoapYanit = $this->getSoapClient()->TP_Ozel_Oran_Liste($ozelOranListeObjesi)->TP_Ozel_Oran_ListeResult;
            if ($ozelOranListesi = $paramSoapYanit->Sonuc > 0)
            {
                $ozelOranListesi = [];
                if ($xmlData = Param_XmlStringOlustur($paramSoapYanit->DT_Bilgi->any))
                {
                    foreach ($xmlData->diffgram->NewDataSet->DT_Ozel_Oranlar as $card)
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

    public function OzelOranSkListeGetir(): stdClass
    {
        $ozelOranListeObjesi = $this->client->istekObjesiTemeliGetir(true);

        try
        {
            $paramSoapYanit = $this->getSoapClient()->TP_Ozel_Oran_SK_Liste($ozelOranListeObjesi)->TP_Ozel_Oran_SK_ListeResult;
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

    public function OzelOranSkGuncelle(int $ozel_oran_sk_id, string $taksit_orani_1 = '100', string $taksit_orani_2 = '100', string $taksit_orani_3 = '100', string $taksit_orani_4 = '100',
    string $taksit_orani_5 = '100', string $taksit_orani_6 = '100', string $taksit_orani_7 = '100', string $taksit_orani_8 = '100', string $taksit_orani_9 = '100', string $taksit_orani_10 = '100', string $taksit_orani_11 = '100', string $taksit_orani_12 = '100'): stdClass
    {
        $ozelOranGuncellemeIstegiObjesi = $this->client->istekObjesiTemeliGetir(true);
        $ozelOranGuncellemeIstegiObjesi->Ozel_Oran_SK_ID = $ozel_oran_sk_id;
        $ozelOranGuncellemeIstegiObjesi->MO_01 = $taksit_orani_1;
        $ozelOranGuncellemeIstegiObjesi->MO_02 = $taksit_orani_2;
        $ozelOranGuncellemeIstegiObjesi->MO_03 = $taksit_orani_3;
        $ozelOranGuncellemeIstegiObjesi->MO_04 = $taksit_orani_4;
        $ozelOranGuncellemeIstegiObjesi->MO_05 = $taksit_orani_5;
        $ozelOranGuncellemeIstegiObjesi->MO_06 = $taksit_orani_6;
        $ozelOranGuncellemeIstegiObjesi->MO_07 = $taksit_orani_7;
        $ozelOranGuncellemeIstegiObjesi->MO_08 = $taksit_orani_8;
        $ozelOranGuncellemeIstegiObjesi->MO_09 = $taksit_orani_9;
        $ozelOranGuncellemeIstegiObjesi->MO_10 = $taksit_orani_10;
        $ozelOranGuncellemeIstegiObjesi->MO_11 = $taksit_orani_11;
        $ozelOranGuncellemeIstegiObjesi->MO_12 = $taksit_orani_12;

        try
        {
            return $this->getSoapClient()->TP_Ozel_Oran_SK_Guncelle($ozelOranGuncellemeIstegiObjesi)->TP_Ozel_Oran_SK_GuncelleResult;
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

    public function KartDogrula(string $kart_numarasi, string $kart_skt_ay, string $kart_skt_yil, string $kart_cvc, string $post_return_url, string $data1 = null, string $data2 = null,
    string $data3 = null, string $data4 = null, string $data5 = null): stdClass
    {
        $kartDogrulamaObjesi = $this->client->istekObjesiTemeliGetir(false);
        $kartDogrulamaObjesi->KK_No = $kart_numarasi;
        $kartDogrulamaObjesi->KK_SK_Ay = $kart_skt_ay;
        $kartDogrulamaObjesi->KK_SK_Yil = $kart_skt_yil;
        $kartDogrulamaObjesi->KK_CVC = $kart_cvc;
        $kartDogrulamaObjesi->Return_URL = $post_return_url;

        if (isset($data1))
        {
            $kartDogrulamaObjesi->Data1 = $data1;
        }
        if (isset($data2))
        {
            $kartDogrulamaObjesi->Data2 = $data2;
        }
        if (isset($data3))
        {
            $kartDogrulamaObjesi->Data3 = $data3;
        }
        if (isset($data4))
        {
            $kartDogrulamaObjesi->Data4 = $data4;
        }
        if (isset($data5))
        {
            $kartDogrulamaObjesi->Data5 = $data5;
        }

        try
        {
            return $this->getSoapClient()->TP_KK_Verify($kartDogrulamaObjesi)->TP_KK_VerifyResult;
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
