<?php

namespace RevoLand\ParamLaravel;

use Exception;
use stdClass;

class Odeme
{
    const ODEME_NORMAL = 1;
    const ODEME_DOVIZ = 2;
    const ODEME_KART_SAKLAMALI = 3;
    const ODEME_BKMEXPRESS = 4;
    const ODEME_3DMODEL = 5;

    const DOVIZ_TRY = 1000;
    const DOVIZ_USD = 1001;
    const DOVIZ_EUR = 1002;

    protected Param $param;

    protected int $odeme_tipi;
    protected bool $odeme_3D = false;
    protected int $pos_id;

    protected string $cc_holder;
    protected string $cc_number;
    protected string $cc_expiry_month;
    protected string $cc_expiry_year;
    protected string $cc_cvv;
    protected string $cc_holder_gsm;

    protected string $kartsaklama_guid;
    protected string $kartsaklama_kartismi;
    protected string $kartsaklama_islemid;

    protected int $currency_code;

    protected int $taksit_sayisi;
    protected string $order_price;
    protected string $order_total;

    protected string $success_redirect_url;
    protected string $fail_redirect_url;
    protected string $referrer_page_url;
    protected string $client_ip;

    protected string $order_id;
    protected string $order_description;
    protected string $process_id;

    protected string $extra_data1;
    protected string $extra_data2;
    protected string $extra_data3;
    protected string $extra_data4;
    protected string $extra_data5;

    public function __construct(Param $param = null, int $odeme_tipi = self::ODEME_NORMAL, int $pos_id = null)
    {
        $this->param = $param ?? new Param();
        $this->odeme_tipi = $odeme_tipi;

        if (isset($pos_id))
        {
            $this->pos_id = $pos_id;
        }
    }

    public function setPaymentType(int $odeme_tipi): Odeme
    {
        $this->odeme_tipi = $odeme_tipi;

        return $this;
    }

    public function setPayment3dStatus(bool $odeme_3D): Odeme
    {
        $this->odeme_3D = $odeme_3D;

        return $this;
    }

    public function setPosId(int $pos_id): Odeme
    {
        $this->pos_id = $pos_id;

        return $this;
    }

    public function setCardHolder(string $holder_name): Odeme
    {
        $this->cc_holder = $holder_name;

        return $this;
    }

    public function setKsGuid(string $kartsaklama_guid): Odeme
    {
        $this->kartsaklama_guid = $kartsaklama_guid;

        return $this;
    }

    public function setKsCardName(string $kartsaklama_kartismi): Odeme
    {
        $this->kartsaklama_kartismi = $kartsaklama_kartismi;

        return $this;
    }

    public function setKkProcessId(string $kartsaklama_islemid): Odeme
    {
        $this->kartsaklama_islemid = $kartsaklama_islemid;

        return $this;
    }

    public function setCurrencyCode(int $currency_code): Odeme
    {
        $this->currency_code = $currency_code;

        return $this;
    }

    public function setCardNumber(string $card_number): Odeme
    {
        $this->cc_number = $card_number;

        return $this;
    }

    public function setCardExpiryMonth(string $card_expiry_month): Odeme
    {
        $this->cc_expiry_month = $card_expiry_month;

        return $this;
    }

    public function setCardExpiryYear(string $card_expiry_year): Odeme
    {
        $this->cc_expiry_year = $card_expiry_year;

        return $this;
    }

    public function setCardCvv(string $card_cvv): Odeme
    {
        $this->cc_cvv = $card_cvv;

        return $this;
    }

    public function setCardHolderGsm(string $gsm_number): Odeme
    {
        $this->cc_holder_gsm = $gsm_number;

        return $this;
    }

    public function setInstallment(int $taksit_sayisi = 1): Odeme
    {
        $this->taksit_sayisi = $taksit_sayisi;

        return $this;
    }

    public function setOrderPrice(string $order_price): Odeme
    {
        $this->order_price = $order_price;

        return $this;
    }

    public function setOrderTotalPrice(string $order_total_price): Odeme
    {
        $this->order_total = $order_total_price;

        return $this;
    }

