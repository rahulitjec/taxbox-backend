<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
 
class Facebook
{
  var $ci;
  var $session = false;
  private static $_fb = null;
  private static $_redirect_url = 'http://www.argalon.net/foreign_resident/User_controller/fb_callback';

  public function __construct()
  {
	   
    $fb = new Facebook\Facebook([
        'app_id' => '1675185009221173',
        'app_secret' => '9cef8fa21a8fd092e9f4b60a66b9fbaa',
        'default_graph_version' => 'v2.8',
      ]); 
	 

     self::$_fb = $fb; 
  }
 
  /**
   * Get FB session.
   */
   public function get_session()
  {
    if ( $this->ci->session->userdata('fb_token') ) {
      // Validate the access_token to me it's still valid
      $this->session = new FacebookSession( $this->ci->session->userdata('fb_token') );
      try {
        if ( ! $this->session->validate() ) {
          $this->session = false;
        }
      } catch ( Exception $e ) {
        // Catch any exceptions
        //print_r($e);
        $this->session = false;
      }
    }
    else
    {
      // Add `use Facebook\FacebookRedirectLoginHelper;` to top of file
      $helper = new FacebookRedirectLoginHelper( $this->ci->config->item('redirect_url', 'facebook') );
      try {
        $this->session = $helper->getSessionFromRedirect();
      } catch( FacebookRequestException $ex ) {
        // When Facebook returns an error
        print_r($ex->getResponse());
        //redirect( base_url( 'login?err=' . $ex->getResponse() ) );
      } catch( \Exception $ex ) {
        print_r($ex->getResponse());
        // When validation fails or other local issues
        //redirect( base_url( 'login?err=' . $ex->getResponse() ) );
      }
    }
  } 
 
  /**
   * Login functionality.
   */
  public function login()
  {
    $this->get_session();
    if ( $this->session )
    {
      $this->ci->session->set_userdata( 'fb_token', $this->session->getToken() );
 
      $user = $this->get_user();
 
      if ( $user && ! empty( $user['email'] ) )
      {
         $result = $this->ci->Common_model->select_data( 'users', array('email'=> $user['email'] ))->result();
 
          if ( ! $result )
          {
            // Not registered.
            //$user['role'] = $role;
            $user['type'] = 'facebook';
            $data['user'] = $user;

            //$this->ci->load->view('social_callback.php', $data);
             redirect( base_url('vendorform')); 
            //print_r($user);
          }
          else
          {
            if ( $this->ci->Common_model->doLogin( $result[0]->email, $result[0]->password ) )
            {
              redirect( base_url() );
            }
            else
            {
              die( '1ERROR' );
              redirect( base_url() );
            }
          }
      }
      else
      {
        die( '2ERROR' );
      }
    }
  }
 
  /**
   * Returns the login URL.
   */
  public function login_url()
  {
    // Add `use Facebook\FacebookRedirectLoginHelper;` to top of file
    $helper = self::$_fb->getRedirectLoginHelper();
    $permissions = ['email', 'user_likes']; // optional
    $loginUrl = $helper->getLoginUrl(self::$_redirect_url, $permissions);
 
    return $loginUrl;
    // Use the login url on a link or button to
    // redirect to Facebook for authentication
  }
 
  /**
   * Returns the current user's info as an array.
   */
  public function get_user()
  {
    $this->get_session();
    if ( $this->session )
    {
      $request = ( new FacebookRequest( $this->session, 'GET', '/me?fields=email,name,gender' ) )->execute();
      $user    = $request->getGraphObject()->asArray();
 
      return $user;
    }
    return false;
  } 
 
  /**
   * Get user's profile picture.
   */
   public function get_profile_pic( $user_id )
  {
    $this->get_session();
    if ( $this->session )
    {
      $request = ( new FacebookRequest( $this->session, 'GET', '/' . $user_id . '/picture?redirect=false&type=large' ) )->execute();
      $pic     = $request->getGraphObject()->asArray();
 
      if ( ! empty( $pic ) && ! $pic['is_silhouette'] ) {
        return $pic['url'];
      }
    }
    return false;
  } 
  
  
}