<?php

/**
 * init actions.
 *
 * @package    sf_sandbox
 * @subpackage init
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class initActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	ini_set('memory_limit', '512M');
    $this->facebook = new Facebook(array(
  					 			   'appId'  => '172395622846837',
  								   'secret' => 'ea4ead91f041779802a15f2c5cf9e63d',
									));
	$this->user = $this->facebook->getUser();
  	if ($this->user) {
  	  try {
        // Proceed knowing you have a logged in user who's authenticated.
        $user_profile = $this->facebook->api('/me');
      } catch (FacebookApiException $e) {
        
      	//echo '<pre>'.htmlspecialchars(print_r($e, true)).'</pre>';
        $this->user = null;
        return sfView::SUCCESS;
      }
      //$this->redirect("init/friends");
	}
  }
  public function executeFriends(sfWebRequest $request)
  {
  	$this->facebook = new Facebook(array(
  			 			   'appId'  => '172395622846837',
  						   'secret' => 'ea4ead91f041779802a15f2c5cf9e63d',
							));
	$this->user = $this->facebook->getUser();
	if(!$this->user){
		$this->redirect("init/index");
	}
	//$this->user_profile = $this->facebook->api('/me');
  	$this->friends = $this->facebook->api('/me/friends');
  	//print_r($this->friends['data']);
  }
  public function executeGetlikes(sfWebRequest $request)
  {
  	// Report simple running errors
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
  	$this->facebook = new Facebook(array(
  	     			   'appId'  => '172395622846837',
  					   'secret' => 'ea4ead91f041779802a15f2c5cf9e63d',
					));
	$likes = $this->facebook->api(''.$request->getParameter('uid').'/likes');
	$sorted = array();
	foreach($likes['data'] as $like){
		$sorted[''.$like['category'].''] += 1;
	}
  	if (count($sorted) == 0){
		echo "Likes not accessible for this friend";
		exit;
	}
	arsort($sorted);
  	foreach ($sorted as $key => $val) {
    	echo "$key = $val likes - ";
	}
	//echo json_encode($sorted);
	exit;
  }
  public function executeGetinfo(sfWebRequest $request)
  {
  	// Report simple running errors
	error_reporting(E_ERROR | E_WARNING | E_PARSE);
  	$this->facebook = new Facebook(array(
  	     			   'appId'  => '172395622846837',
  					   'secret' => 'ea4ead91f041779802a15f2c5cf9e63d',
					));
	$info = $this->facebook->api('/'.$request->getParameter('uid').'');
	foreach ($info as $key => $val) {
    	echo "$key = $val -";
	}
	//echo json_encode($sorted);
	exit;
  }
}
