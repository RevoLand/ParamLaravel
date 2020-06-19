# Param Laravel Entegrasyonu

**ENV dosyası**

``` php
PARAM_CLIENT_CODE="10738"
PARAM_CLIENT_USERNAME="Test"
PARAM_CLIENT_PASSWORD="Test"
PARAM_GUID="0c13d406-873b-403b-9c09-a5766840d98c"
PARAM_TEST_MODE=true
```

___

## Örnek Kullanımlar:

### Param sınıfını çağırma

``` php
use RevoLand\ParamLaravel\Param;

$param = new Param();
```
___
### Param sınıfı üzerinden kullanılabilecek metotlar

``` php
use RevoLand\ParamLaravel\Param;

$param = new Param();

$param->getClient();
// Param sınıfına bağlı olan Client nesnesini döndürür.

$param->setClient(RevoLand\ParamLaravel\Client $client);
// Param sınıfına bağlı Client nesnesini verilen nesne ile değiştirir.

$param->getSoapClient();
// Mevcut ortam ayarlarına bağlı olarak yeni bir SoapClient nesnesi oluşturur.

$param->getKsSoapClient();
// Mevcut ortam ayarlarına bağlı olarak; Kart Saklama sisteminde kullanılmak üzere yeni bir SoapClient nesnesi oluşturur.

$param->DekontIdIleIslemBilgiGetir(int $dekont_id);
// Verilen Dekont ID numarasına bağlı işlem bilgilerini döndürür.

$param->SiparisIdIleIslemBilgiGetir(string $siparis_id);
// Verilen Sipariş ID'sine bağlı işlem bilgilerini döndürür.

$param->IslemIdIleIslemBilgiGetir(string $islem_id);
// Verilen İşlem ID'sine bağlı işlem bilgilerini döndürür.

$param->IslemOzetleriGetir(string $tarih_baslangic, string $tarih_bitis);
// Verilen tarih aralığında yapılan işlemlerin özetini döndürür.

$param->IslemDekontuGonder(int $dekont_id, string $gonderilecek_eposta);
// Verilen Dekont ID numarasına bağlı işlem için, verilen e-posta adresine işlem bilgilerini gönderir.

$param->BinSanalPosGetir(string $bin = '');
// Eğer verilmişse; BIN kodunun ait olduğu karta ait bilgileri ve kullanılabilek SanalPos_Id değerini döndürür,
// aksi durumda sistem tarafından bilinen tüm bin/kart bilgilerini döndürür.

$param->OzelOranSkListeGetir();
// Özel oran son kullanıcı liste, standart olarak Firma Pos Oranları deki metottan dönen oranların aynısı döner. Üye işyerinin müşterisine göstereceği komisyon oranlarını listeler. 

$param->IslemIptalIade(string $durum, int $dekont_id, string $tutar);
// Verilen Dekont ID numarasının bağlı olduğu işlemi, belirtilen $tutar üzerinden iptal/iade eder.
// $durum değeri olarak "IPTAL" ya da "IADE" kullanılabilir.

$param->SakliKartListesiGetir(string $kart_no = null, string $kart_saklama_kisi_id = null);
```
___
### Düzenlenmiş bir Client nesnesi ile Param sınıfı oluşturma

``` php
use RevoLand\ParamLaravel\Client;
use RevoLand\ParamLaravel\Param;

$client = new Client('10738', 'Test', 'Test', '0c13d406-873b-403b-9c09-a5766840d98c', true, [
    'soap_version' => 'SOAP_1_1',
    'trace' => 1,
    'stream_context' => stream_context_create([
        'ssl' => [
            'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
        ],
    ]),
]);

$param = new Param($client);
```
___
### Hâli hazırda var olan bir Param sınıfının Client nesnesini değiştirme

``` php
use RevoLand\ParamLaravel\Client;
use RevoLand\ParamLaravel\Param;

$param = new Param();

$client = new Client('10738', 'Test', 'Test', '0c13d406-873b-403b-9c09-a5766840d98c', true, [
    'soap_version' => 'SOAP_1_1',
    'trace' => 1,
    'stream_context' => stream_context_create([
        'ssl' => [
            'crypto_method' => STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT,
        ],
    ]),
]);

$param->setClient($client);
```

> *Normal bir kullanım için ENV dosyasında yapacağınız değişiklikler yeterlidir. Client sınıfını çağırmanıza/ayarlamanıza gerek yoktur.*
___
### BinSanalPosGetir Metodu

*Verilen BIN için kullanılabilecek Pos bilgilerini döndürür. Aynı zamanda verilen BIN'i trim fonksiyonundan geçirir ve yalnızca ilk 6 karakteri alır. BIN belirtilmez ise sistemde mevcut olan tüm BIN bilgilerini döndürür.*

``` php
use RevoLand\ParamLaravel\Param;

$param = new Param();
$cardPosGetir = $param->BinSanalPosGetir('4546711234567894');

// Örnek Çıktı:
{#266 ▼
  +"Sonuc": "1"
  +"Sonuc_Str": "Başarılı"
  +"Sonuc_Aciklama": "Başarılı"
  +"DT_Bilgi": array:1 [▼
    0 => array:8 [▼
      "@attributes" => array:2 [▼
        "id" => "Temp1"
        "rowOrder" => "0"
      ]
      "BIN" => "454671"
      "SanalPOS_ID" => "1008"
      "Kart_Banka" => "T.C. ZİRAAT BANKASI A.Ş."
      "DKK" => "0"
      "Kart_Tip" => "Kredi Kartı"
      "Kart_Org" => "VISA"
      "Banka_Kodu" => "10"
    ]
  ]
}
```
