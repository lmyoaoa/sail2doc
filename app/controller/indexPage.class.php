<?php
/**
 * 
 */

class IndexPage extends Controller {

    //直接输出
    public function indexAction() {
        $list = DocumentsInterface::getListAll();
        $this->render('index.html', array(
            'list' => $list,
        ));
    }

    //添加文档
    public function addAction() {
        if( $_POST ) {
            $data = $_POST;
            $id = DocumentsInterface::add($data);
            if( $id ) {
                header("Location: /index/add");
            }
        }
        $this->render('add.html', array(
            'test'=>'testPage',
            'desc'=>'页面变量都在这个$this里面',
        ));
    }
    
    public function editAction() {
        $id = $_GET['id'];

        $info = DocumentsInterface::getInfo($id, false);
        if( $_POST ) {
            $data = $_POST;
            $ret = DocumentsInterface::edit($id, $data);
            if( $ret ) {
                header("Location: /index/info?id={$id}");
            }
        }
        $this->render('edit.html', array(
            'info' => $info,
            'test'=>'testPage',
        ));
    }

    //详情
    public function infoAction() {
        $id = $_GET['id'];

        $info = DocumentsInterface::getInfo($id);
        //print_r($info);
        $this->render('info.html', array(
            'info'=> $info,
        ));
    }

    public function testAction() {
        $id = $_GET['id'];
        $con = Http::get('http://mbs.273.cn/User/Oauth/test/token/1');
        $con = json_decode($con, true);

        $info = DocumentsInterface::getInfo($id);
        $this->render('test.html', array(
            'info'=> $info,
            'con'=> $con,
        ));
    }

    public function testDoAction() {
        $post = $_POST;
        $type = $post['type'];
        $token = $post['token'];
        $params = $post['param'];
        $vals = $post['val'];
        $id = $post['id'];
        if( $id ) {
            $postData = array(
                //'access_token' => $token,
            );
            foreach( $params as $k => $v ) {
                $postData[$v] = $vals[$k];
            }

            $info = DocumentsInterface::getInfo($id);
            //echo trim($info['url'], '/') . '/access_token/' . $token;
            $con = Http::post(trim($info['url'], '/') . '/access_token/' . $token, $postData);

            echo $con;
        }
    }

}
