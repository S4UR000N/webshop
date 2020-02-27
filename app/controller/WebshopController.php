<?php

// namespace
namespace app\controller;

class WebshopController extends BaseController
{
    // View Data
    public $viewData = array();

    public function webshop()
    {
        // instantiate needed classes
        $session = new \app\super\Session();
        $webshopModel = new \app\model\WebshopModel();

        // set csrf token
        if(!$session->isSet("token"))
        {
            $session->set("token", bin2hex(random_bytes(32)));
        }

        // set balance and get products from DB
        if(!$session->isSet("balance"))
        {
            $session->set("balance", "100");
        }
        $products = $webshopModel->getAllProductsAsJSON();

        // store token, balance and products as $viewData
        $this->viewData["token"] = $session->get("token");
        $this->viewData["balance"] = $session->get("balance");
        $this->viewData["products"] = $products;

        // render view with $viewData attached
        $this->render_view("page:webshop", $this->viewData);
    }
}
