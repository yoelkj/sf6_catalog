<?php
namespace App\EventSubscriber;

use App\Repository\CompanyRepository;
use App\Repository\CountryRepository;
use App\Repository\LanguageRepository;
use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;

use Symfony\Component\HttpKernel\KernelInterface;

class LocaleSubscriber implements EventSubscriberInterface
{
    private $params;
    private $repoCountry;
    private $repoLanguage;
    private $repoCompany;
    private $appKernel;

    public function __construct(ParameterBagInterface $params, CompanyRepository $repoCompany, LanguageRepository $repoLanguage, CountryRepository $repoCountry, KernelInterface $appKernel)
    {
        
      $this->params = $params;
      $this->repoCompany = $repoCompany;
      $this->repoCountry = $repoCountry;
      $this->repoLanguage = $repoLanguage;

      $this->appKernel = $appKernel;
    
    }    

    public function getDefaultLocales(){
      
      $arr_result = [];

      $obj_company = $this->repoCompany->find(1);
      $obj_languages = $this->repoLanguages->findActives(1);
      
      $language = ($obj_company)? $obj_company->getLanguage()->getCode() : 'es';

      $arr_result['language'] = $language;
      foreach($obj_languages as $row) $arr_result['languages'][$row->getId()] = $row->getCode();

      return $arr_result;

    }

    public function onKernelRequest(RequestEvent $event)
    {
      //$event->isMasterRequest()
      $request = $event->getRequest();
      
      if ($request->isXmlHttpRequest() || !$request->hasPreviousSession() || 'app_login' === $request->attributes->get('_route')) return;

      $client_ip = $request->getClientIp();
      $locale_data = $this->getLocationInfoByIp($client_ip);
      $request->getSession()->set('locale_data', $locale_data);

        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);

        } else {
            
            //$brow_lang = substr(\Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']),0,2);
            $brow_lang = 'en';

            $routeName = $request->attributes->get('_route');
            if($routeName == 'app_homepage'){
                $main_lang = $this->repo_c->getMainLanguage($locale_data['country_name']);
                $request->getSession()->set('_locale', $main_lang);
            }

            $defaultLocale = $this->params->get('locale');
            $available_labguajes = explode('|', $this->params->get('app_locales'));    
            
            $current_locale = ($request->getSession()->get('_locale'))?$request->getSession()->get('_locale'):$brow_lang;
            $current_locale = (in_array($current_locale, $available_labguajes))  ?  $current_locale  :  $defaultLocale;

            $request->setLocale($current_locale);
        }
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::REQUEST => [['onKernelRequest', 20]],
        ];
    }


    public function getLocationInfoByIp($client_ip = null){

        $reader = null;
        $GeoLiteDatabasePath = $this->appKernel->getProjectDir().'/private/geolite2-city/GeoLite2-City.mmdb';  

        try {
          $reader = new Reader($GeoLiteDatabasePath);
        } catch (AddressNotFoundException $ex) {
          throw new Exception('Invalid source localization');
        }

        $ip_address = ($client_ip) ? $client_ip : $this->getUserIP();
        $localization = $reader->city($ip_address);

        dd($localization);

        $obj_country = $localization->country;
        $arr_continent_names = (isset($localization->continent->names))?$localization->continent->names:'';
    
        $result['country'] = $obj_country->isoCode;
        $result['country_name'] = (isset($obj_country->names['en']))?$obj_country->names['en']:'';
        $result['continent'] = (isset($arr_continent_names['en']))?$arr_continent_names['en']:'';
    
        return $result;
    }

    public function getUserIP()
		{

      $ip = null;

			if (getenv('HTTP_CLIENT_IP')) $ip =  (filter_var(getenv('HTTP_CLIENT_IP'), FILTER_VALIDATE_IP))?getenv('HTTP_CLIENT_IP'):null;
			elseif (getenv('HTTP_X_FORWARDED_FOR')) $ip =  (filter_var(getenv('HTTP_X_FORWARDED_FOR'), FILTER_VALIDATE_IP))?getenv('HTTP_X_FORWARDED_FOR'):null;
			elseif (getenv('HTTP_X_FORWARDED')) $ip =  (filter_var(getenv('HTTP_X_FORWARDED'), FILTER_VALIDATE_IP))?getenv('HTTP_X_FORWARDED'):null;
			elseif (getenv('HTTP_FORWARDED_FOR')) $ip = (filter_var(getenv('HTTP_FORWARDED_FOR'), FILTER_VALIDATE_IP))?getenv('HTTP_FORWARDED_FOR'):null;
			elseif (getenv('HTTP_FORWARDED')) $ip = (filter_var(getenv('HTTP_FORWARDED'), FILTER_VALIDATE_IP))?getenv('HTTP_FORWARDED'):null;

      if($_SERVER['REMOTE_ADDR'] == '127.0.0.1') $ip = "80.28.108.121";

      if(!$ip) $ip = $_SERVER['REMOTE_ADDR'];

			//$ip = "80.28.108.121"; // ES
			//$ip = "95.18.66.221"; // ES
      //$ip = "80.18.120.118"; // IT
      //$ip = "213.89.37.0"; // SE
      //$ip = "79.93.164.80";//FR
      //$ip = "81.39.38.239";//CANARIAS
			//$ip = "85.214.132.117";//GE
      //$ip = "148.201.255.255";//MX
      //$ip = "77.54.255.255";//PT
      //$ip = "200.52.95.170";//MX
      //$ip = "108.75.193.108";//USA	  

			return $ip;
		}
}