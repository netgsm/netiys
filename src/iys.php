<?php

namespace Netgsm\Iys;

use Exception;
use Ramsey\Uuid\Type\Integer;
use SimpleXMLElement;

class iys
{   
    private $username;
    private $password;
    private $brandcode;
    public function __construct()
    {
     if(isset($_ENV['NETGSM_USERCODE']))
      {
          $this->username=$_ENV['NETGSM_USERCODE'];
      }
      else{
          $this->username='x';
      }
      if(isset($_ENV['NETGSM_PASSWORD']))
      {
          $this->password=$_ENV['NETGSM_PASSWORD'];
      }
      else{
          $this->password='x';
      }
      if(isset($_ENV['NETGSM_BRANDCODE']))
      {
          $this->brandcode=$_ENV['NETGSM_BRANDCODE'];
      }
      else{
          $this->brandcode='x';
      }
        
    }
    
    public function iys(array $data):array
    {

        if(!isset($data['type'])){
           $res['cevap']='type giriniz.';
           return json_encode($res);
        }
        if(!isset($data['source'])){
            $res['cevap']='source giriniz.';
            return json_encode($res);
        }
        if(!isset($data['recipient'])){
            $res['cevap']='recipient giriniz.';
           return json_encode($res);
        }
        if(!isset($data['status'])){
            $res['']='status giriniz.';
           return json_encode($res);
        }
        if(!isset($data['consentDate'])){
            $res['cevap']='consentDate giriniz.';
            return json_encode($res);
        }
        if(!isset($data['recipientType'])){
            $res['cevap']='recipientType giriniz.';
           return json_encode($res);
        }

        if(isset($data['refid'])){
                $bd=array(  
                    "data" => [
                       array(
                       "type"       	=> $data['type'],
                       "source"    		=> $data['source'],
                       "recipient"    => $data['recipient'],
                       "status"  			=> $data['status'],
                       "consentDate"  => $data['consentDate'],
                       "recipientType"=> $data['recipientType'],
                       "refid"=> $data['refid'],       
                            )
                        ]       
                       );    
        }
        else{
            $bd=array(  
                "data" => [
                   array(
                   "type"       	=> $data['type'],
                   "source"    		=> $data['source'],
                   "recipient"    => $data['recipient'],
                   "status"  			=> $data['status'],
                   "consentDate"  => $data['consentDate'],
                   "recipientType"=> $data['recipientType'],
                           
                     )
                    ]       
                   );
        }	
        try {
            $arr_acc = array(
             "header" => array( "username" => $this->username,"password" => $this->password,"brandCode" => $this->brandcode ),
             "body" => $bd
            );			
            $url_acc = "https://api.netgsm.com.tr/iys/add";  
            $content_acc = json_encode($arr_acc);				
        
            

            $curl = curl_init('https://api.netgsm.com.tr/iys/add');
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content_acc);				
            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);		
            
           
            

            $response=(array)json_decode($json_response);

            return $response;
           
           

            
        } catch (Exception $exc)
          {  
          echo $exc->getMessage();
        }
    }
    public function iysadressorgula($data):array
    {
        try {
            $arr_acc = array(
             "header" => array( "username" => $this->username,"password" => $this->password,"brandCode" => $this->brandcode ),
             "body" => array(  
                  "data" => [array(
                     "type"       	=> $data['type'],		
                     "recipient"    => $data['recipient'],			 			 
                     "recipientType"=> $data['recipientType']			 
                 ) ]      
                        ));			
            $url_acc = "https://api.netgsm.com.tr/iys/search";  
            $content_acc = json_encode($arr_acc);				
        
            $curl = curl_init($url_acc);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER,
            array("Content-type: application/json"));
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $content_acc);				
            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);				
            
            $response=(array)json_decode($json_response);
                        
            return $response;
           
         
        } catch (Exception $exc)
          {  
          echo $exc->getMessage();
        }
    }
}