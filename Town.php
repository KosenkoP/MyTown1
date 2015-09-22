<?php
    class Town {

        public $townName;
        public $foundYear;
        public $townCoords;
        public $streetCount;

        public function __construct() {
            $townOptions = AssBuilder::getTownOptions();
            $townNameArr = array(
                'Киев', 'Харьков', 'Одесса', 'Николаев'
            );
            $this->townName = $townNameArr[$townOptions['townNameRand']];
            $townFoundYear = array(
                482, 1653, 1794, 1869
            );
            $this->foundYear = $townFoundYear[$townOptions['townNameRand']];
            $townCoord = array(
                '50°27′ с. ш. 30°31′ в. д.',
                '50°00′ с. ш. 36°13′ в. д.',
                '46°28′ с. ш. 30°44′ в. д.', 
                '48°00′ с. ш. 37°48′ в. д.' 
            );
            $this->townCoords = $townCoord[$townOptions['townNameRand']];
            for ($i = 0; $i < $townOptions['streetCountRand']; $i++) {
                $arr[$i] = new Street();
            }
            $this->streetCount = $arr;
        }
        public function townTax(){
            $townTaxes = 0;
            foreach($this->streetCount as $key => $value){
                $townTaxes += $value->streetTax();
            }
            return $townTaxes;
        }
        public function townLandTax(){
            $townLandTaxes = 0;
            foreach($this->streetCount as $key => $value){
                $townLandTaxes += $value->streetLandTax();
            }
            return $townLandTaxes;
        }
        public function peopleCount(){
            $peopleCount = 0;
            foreach($this->streetCount as $value){
                foreach($value->houseCount as $value2){
                    foreach ($value2->apartmentCount as $value3) {
                        $peopleCount += $value3->tenant."<br>";
                    }
                }
            }
            return $peopleCount;
        }
    }

?>