    public function setRedirectOnSuccessUrl(string $url): Odeme
    {
        $this->success_redirect_url = $url;

        return $this;
    }

    public function setRedirectOnFailUrl(string $url): Odeme
    {
        $this->fail_redirect_url = $url;

        return $this;
    }

    public function setReferrerPageUrl(string $url): Odeme
    {
        $this->referrer_page_url = $url;

        return $this;
    }

    public function setClientIp(string $ip): Odeme
    {
        $this->client_ip = $ip;

        return $this;
    }

    public function setOrderId(string $order_id): Odeme
    {
        $this->order_id = $order_id;

        return $this;
    }

    public function setOrderDescription(string $order_description): Odeme
    {
        $this->order_description = $order_description;

        return $this;
    }

    public function setProcessId(string $process_id): Odeme
    {
        $this->process_id = $process_id;

        return $this;
    }

    public function setExtraData1(string $extra_data): Odeme
    {
        $this->extra_data1 = $extra_data;

        return $this;
    }

    public function setExtraData2(string $extra_data): Odeme
    {
        $this->extra_data2 = $extra_data;

        return $this;
    }

    public function setExtraData3(string $extra_data): Odeme
    {
        $this->extra_data3 = $extra_data;

        return $this;
    }

    public function setExtraData4(string $extra_data): Odeme
    {
        $this->extra_data4 = $extra_data;

        return $this;
    }

    public function setExtraData5(string $extra_data): Odeme
    {
        $this->extra_data5 = $extra_data;

        return $this;
    }

    public function HashOlustur(): string
    {
        $hashObject = new stdClass();
        $hashObject->Data = $this->param->getClient()->getClientCode();
        $hashObject->Data .= $this->param->getClient()->getGuid();
        if ($this->odeme_tipi != self::ODEME_BKMEXPRESS)
        {
            $hashObject->Data .= $this->pos_id;
            $hashObject->Data .= $this->taksit_sayisi;
            $hashObject->Data .= $this->order_price;
        }
        $hashObject->Data .= $this->order_total;
        $hashObject->Data .= $this->order_id;
        $hashObject->Data .= $this->fail_redirect_url;
        $hashObject->Data .= $this->success_redirect_url;

        try
        {
            return $this->param->getSoapClient()->SHA2B64($hashObject)->SHA2B64Result;
        }
        catch (Exception $ex)
        {
            return false;
        }
    }

    public function KSKartEkle(string $kart_sahibi = null, string $kart_numarasi = null, string $kart_skt_ay = null, string $kart_skt_yil = null, string $kartsaklama_ismi = null, string $kartsaklama_islemid = null): stdClass
    {
        $ksKartObject = $this->param->getClient()->istekObjesiTemeliGetir(true);
        $ksKartObject->KK_Sahibi = $kart_sahibi ?? $this->cc_holder;
        $ksKartObject->KK_No = $kart_numarasi ?? $this->cc_number;
        $ksKartObject->KK_SK_Ay = $kart_skt_ay ?? $this->cc_expiry_month;
        $ksKartObject->KK_SK_Yil = $kart_skt_yil ?? $this->cc_expiry_year;
        $ksKartObject->KK_Kart_Adi = $kartsaklama_ismi ?? $this->kartsaklama_kartismi;
        $ksKartObject->KK_Islem_ID = $kartsaklama_islemid ?? $this->kartsaklama_islemid;

        return $this->param->getKsSoapClient()->KS_Kart_Ekle($ksKartObject)->KS_Kart_EkleResult;
    }

    public function OdemeIstegiGonder(): stdClass
    {
        $paymentObject = $this->OdemeObjesiOlustur();
        switch ($this->odeme_tipi)
        {
            case self::ODEME_NORMAL:
                return $this->param->getSoapClient()->TP_Islem_Odeme_WNS($paymentObject);
            case self::ODEME_DOVIZ:
                return $this->param->getSoapClient()->TP_Islem_Odeme_WD($paymentObject);
            case self::ODEME_KART_SAKLAMALI:
                return $this->param->getSoapClient()->TP_Islem_Odeme_WKS($paymentObject);
            case self::ODEME_BKMEXPRESS:
                return $this->param->getSoapClient()->TP_Islem_Odeme_BKM($paymentObject);
            case self::ODEME_3DMODEL:
                return $this->param->getSoapClient()->TP_WMD_UCD($paymentObject);
        }
    }

