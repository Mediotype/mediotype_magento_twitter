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
class Mediotype_Twitter_Model_Oauth_Token {
    // access tokens and request tokens
    public $key;
    public $secret;

    /**
     * key = the token
     * secret = the token secret
     */
    function __construct($key, $secret) {
        $this->key = $key;
        $this->secret = $secret;
    }

    /**
     * generates the basic string serialization of a token that a server
     * would respond to request_token and access_token calls with
     */
    function to_string() {
        return "oauth_token=" .
            Mage::getModel('twitter/oauth_util')->urlencode_rfc3986($this->key) .
            "&oauth_token_secret=" .
            Mage::getModel('twitter/oauth_util')->urlencode_rfc3986($this->secret);
    }

    function __toString() {
        return $this->to_string();
    }
}