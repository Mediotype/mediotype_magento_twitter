<?php
/**
 * Magento / Mediotype Module
 * 
 *
 * @desc        
 * @category    Mediotype
 * @package     
 * @class       
 * @copyright   Copyright (c) 2013 Mediotype (http://www.mediotype.com)
 *              Copyright, 2013, Mediotype, LLC - US license
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author      Mediotype (SZ,JH) <diveinto@mediotype.com>
 */
class Mediotype_Twitter_Model_Oauth_Consumer extends Varien_Object {

    public $key;
    public $secret;
    public $callback_url;

    function __construct($params){

        $this->key = $params['oauth_token'];
        $this->secret = $params['oauth_token_secret'];

        $callback_url=NULL;
        if(array_key_exists('callback_url', $params))
            $callback_url = $params['callback_url'];

        $this->callback_url = $callback_url;
    }

    function __toString() {
        return "OAuthConsumer[key=$this->key,secret=$this->secret]";
    }
}