


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
- [İys Webhook](#iys-webhook)

    
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
### İys Webhook

<ul>
<li>
<p>İYS'ye yüklenen izin ve ret bilgilerinin sonuç durumları, Webhook (Web kancası) uygulaması kullanılarak alınabilir. Bildirim işlemi webhook olarak tanımlanan URL adresine yapılır.</p>
</li>
<li>
<p>Bu servisi kullanabilmek için URL'inizi tanımlamanız gerekmektedir. Bu işlem <a href="https://www.netgsm.com.tr/">www.netgsm.com.tr</a> adresine giriş sağladıktan sonra Dijital Servisler altındaki Netiys modülünden ayarlanabilir, NetİYS Modülü Uygulamalar bölümüne erişmek için, Netgsm web portala login olduktan sonra <a href="https://portal.netgsm.com.tr/webportal/servisler/netiys/webhook">tıklayabilirsiniz</a></p>
</li>
<li>
<p>İYS izninin veya izin değişikliğinin hangi yolla yapıldığı fark etmeksizin webhook ile URL'e bildirilir.</p>
</li>
</ul>
Urle bildirilen alanlar
<table>
<thead>
<tr>
<th>Parametre</th>
<th>Anlamı</th>
</tr>
</thead>
<tbody>
<tr>
<td><code>iyscode</code></td>
<td>İYS'de kayıtlı numaranız</td>
</tr>
<tr>
<td><code>brandcode</code></td>
<td>İYS'de kayıtlı marka kodunuz</td>
</tr>
<tr>
<td><code>type</code></td>
<td>İletişim adres türü <strong>ARAMA</strong>, <strong>MESAJ</strong> ya da <strong>EPOSTA</strong> dan biri döner.</td>
</tr>
<tr>
<td><code>source</code></td>
<td>izin alınan kaynağı ifade eder, <strong>HS_FIZIKSEL_ORTAM, HS_ISLAK_IMZA, HS_WEB, HS_CAGRI_MERKEZI, HS_SOSYAL_MEDYA, HS_EPOSTA, HS_MESAJ, HS_MOBIL, HS_EORTAM, HS_ETKINLIK, HS_2015, HS_ATM ve HS_KARAR</strong> ya da <strong> IYS_3338, IYS_CM, IYS_WEB, IYS_MOBIL, IYS_KISA_LINK </strong> değerlerinden biri döner.</td>
</tr>
<tr>
<td><code>status</code></td>
<td><strong>ONAY ya da RET</strong> değeri döner.</td>
</tr>
<tr>
<td><code>consentDate</code></td>
<td>İzin alınan tarih bilgisi YYYY-mm-dd HH:mm:ss formatında döner.</td>
</tr>
<tr>
<td><code>recipientType</code></td>
<td><strong>BIREYSEL ya da TACIR</strong> olarak döner.</td>
</tr>
<tr>
<td><code>retailercode</code></td>
<td>İzin alınmasında aracılık eden bayinin iyscode bilgisidir.Nümerik bayi iyscode değeri döner.</td>
</tr>
<tr>
<td><code>retailerAccess</code></td>
<td>İzne erişimi olan bayilerin iyscode bilgisidir.	{123456,789456} formatında bayi iyscode bilgisi döner.</td>
</tr>
<tr>
<td><code>submitid</code></td>
<td>İzin yüklenirken oluşturulan, izin paketine ait id bilgisidir.	"40e6215d-b5c6-4896-987c-f30f3678f608" formatında id verisi döner.</td>
</tr>
<tr>
<td><code>recipient</code></td>
<td>İzin alınan kişinin telefon numarası ya da e-posta adresi bilgisdir.	Telefon numaraları E164 uluslararası([+][country code][area code][local phone number]) formatında döner.</td>
</tr>
<tr>
<td><code>resultstatus</code></td>
<td>İznin işlenme durum bilgisidir.	success iznin eklendiğini, failure iznin eklendiğini gösterir.</td>
</tr>
<tr>
<td><code>errcode</code></td>
<td>İzin işlenirken karşılaşılan hata kodu bilgisdir.	"H155" formatında İYS hata kodu formatındadır.</td>
</tr>
<tr>
<td><code>errmsg</code></td>
<td>İzin işlenirken karşılaşılan hata mesajı bilgisdir.	Metin formatında hata mesajı döner.</td>
</tr>
<tr>
<td><code>creationdate</code></td>
<td>İznin İYS tarafında işleme alındığı tarih bilgisidir.	YYYY-MM-DD HH:mm:ss formatında tarih verisi döner.</td>
</tr>
</tbody>
</table>  


```php
{
    "iyscode": 123456,
    "brandcode": 123456,
    "type": "MESAJ",
    "source": "HS_ETKINLIK",
    "status": "ONAY",
    "consentdate": "2010-02-10 13:55:00",
    "recipienttype": "TACIR",
    "retailercode": "987654",
    "retaileraccess": "",
    "submitid": "40e6215d-b5c6-4896-987c-f30f3678f608",
    "recipient": "+90312xxxxxxx",
    "resultstatus": "failure",
    "errcode": "H155",
    "errmsg": "İzin tarihi (consentDate) kabul edilemedi.",
    "creationdate": ""
}
```
##### Laravel kullanıyorsanız veriyi aşağıdaki gibi çekebilirsiniz
```php
    use Illuminate\Http\Request;
    public function index(Request $request)
    {
        
        $data = json_decode($request->getContent(),false);
        $data->recipienttype;
        $data->retailercode;
    }

```
##### Symfony kullanıyorsanız veriyi aşağıdaki gibi çekebilirsiniz
```php
    use Symfony\Component\HttpFoundation\Request;
    public function index(Request $request)
    {
       $data = json_decode($request->getContent(),false);
       $data->recipienttype;
       $data->retailercode;
        
     }

