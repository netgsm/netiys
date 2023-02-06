


# İYS (İLETİ YÖNETİM SİSTEMİ)

İleti Yönetim Sistemi (İYS), tüm hizmet sağlayıcıların güncel ticari elektronik ileti onaylarını kaydettikleri ulusal veri tabanı sistemidir. Alıcılar (vatandaşlar) onay verebildikleri gibi, mevcut onayları için ret haklarını da İYS üzerinde kullanabilirler.  

Ticari Elektronik İleti; Firmaların, mal ve hizmetlerini pazarlamak, işletmesini tanıtmak ya da kutlama ve temenni gibi içeriklerle tanınırlığını artırmak amacıyla tüketicilere kampanya, özel gün kutlaması,indirim, hediye içerikli vb. gönderdiği mesajlardır.  

Ticari elektronik iletinizin içeriği alıcıdan alınan onaya uygun olmalıdır.  

### Supported Laravel Versions

Laravel 6.x, Laravel 7.x, Laravel 8.x, Laravel 9.x, 

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

```
        use Netgsm\Iys\iys;
    	  $data['type']='MESAJ';
        $data['source']='HS_WEB';
        $data['recipient']='+90553xxxxxxx';
        $data['status']='ONAY';
        $data['consentDate']='2020-11-06 09:40:00';
        $data['recipientType']='BIREYSEL';
        
        $islem=new iys;
        $sonuc=$islem->iys($data);
        echo '<pre>';
        print_r($sonuc);
        echo '<pre>';
```
#### Başarılı istek örnek sonuç
```
Array
(
    [code] => 0
    [error] => false
    [uid] => 59a3ec87-bca0-4c0a-b0d6-a0ff7375735b
)

```

#### Başarısız istek örnek sonuç
```
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

```
        use  Netgsm\Iys\iys;
    	  $data['type']="MESAJ";
        $data['recipient']="+90xxxxxxxxx";
        $data['recipientType']="BIREYSEL";
        $adressorgu=new iys;
        $sonuc=$adressorgu->iysadressorgula($data);
        
        echo '<pre>';
            print_r($sonuc);
        echo '<pre>';
```


