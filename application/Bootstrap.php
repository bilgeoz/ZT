<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap 
{

    protected function _initAutoload() {
        $moduleLoader = new Zend_Application_Module_Autoloader(array(
                    'namespace' => '',
                    'basePath' => APPLICATION_PATH));
        return $moduleLoader;
    }
    /**
     * @return void 
     */
    protected function _initTranslate() 
    {
        $sapi_type = php_sapi_name();
        if ($sapi_type == 'apache2handler')
        {
            $translate = new Zend_Translate('csv',
                APPLICATION_PATH . '/configs/lang',
                null,
                array('scan' => Zend_Translate::LOCALE_FILENAME)
            );

            $session = new Zend_Session_Namespace('ZT');
            try {
                $locale = new Zend_Locale();
                if (isset($session->language)) {
                    $requestedLanguage = $session->language;
                    $locale->setLocale($requestedLanguage);
                } else {
                    //$locale->setLocale(Zend_Locale::BROWSER);
                    $locale->setLocale('en');
                    $requestedLanguage = key($locale->getBrowser());
                }
            } catch (Zend_Locale_Exception $e) {
                $locale = new Zend_Locale('en');
            }
            if (in_array($requestedLanguage, $translate->getList())) {
                $language = $requestedLanguage;
            } else {
                $language = 'en';
            }
            $translate->setLocale($language);
            Zend_Registry::set('Zend_Translate', $translate);
        }
    }

}

