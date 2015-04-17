<?php
/**
 * 
 */

class TestPage extends Controller {

    public function testAction() {
        $id = $_GET['id'];

        $info = DocumentsInterface::getInfo($id);
        //print_r($info);
        $this->render('test.html', array(
            'info'=> $info,
        ));
    }

}

