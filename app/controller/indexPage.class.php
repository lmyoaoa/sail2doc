<?php
/**
 * 
 */

class IndexPage extends Controller {

    //直接输出
    public function indexAction() {
        $this->render('index.html', array(
            'kk'=>22,
        ));
    }

    //加载模板
    public function listAction() {
        print_r($_GET);
        $m = new IndexInterface();
        exit;
        $this->render( 'list.html', array(
            'kk'=>22,
            'vv'=>'33',
            'test'=>'testPage',
            'desc'=>'页面变量都在这个$this里面',
        ));
    }

    public function addAction() {
        if( $_POST ) {
            $data = $_POST;
            $id = DocumentsInterface::add($data);
            if( $id ) {
                header("Location: ./add/");
            }
        }
        $this->render('add.html', array(
            'test'=>'testPage',
            'desc'=>'页面变量都在这个$this里面',
        ));
    }

    public function infoAction() {
        $id = $_GET['id'];

        $info = DocumentsInterface::getInfo($id);
        //print_r($info);
        $this->render('info.html', array(
            'info'=> $info,
        ));
    }

}
