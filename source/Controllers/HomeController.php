<?php

namespace Source\Controllers;

use Source\Controllers\Controller;
use Source\Models\EstateModel;
use Source\Models\AddressModel;

/**
 * Class HomeController [CONTROLLER]
 *
 * @author André de Brito <andrebrito1990@gmail.com>
 * @package Source\Controllers
 */
class HomeController extends Controller {

    private $data;
    private $cep;
    private $address;
    private $estate;
    private $city;
    private $message;

    /**
     * HomeController constructor
     */
    public function __construct() {
        parent::__construct(__DIR__ . "/../../views/" . CONF_VIEW_THEME . "/");
    }

    /**
     * Render the index page
     * 
     * @param array $data
     * @return void
     */
    public function index(?array $data): void {

        //load the estates list
        $estates = (new EstateModel())->getEstates();

        $head = $this->seo->render(
                CONF_SITE_NAME . " - Principal",
                CONF_SITE_DESC,
                url(),
                theme("/assets/images/share.jpg"),
                false
        );


        //render the view
        echo $this->view->render("home", [
            "head" => $head,
            "estates" => $estates
        ]);
    }

    /**
     * Checks and executes the request
     * 
     * @param type $data
     * @return void
     */
    public function request($data): void {
        if (!empty($data) && $data["action"]) {
            $this->data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);

            if ($data["action"] == "bycep") {

                if (!($result = $this->findByCep()) && $this->message) {
                    $json["error"] = true;
                    $json["message"] = $this->message;
                    echo json_encode($json);
                    return;
                }
                
                $json["success"] = true;
                $json["result"] = $result;
                $json["multiple"] = false;
                echo json_encode($json);
                return;
            }

            if ($data["action"] == "byaddress") {

                if (!($result = $this->findByAddress()) && $this->message) {
                    $json["error"] = true;
                    $json["message"] = $this->message;
                    echo json_encode($json);
                    return;
                }

                $multiple = ($result && count((array) $result) > 1 ? true : false);

                if (!$multiple) {
                    foreach ($result as $r) {
                        $result = $r;
                    }
                }

                $json["success"] = true;
                $json["result"] = $result;
                $json["multiple"] = $multiple;
                $json["result_quantity"] = $this->data["result_quantity"];
                echo json_encode($json);
                return;
            }

            $json["error"] = true;
            $json["message"] = "Não foi possível processar sua solicitação. Favor utilizar o formulário!";
            echo json_encode($json);
            return;
        }
    }

    /**
     * 
     * @return false|mixed
     */
    public function findByCep() {
        if (empty($this->data["cep"])) {
            $this->message = "Para realizar esta consulta você deve informar o Cep!";
            return false;
        }

        if (request_limit("findByCep", 15, 60 * 3)) {
            $this->message = "Você atingiu o limite máximo de requisições! Aguarde 3 minutos e, tente novamente.";
            return false;
        }

        $this->cep = str_replace("-", "", $this->data["cep"]);

        $findAddress = (new AddressModel())
                ->findByCep($this->cep)
                ->json()
                ->fetch()
                ->jsonToObject();

        if (!$findAddress->getResponse() || $findAddress->getError()) {
            $this->message = $findAddress->getError();
            return false;
        }        

        return $findAddress->getResponse();
    }

    /**
     * 
     * @return false|mixed
     */
    public function findByAddress() {
        if (empty($this->data["address"]) || empty($this->data["city"]) || empty($this->data["estate"])) {
            $this->message = "Para realizar esta consulta você deve informar o logradouro, a cidade e o estado!";
            return false;
        }

        if (request_limit("findByAddress", 15, 60 * 3)) {
            $this->message = "Você atingiu o limite máximo de requisições! Aguarde 3 minutos e, tente novamente.";
            return false;
        }

        $this->address = $this->data["address"];
        $this->city = $this->data["city"];
        $this->estate = $this->data["estate"];

        $findAddress = (new AddressModel())
                ->findByAddress($this->estate, $this->city, $this->address)
                ->json()
                ->fetch()
                ->jsonToObject();

        if (!$findAddress->getResponse() || $findAddress->getError()) {
            $this->message = $findAddress->getError();
            return false;
        }

        $this->data["result_quantity"] = $findAddress->count();
        return $findAddress->getResponse();
    }

}
