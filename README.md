


# İYS (İLETİ YÖNETİM SİSTEMİ)

İleti Yönetim Sistemi (İYS), tüm hizmet sağlayıcıların güncel ticari elektronik ileti onaylarını kaydettikleri ulusal veri tabanı sistemidir. Alıcılar (vatandaşlar) onay verebildikleri gibi, mevcut onayları için ret haklarını da İYS üzerinde kullanabilirler.  

Ticari Elektronik İleti; Firmaların, mal ve hizmetlerini pazarlamak, işletmesini tanıtmak ya da kutlama ve temenni gibi içeriklerle tanınırlığını artırmak amacıyla tüketicilere kampanya, özel gün kutlaması,indirim, hediye içerikli vb. gönderdiği mesajlardır.  

Ticari elektronik iletinizin içeriği alıcıdan alınan onaya uygun olmalıdır.  

<b> NETGSM, İleti Yönetim Sistemi Aracı Hizmet Sağlayıcı kurumdur.</b>

## İçindekiler
- [İletişim & Destek](#destek)
- [Supported](#Supported-Laravel-Versions)
- [Kurulum](#kurulum)
- [İys Adres Ekle](#iys-adres-ekleme)
- [İys Adres Sorgula](#iys-adres-sorgulama)

    
# İletişim & Destek

 Netgsm API Servisi ile alakalı tüm sorularınızı ve önerilerinizi teknikdestek@netgsm.com.tr adresine iletebilirsiniz.


# Doküman 
https://www.netgsm.com.tr/dokuman/
 API Servisi için hazırlanmış kapsamlı dokümana ve farklı yazılım dillerinde örnek amaçlı hazırlanmış örnek kodlamalara 
 [https://www.netgsm.com.tr/dokuman](https://www.netgsm.com.tr/dokuman) adresinden ulaşabilirsiniz.  
 
### Supported Laravel Versions

Laravel 6.x, Laravel 7.x, Laravel 8.x, Laravel 9.x, 
### Supported Lumen Versions

Lumen 6.x, Lumen 7.x, Lumen 8.x, Lumen 9.x, 

### Supported Symfony Versions

Symfony 4.x, Symfony 5.x, Symfony 6.x

### Supported Php Versions

PHP 7.2.5 ve üzeri



### Kurulum

composer require netgsm/iys 

.env  dosyası içerisinde NETGSM ABONELİK bilgileriniz tanımlanması zorunludur.  

<b>NETGSM_USERCODE=""</b>  
<b>NETGSM_PASSWORD=""</b>  
<b>NETGSM_BRANDCODE=""</b>  

## PARAMETRELER

<table width="300">
  <th>Parametre</th>
  <th>Anlamı</th>
  <tr>
    <td><b> type</b> </td>
    <td>letişim adres türü ARAMA, MESAJ ya da EPOSTA dan biri olmalıdırl. Zorunlu parametre </td>
    
  </tr>
  <tr>
    <td><b> source</b> </td>
    <td>izin alınan kaynağı ifade eder, HS_FIZIKSEL_ORTAM, HS_ISLAK_IMZA, HS_WEB, HS_CAGRI_MERKEZI, HS_SOSYAL_MEDYA, HS_EPOSTA, HS_MESAJ, HS_MOBIL, HS_EORTAM, HS_ETKINLIK, HS_2015, HS_ATM ve HS_KARAR değerlerini alabilir. Zorunlu parametre </td>
  </tr>
  <tr>
    <td><b> recipient</b> </td>
    <td>İzin alınan kullanıcının telefon numarası ya da e-posta bilgisidir. +905XXXXXXXXX ya da info@netgsm.com.tr formatlarında olmalıdır. Zorunlu parametre

  </td>
  </tr>
  <tr>
    <td><b> status </b> </td>
    <td>ONAY ya da RET değerini gönderebilirsiniz. Zorunlu parametre
   </td>
  </tr>
  <tr>
    <td><b> consentDate </b> </td>
    <td> İzin alınan tarih bilgisi YYYY-mm-dd HH:mm:ss formatında gönderilmelidir. Zorunlu parametre 
  </td>
  </tr>
  <tr>
    <td><b> recipientType  </b> </td>
    <td> BIREYSEL ya da TACIR parametre olarak gönderilmelidir. Zorunlu parametre 
</td>
  </tr>
  
  
</table> 

### iYS ADRES EKLEME


İYS API Servisi ile Hizmet sağlayıcıların Netgsm İYS İş ortağı aracılığıyla iletişim adreslerini yükleyebilirler.  

```php
	use Netgsm\Iys\iys;
    	$data=array('type'=>'MESAJ','source'=>'HS_WEB','recipient'=>'+90553xxxxxxx','recipientType'=>'BIREYSEL','status'=>'ONAY','consentDate'=>'2020-11-06 09:40:00');
        $islem=new iys;
        $sonuc=$islem->iys($data);
        dd($sonuc);
        die;
```
#### Başarılı istek örnek sonuç
```php
Array
(
    [code] => 0
    [error] => false
    [uid] => 59a3ec87-bca0-xxxx-xxxx-xxxxxxx
)

```

#### Başarısız istek örnek sonuç
```php
Array
(
    [code] => 70
    [error] => Hatalı JSON formatı.
    [erroritem] => Array
        (
            [0] => stdClass Object
                (
                    [recipient] =>  +90553xxxxxxx
                )

        )

```

### iYS ADRES SORGULAMA

Hizmet sağlayıcıların İYS veritabanında kayıtlı iletişim adreslerini sorgulayabileceği servistir.

```php
        use  Netgsm\Iys\iys;
    	$data=array('type'=>'MESAJ','recipient'=>'+90553xxxxxxx','recipientType'=>'BIREYSEL');
        $adressorgu=new iys;
        $sonuc=$adressorgu->iysadressorgula($data);
        
        dd($sonuc);
        die;
        
        
```

#### Başarılı istek örnek sonuç
```php
Array
(
    [code] => 0
    [error] => false
    [query] => stdClass Object
        (
            [recipientType] => BIREYSEL
            [recipient] => +9055xxxxxxx
            [source] => HS_WEB
            [type] => MESAJ
            [consentDate] => 2023-01-24 09:40:00
            [status] => ONAY
            [creationDate] => 2023-01-26 09:48:54
            [retailerAccessCount] => 0
            [transactionId] => 52402b9a59206462axxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
        )

)
```

#### Başarısız istek örnek sonuç
```php
Array
(
    [code] => 50
    [error] => Kayıt Bulunamadı.
)
```
