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
 * OAuthSignatureMethod
 */
abstract class Mediotype_Twitter_Model_Oauth_Signature_Abstract {
    /**
     * Needs to return the name of the Signature Method (ie HMAC-SHA1)
     * @return string
     */
    abstract public function get_name();

    /**
     * Build up the signature
     * NOTE: The output of this function MUST NOT be urlencoded.
     * the encoding is handled in OAuthRequest when the final
     * request is serialized
     * @param OAuthRequest $request
     * @param OAuthConsumer $consumer
     * @param OAuthToken $token
     * @return string
     */
    abstract public function build_signature($request, $consumer, $token);

    /**
     * Verifies that a given signature is correct
     * @param OAuthRequest $request
     * @param OAuthConsumer $consumer
     * @param OAuthToken $token
     * @param string $signature
     * @return bool
     */
    public function check_signature($request, $consumer, $token, $signature) {
        $built = $this->build_signature($request, $consumer, $token);
        return $built == $signature;
    }
}