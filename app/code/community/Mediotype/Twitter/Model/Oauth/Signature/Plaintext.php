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
class Mediotype_Twitter_Model_Oauth_Signature_Plaintext extends Mediotype_Twitter_Model_Oauth_Signature_Abstract{

    public function get_name() {
        return "PLAINTEXT";
    }

    /**
     * oauth_signature is set to the concatenated encoded values of the Consumer Secret and
     * Token Secret, separated by a '&' character (ASCII code 38), even if either secret is
     * empty. The result MUST be encoded again.
     *   - Chapter 9.4.1 ("Generating Signatures")
     *
     * Please note that the second encoding MUST NOT happen in the SignatureMethod, as
     * OAuthRequest handles this!
     */
    public function build_signature($request, $consumer, $token) {
        $key_parts = array(
            $consumer->secret,
            ($token) ? $token->secret : ""
        );

        $key_parts = Mage::getSingleton('twitter/oauth_util')->urlencode_rfc3986($key_parts);
        $key = implode('&', $key_parts);
        $request->base_string = $key;

        return $key;
    }

}