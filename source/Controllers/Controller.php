<?php

namespace Source\Controllers;

use Source\Support\Seo;
use Source\View\View;

/**
 * Class Controller
 *
 * @author André de Brito <andrebrito1990@gmail.com>
 * @package Source\Controllers
 */
abstract class Controller {

    /** @var View * */
    protected $view;

    /** @var Seo * */
    protected $seo;

    /**
     * Controller constructor
     * @param string|null $pathToViews
     */
    public function __construct(string $pathToViews = null) {
        $this->view = new View($pathToViews);
        $this->seo = new Seo();
    }

}
