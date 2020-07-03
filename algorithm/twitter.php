<?php

class Twitter{
    private $followList = [];
    private $twitterContent = [];
    private $sort = 1; // 用时间戳导致插入时间相同排序会出问题
	function __construct() {
	 
	}
    function postTweet($userId, $tweetId) 
    {   
        $this->twitterContent[$userId][] = ['id' => $tweetId, 'sort' => $this->sort++];
    }
  
    function getNewsFeed($userId) 
    {   
        $myFollow = $this->getMyfollow($userId);
        $myFollow[$userId] = 1; 

        $twitterList = [];
        foreach ($myFollow as $key => $value) {
            $count = count($this->twitterContent[$key]) - 1;
            for($i = $count; $i >=0; $i--){    
                if ($count - $i == 10) break; // 每个用户取前10条
                $twitterList[] = $this->twitterContent[$key][$i];
            }
        }

        array_multisort(array_column($twitterList,'sort'),SORT_DESC,$twitterList);

        $tweetIds = [];
        foreach ($twitterList as $key => $value) {
            if (count($tweetIds) == 10) break;
            $tweetIds[] = $value['id'];
        }

        return $tweetIds;
    }

    function follow($followerId, $followeeId) 
    {
        $this->followList[$followerId][$followeeId] = 1;
    }

    function unfollow($followerId, $followeeId) 
    {
        unset($this->followList[$followerId][$followeeId]);
    }

    private function getMyfollow($followerId)
    {   
        if (empty($this->followList[$followerId])) return [];
        return $this->followList[$followerId]; 
    }
	
	function print_v(){
		print_r($this->twitterContent);
		print_r($this->followList);
	}
}
#region 双向关注列表
class Twitter1 {
    private $user_follows = [];
    private $followed_users = [];
    private $time = 0;
    private $user_posts = [];
    private $user_newest_posts = [];
    /**
     * Initialize your data structure here.
     */
    function __construct() {
        $user_follows = [];
        $followed_users = [];
        $time = 0;
        $user_posts = [];
        $user_newest_posts = [];
    }
  
    /**
     * Compose a new tweet.
     * @param Integer $userId
     * @param Integer $tweetId
     * @return NULL
     */
    function postTweet($userId, $tweetId) {
        $post_time = $this->time++;
        $this->user_posts[$userId][] = [$tweetId,$post_time];
        $this->updateUserNewesrPosts($userId,$tweetId,$post_time);
        $this->updateFollowedUserNewestPosts($userId,$tweetId,$post_time);
    }

    function updateUserNewesrPosts($userId, $tweetId,$post_time){
        $this->user_newest_posts[$userId][] = [$tweetId,$post_time];
		$this->user_newest_posts[$userId] = array_unique($this->user_newest_posts[$userId],SORT_REGULAR);
        while(count($this->user_newest_posts[$userId]) > 10){
            array_shift($this->user_newest_posts[$userId]);
        }
    }

    function updateFollowedUserNewestPosts($userId, $tweetId,$post_time){
        $followed_users = $this->followed_users[$userId];
        if(!empty($followed_users)){
            foreach($followed_users as $followed_userId){
                $this->updateUserNewesrPosts($followed_userId,$tweetId,$post_time);
            }
        }
    }
  
    /**
     * Retrieve the 10 most recent tweet ids in the user's news feed. Each item in the news feed must be posted by users who the user followed or by the user herself. Tweets must be ordered from most recent to least recent.
     * @param Integer $userId
     * @return Integer[]
     */
    function getNewsFeed($userId) {
		$posts = $this->user_newest_posts[$userId];
		if(is_null($posts)){
			return [];
		}else{
			return array_map(function($v){
				return $v[0];
			},array_reverse($posts));
		}
    }
  
