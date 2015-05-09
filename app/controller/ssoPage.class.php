<?php
/**
 * 
 */

class SsoPage extends Controller {
    public function __construct() {
        parent::__construct();
        $this->assign('isLogin', 0);
        $this->tree = CategoryInterface::getTree();
    }

    //直接输出
    public function loginAction() {
        if( $_POST ) {
            $post = $_POST;
            $username = $post['username'];
            $pwd = $post['pwd'];
            if( $username && $pwd ) {
                $userinfo = UserInterface::getInfo($username);
                if( !empty($userinfo) && $userinfo['password'] == md5($pwd) ) {
                    session_start();
                    $_SESSION['userid'] = $userinfo['id'];
                    $_SESSION['username'] = $userinfo['username'];
                    $_SESSION['userinfo'] = $userinfo;
                    header("Location: /");
                }
            }
        }
        $this->render('login.html', array(
            'tree' => $this->tree,
        ));
    }

    public function logoutAction() {
        session_start();
        $_SESSION['userinfo'] = '';
        $_SESSION['userid'] = '';
        $_SESSION['username'] = '';
        unset($_SESSION);
        header("Location: /");
    }

}

