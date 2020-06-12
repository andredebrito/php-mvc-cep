<?php

namespace Source\Models;

use AndreDeBrito\PHPViaCep\PhpViaCep;

/**
 * Class CepModel [MODEL]
 *
 * @author André de Brito <andrebrito1990@gmail.com>
 * @package Source\Models
 */
class AddressModel extends PhpViaCep {

    /**
     * CepModel constructor
     */
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Return result quantity
     * 
     * @return int
     */
    public function count(): int {
        $count  = 0;
        if(is_array($this->getResponse()) || is_object($this->getResponse())){
            foreach ($this->getResponse() as $result){
                $count++;
            }
        }
        
        return $count;
    }

}