    /**
     * Follower follows a followee. If the operation is invalid, it should be a no-op.
     * @param Integer $followerId
     * @param Integer $followeeId
     * @return NULL
     */
    function follow($followerId, $followeeId) {
        !in_array($followeeId,$this->user_follows[$followerId]) && $this->user_follows[$followerId][] = $followeeId;
		!in_array($followerId,$this->followed_users[$followeeId]) && $this->followed_users[$followeeId][] = $followerId;
        $this->updateFollowerNewestPosts($followerId,$followeeId);
    }

    function updateFollowerNewestPosts($followerId, $followeeId){
        $follower_newest_posts = $this->user_newest_posts[$followerId];
        $followee_newest_posts = $this->getTopTenPosts($this->user_posts[$followeeId]);

        $ans = array_merge($follower_newest_posts ?? [],$followee_newest_posts ?? []);
		//print_r($ans);
        $this->user_newest_posts[$followerId] = $this->getTopTenPosts( array_unique($ans,SORT_REGULAR),true);
    }

    function getTopTenPosts($ans,$sort = false){
        if($sort){
            uasort($ans,function($a,$b){
                return $a[1] - $b[1];
            });
        }
		///print_r($ans);
		if(is_null($ans))
			return [];
		if(count($ans) > 10){
			return array_slice($ans,count($ans) - 10,10);
		}else{
			return $ans;
		}
    }
  
    /**
     * Follower unfollows a followee. If the operation is invalid, it should be a no-op.
     * @param Integer $followerId
     * @param Integer $followeeId
     * @return NULL
     */
    function unfollow($followerId, $followeeId) {
		$this->unsetArray($this->user_follows[$followerId],$followeeId);
		$this->unsetArray($this->followed_users[$followeeId],$followerId);

        $user_posts = $this->getTopTenPosts($this->user_posts[$followerId]); 
		if(!empty($this->user_follows[$followerId])){
			foreach($this->user_follows[$followerId] as $userId){
				$follow_posts = $this->getTopTenPosts($this->user_posts[$userId]);
				$user_posts = array_merge($user_posts,$follow_posts);
			}
		}
		
        $this->user_newest_posts[$followerId] = $this->getTopTenPosts( array_unique($user_posts,SORT_REGULAR),true);
    }
	
	function unsetArray(&$array,$value){
		if(empty($array))return;
		foreach($array as $key => $v){
			if($v == $value)
				unset($array[$key]);
		}
	}
	
	function print_v(){
		print_r($this->user_follows);
		print_r($this->followed_users);
		print_r($this->user_posts);
		print_r($this->user_newest_posts);
	}
}
#endregion


/* ["Twitter","postTweet","getNewsFeed","follow","postTweet","getNewsFeed","unfollow","getNewsFeed"]
[[],[1,5],[1],[1,2],[2,6],[1],[1,2],[1]] */
$t = new Twitter();
$t->postTweet(1,101);
$t->postTweet(1,102);
/* $t->postTweet(2,103);
$t->postTweet(2,104);
$t->postTweet(2,105); */
$t->postTweet(3,106);
$t->postTweet(3,107);
/* $t->postTweet(4,109);
$t->postTweet(4,110);
$t->postTweet(4,111);
$t->postTweet(5,112);
$t->postTweet(5,113);
$t->postTweet(5,114); */
$t->follow(1,3);
$t->follow(3,1);
$t->follow(1,3);

$t->follow(1,1);
$t->postTweet(1,100);
$t->print_v();
//$t->postTweet(3,108);

/* $t->follow(4,2);
$t->follow(4,1);
$t->follow(3,2);
$t->follow(3,5);
$t->follow(3,1);

$t->follow(2,3);
$t->follow(2,1);
$t->follow(2,5);
$t->follow(5,1);
$t->follow(5,2); */

/**
 * Your Twitter object will be instantiated and called as such:
 * $obj = Twitter();
 * $obj->postTweet($userId, $tweetId);
 * $ret_2 = $obj->getNewsFeed($userId);
 * $obj->follow($followerId, $followeeId);
 * $obj->unfollow($followerId, $followeeId);
 */
 
