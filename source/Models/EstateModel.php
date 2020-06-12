<?php

namespace Source\Models;

/**
 * Class EstateModel [MODEL]
 *
 * @author André de Brito <andrebrito1990@gmail.com>
 * @package Source\Models
 */
class EstateModel {

    /** @var array() */
    private $estates;

    /**
     * EstateMode constructor
     */
    public function __construct() {
        $path = __DIR__ . "/../../files/estates.json";
        $this->estates = json_decode(file_get_contents(utf8_encode($path)));
    }

    
    /**
     * 
     * @return array
     */
    public function getEstates() : array{
        return $this->estates;
    }

}
