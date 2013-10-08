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
class Mediotype_Twitter_Block_Renderer_Tweet extends Mage_Core_Block_Template{

    protected $_tweet = NULL;

    //takes a tweet and returns the content with all the links parsed
    public function parseTwitterLinks(){
        $original = $this->getTweet()->text;
        $content = $original;
        foreach($this->getTweet()->entities as $key => $link_type){
            foreach($link_type as $link){
                switch($key){
                    case('hashtags'):
                        $replace = '<a href="http://twitter.com/search?q=%23'.$link->text.'">';
                        $needle = substr($original, $link->indices[0],$link->indices[1] - $link->indices[0]);
                        $content = str_replace($needle, $replace.$needle.'</a>',$content);
                        break;
                    case('symbols'):
                        $replace = '<a>';
                        break;
                    case('urls'):
                        $replace = '<a href="'.$link->url.'" >';
                        $needle = substr($original, $link->indices[0],$link->indices[1] - $link->indices[0]);
                        $content = str_replace($needle, $replace . $link->display_url . '</a>', $content);
                        break;
                    case('user_mentions'):
                        $replace = '<a href="http://www.twitter.com/'.$link->screen_name.'">';
                        $needle = substr($original, $link->indices[0],$link->indices[1] - $link->indices[0]);
                        $content = str_replace($needle, $replace . $needle . '</a>', $content);
                        break;
                    default:
                        $replace = '<a>';
                        break;
                }
            }
        }
        return $content;
    }

    /** return a string of the tweet time */
    public function getPostTime(){
        $today = new DateTime('NOW');
        $tweetime = new DateTime($this->getTweet()->created_at);
        $diff = $today->diff($tweetime);
        if($diff->format('%d') != '0'){
            return $tweetime->format('d M');
        }elseif($diff->format('%h') == '0'){
            return $diff->format('%i').'m';
        }else{
            return $diff->format('%h').'h';
        }
    }

    /** return twitter name */
    public function getName(){
        return $this->_tweet->user->name;
    }

    /** return twitter handle */
    public function getHandle(){
        return $this->_tweet->user->screen_name;
    }

    /** return avatar url */
    public function getAvatarUrl(){
        return $this->_tweet->user->profile_image_url;
    }

    /** return unique tweet id */
    public function getTweetId(){
        return $this->_tweet->id_str;
    }

    /** return twitter user url */
    public function getUserUrl(){
        return "http://twitter.com/".$this->_tweet->user->screen_name;
    }

    /** return permanent tweet url */
    public function getPermaUrl(){
        return "http://twitter.com/".$this->_tweet->user->screen_name."/status/".$this->getTweetId();
    }

    public function setTweet($tweet)
    {
        $this->_tweet = $tweet;
    }

    public function getTweet()
    {
        if(is_null($this->_tweet)){
            $this->setTweet($this->getData('tweet'));
            return $this->_tweet;
        }
        return $this->_tweet;
    }

}