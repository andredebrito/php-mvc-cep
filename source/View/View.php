<?php

namespace Source\View;

use League\Plates\Engine;

/**
 * Class View
 *
 * @author André de Brito <https://github.com/andredebrito>
 * @package Source\View
 */
class View {

    /** @var Engine (PLATES) */
    private $engine;

    /**
     * View constructor.
     * @param string $path
     * @param string $ext
     */
    public function __construct(string $path, string $ext = CONF_VIEW_EXT) {
        $this->engine = Engine::create($path, $ext);
    }

    /**
     * @param string $name
     * @param string $path
     * @return View
     */
    public function path(string $name, string $path): View {
        $this->engine->addFolder($name, $path);
        return $this;
    }

    /**
     * @param string $templateName
     * @param array $data
     * @return string
     */
    public function render(string $templateName, array $data): string {
        return $this->engine->render($templateName, $data);
    }

    /**
     * @return Engine
     */
    public function engine(): Engine {
        return $this->engine();
    }

}
