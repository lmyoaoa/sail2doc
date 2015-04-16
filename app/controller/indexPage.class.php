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

    public function infoAction() {
        $id = $_GET['id'];

        $info = DocumentsInterface::getInfo($id);
        //print_r($info);
        $this->render('info.html', array(
            'info'=> $info,
        ));
    }

}
