<?php

namespace Source\Controllers;

use Source\Controllers\Controller;

/**
 * Class ErrorController [CONTROLLER]
 *
 * @author André de Brito <andrebrito1990@gmail.com>
 * @package Source\Controllers\App
 */
class ErrorController extends Controller {

    public function __construct() {
        parent::__construct(__DIR__ . "/../../views/" . CONF_VIEW_THEME . "/");
    }

    /**
     * 
     * @param array $data
     * @return void
     */
    public function error(array $data): void {
        $head = $this->seo->render(
                "Erro {$data['errcode']} | " . CONF_SITE_NAME,
                CONF_SITE_DESC,
                url("/ops/{$data['errcode']}"),
                theme("/assets/images/share.jpg"),
                true
        );

        echo $this->view->render("error", [
            "head" => $head,
            "error" => (object) [
                "number" => $data["errcode"],
                "message" => "O conteúdo solicitado não esta disponível ou foi removido!"
            ]
        ]);
    }

}
