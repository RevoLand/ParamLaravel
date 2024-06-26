<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Param Laravel Integration Settings
     |--------------------------------------------------------------------------
     |
     | Hata Kodları Detayı
     |
     | https://dev.param.com.tr/tr/hata-kodlari
     */
    'PARAM_CLIENT_CODE' => env('PARAM_CLIENT_CODE'),
    'PARAM_CLIENT_USERNAME' => env('PARAM_CLIENT_USERNAME'),
    'PARAM_CLIENT_PASSWORD' => env('PARAM_CLIENT_PASSWORD'),
    'PARAM_GUID' => env('PARAM_GUID'),
    'PARAM_TEST_MODE' => env('PARAM_TEST_MODE', true),
    'CONNECTION_TIMEOUT' => env('PARAM_CONNECTION_TIMEOUT', 30),

    'error_messages' => [
        '1' => 'Başarılı',
        '-1' => 'Başarısız',
        '-100' => 'Hesap bulunamadı.',
        '-101' => 'Güvenlik hatası.',
        '-102' => 'İşlem Hash geçersiz.',
        '-103' => 'GUID uzunluğu geçersiz.',
        '-104' => 'Siparis_ID en fazla 36 karakter olabilir.',
        '-105' => 'Kredi kartı CVV uzunluğu geçersiz. 3 hane olmalıdır.',
        '-106' => 'Kredi kartı yıl uzunluğu geçersiz.',
        '-107' => 'Kredi kartı son kullanma ay uzunluğu geçersiz.',
        '-108' => 'Müşteri GSM no geçersiz.',
        '-109' => 'SanalPOS_ID uzunluğu geçersiz.',
        '-110' => 'Taksit geçersiz.',
        '-111' => 'IP formatı geçersiz.',
        '-112' => 'Tutar formatı geçersiz. Nokta kullanmayınız. Kuruş formatında virgüllü gönderiniz.',
        '-113' => 'Tutar, 0 dan küçük veya eşit olmamalıdır.',
        '-114' => 'Test kullanıcısı ile işlem yapılamaz.',
        '-115' => 'Tutar formatı geçersiz. Virgülden sonra 2 basamak şeklinde olmalıdır.',
        '-116' => 'Başarılı URL veya Hata URL boş olamaz.',
        '-117' => 'GSM No numeric olmalıdır.',
        '-118' => 'Kredi Kartı No uzunluğu geçersiz.',
        '-119' => 'Kredi Kart No formatı hatalı.',
        '-120' => 'Tarih formatı hatalı.',
        '-121' => 'Kredi Kartı sahibi bilgisini eksiksiz giriniz.',
        '-200' => 'Komisyon bilgisi bulunamadı.',
        '-201' => 'SanalPOS_ID ye ait taksit geçersiz.',
        '-202' => 'Toplam tutara eklenen komisyon hatalı.',
        '-203' => 'Kesilecek komisyon bilgisi hesaplanırken hata oluştu.',
        '-204' => 'SanalPOS Tipi hatalı.',
        '-205' => 'Ödeme bilgileri kayıt edilirken hata oluştu. İşlemi tekrarlayınız.',
        '-206' => 'Sanal POS İşlemi kaydedilemedi.',
        '-207' => 'Sistem Hatası',
        '-208' => 'SanalPOS Tipi veya Kart No bulunamadı.',
        '-209' => 'İşlem bilgisi bulunamadı.',
        '-210' => 'İptal/İadeye uygun işlem bulunamadı.',
        '-211' => 'İşlem iptal durumunda.',
        '-212' => 'İşlem iade durumunda.',
        '-213' => 'İade olabilecek işlem İptal edilmek isteniyor.',
        '-214' => 'İptal olabilecek işlem İade edilmek isteniyor.',
        '-215' => 'SanalPOS_ID ile Kredi Kartı BIN kodu uyumsuz. Kredi Kartı markasına göre yanlış SanalPOS_ID seçiliyor.',
        '-216' => 'GUID ile Güvenlik nesnesi eşleşmiyor.',
        '-217' => 'İptal veya İade edilecek Tutar, işlem tutarından büyük olamaz.',
        '-218' => 'İptal edilecek işlemin için Tutar hatalı.',
        '-219' => 'Durum parametresi boş olamaz. IPTAL veya IADE gönderiniz.',
        '-220' => 'Debit Kart ile taksitli işlem yapılamaz veya yasaklı bilgi ile işlem yapılamaz.',
        '-221' => 'İade Tutarı, İade Edilebilir Tutar’dan büyük olamaz.',
        '-222' => 'Tarih aralığı 7 günden fazla olamaz.',
        '-223' => 'Test kredi kartı ile gerçek ortamda işlem yapılamaz.',
        '-300' => 'Kart saklama yapılamadı.',
        '-301' => 'Kart çözümleme başarısız.',
        '-90004' => 'Aylık POS işlem limitiniz dolmuştur.',
    ],
];
