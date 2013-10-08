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
 * @author      Mediotype <diveinto@mediotype.com>
 */
class Mediotype_Twitter_Block_Tweets extends Mage_Core_Block_Template{

    /**
     * @return stdClass|null
     */
    public function getTweets(){
        return Mage::getModel('twitter/tweets')->getTweets();
    }

    public function getTwitterHandle(){
        return Mage::getStoreConfig('twitter_config/general/handle');
    }
}