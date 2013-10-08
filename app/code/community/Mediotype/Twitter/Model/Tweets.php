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
class Mediotype_Twitter_Model_Tweets extends Mage_Core_Model_Abstract{

    /**
     * @return stdClass|null
     */
    public function getTweets($refresh = false){
        if($refresh){
            $this->clearTweetCache();
        }
        $tweets = $this->_getTweetCache();
        if($tweets){
            return $tweets;
        }
        try{
            //fetch tweets via api
            /** @var $connection Mediotype_Twitter_Model_Twitter */
            $connection = Mage::getSingleton('twitter/twitter');
            $tweets = $connection->get("https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=".$connection->getHandle()."&count=".$connection->getTweetNumber());
            if(is_array($tweets)){
                $this->_cacheTweets($tweets);
                return $this->_getTweetCache();
            }
            throw new Exception(print_r($tweets->errors, true));
        }catch(Exception $e){
            Mage::logException($e);
        }
        return null;
    }

    public function clearTweetCache(){
        Mage::app()->getCache()->remove("mediotype_tweets");
    }

    /**
     * @param $tweets
     */
    protected function _cacheTweets($tweets){
        Mage::app()->getCache()->save(json_encode($tweets), "mediotype_tweets", array("mediotype_cache"), (int)Mage::getStoreConfig('twitter_config/general/cache_time') * 60);
    }

    /**
     * @return stdClass|null
     */
    protected function _getTweetCache(){
        return json_decode(Mage::app()->getCache()->load("mediotype_tweets"));
    }


}