    public function OdemeObjesiOlustur(): stdClass
    {
        $paymentObject = $this->param->getClient()->istekObjesiTemeliGetir(true);

        if (in_array($this->odeme_tipi, [self::ODEME_NORMAL, self::ODEME_DOVIZ, self::ODEME_3DMODEL]))
        {
            $paymentObject->KK_Sahibi = $this->cc_holder;
            $paymentObject->KK_No = $this->cc_number;
            $paymentObject->KK_SK_Ay = $this->cc_expiry_month;
            $paymentObject->KK_SK_Yil = $this->cc_expiry_year;
            $paymentObject->KK_CVC = $this->cc_cvv;
            $paymentObject->Islem_Hash = $this->HashOlustur();

            if (isset($this->extra_data5))
            {
                $paymentObject->Data5 = $this->extra_data5;
            }
        }

        if (in_array($this->odeme_tipi, [self::ODEME_NORMAL, self::ODEME_KART_SAKLAMALI, self::ODEME_3DMODEL]))
        {
            $paymentObject->SanalPOS_ID = $this->pos_id;
            $paymentObject->Taksit = $this->taksit_sayisi;
        }

        if (in_array($this->odeme_tipi, [self::ODEME_NORMAL, self::ODEME_DOVIZ, self::ODEME_KART_SAKLAMALI, self::ODEME_3DMODEL]))
        {
            $paymentObject->KK_Sahibi_GSM = $this->cc_holder_gsm;
            $paymentObject->Basarili_URL = $this->success_redirect_url;
            $paymentObject->Hata_URL = $this->fail_redirect_url;
            $paymentObject->Siparis_ID = $this->order_id;
            $paymentObject->Siparis_Aciklama = $this->order_description;
            $paymentObject->Islem_Tutar = $this->order_price;
            $paymentObject->Toplam_Tutar = $this->order_total;
            $paymentObject->Islem_Guvenlik_Tip = $this->odeme_3D ? '3D' : 'NS';
            $paymentObject->Islem_ID = $this->process_id;
            $paymentObject->IPAdr = $this->client_ip;
            $paymentObject->Ref_URL = $this->referrer_page_url;

            if (isset($this->extra_data1))
            {
                $paymentObject->Data1 = $this->extra_data1;
            }
            if (isset($this->extra_data2))
            {
                $paymentObject->Data2 = $this->extra_data2;
            }
            if (isset($this->extra_data3))
            {
                $paymentObject->Data3 = $this->extra_data3;
            }
            if (isset($this->extra_data4))
            {
                $paymentObject->Data4 = $this->extra_data4;
            }
        }

        switch ($this->odeme_tipi)
        {
            case self::ODEME_KART_SAKLAMALI:
                $paymentObject->KS_Kart_No = $this->cc_number;
                $paymentObject->KK_GUID = $this->kartsaklama_guid;
            break;
            case self::ODEME_DOVIZ:
                $paymentObject->Doviz_Kodu = $this->currency_code;
            break;
            case self::ODEME_BKMEXPRESS:
                $paymentObject->Customer_Info = $this->cc_holder;
                $paymentObject->Customer_GSM = $this->cc_holder_gsm;
                $paymentObject->Success_URL = $this->success_redirect_url;
                $paymentObject->Error_URL = $this->fail_redirect_url;
                $paymentObject->Order_ID = $this->order_id;
                $paymentObject->Order_Description = $this->order_description;
                $paymentObject->Amount = $this->order_total;
                $paymentObject->Payment_Hash = $this->HashOlustur();
                $paymentObject->Transaction_ID = $this->process_id;
                $paymentObject->IPAddress = $this->client_ip;
                $paymentObject->Referrer_URL = $this->referrer_page_url;
            break;
        }

        return $paymentObject;
    }
}
