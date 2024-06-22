<?php
final class HomeController extends Controller {

    private $store_db_model;
    private $smarty;

    public function __construct() {
        global $smarty;
        $this->smarty = $smarty;
        $this->store_db_model = $this->loadModel('Store');
    }

    public function index(){
        
        $this->smarty->assign('page_title', 'Home | ipOnline');
        $this->smarty->assign('root_link', ROOT);
        $this->smarty->assign('assets_link', ASSETS);
        $this->smarty->display('index.tpl');
    }

    public function about(){
        $this->smarty->display('about.tpl');
    }

}
