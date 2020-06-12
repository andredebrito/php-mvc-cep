<?php

namespace Source\Support;

use CoffeeCode\Optimizer\Optimizer;

/**
 * Class Seo
 *
 * @author André de Brito <andredebrito1990@gmail.com>
 * @package Source\Support
 */
class Seo {

    /** @var Optimizer */
    protected $optimizer;

    /**
     * Seo constructor.
     * @param string $schema
     */
    public function __construct(string $schema = "article") {
        $this->optimizer = new Optimizer();
        $this->optimizer->openGraph(
                CONF_SITE_NAME,
                CONF_SITE_LANG,
                $schema
        );
    }

    /**
     * @param $name
     * @return mixed
     */
    public function __get($name) {
        return $this->optimizer->data()->$name;
    }

    /** Render the Seo
     * @param string $title
     * @param string $description
     * @param string $url
     * @param string $image
     * @param bool $follow
     * @return string
     */
    public function render(string $title, string $description, string $url, string $image, bool $follow = true): string {
        return $this->optimizer->optimize($title, $description, $url, $image, $follow)->render();
    }

    /** Return the optimizer object
     * @return Optimizer
     */
    public function optimizer(): Optimizer {
        return $this->optimizer;
    }

    /** Sets the data into the optimizer object
     * @param string|null $title
     * @param string|null $desc
     * @param string|null $url
     * @param string|null $image
     * @return null|object
     */
    public function data(?string $title = null, ?string $desc = null, ?string $url = null, ?string $image = null) {
        return $this->optimizer->data($title, $desc, $url, $image);
    }

}
