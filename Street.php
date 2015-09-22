<?php
    class Street{
        public $streetName;
        public $streetLength;
        public $streetCoords;
        public $houseCount;
        
        public $yardManSquare = 4500;
        
        public function __construct(){
            $streetOptions = AssBuilder::getStreetOptions();
            $streetNameArr = array(
                'Пушкинская', 'Советская', 'Малышева', 'Академика Павлова', 'Ленина'
            );
            $this->streetName = $streetNameArr[$streetOptions['streetNameRand']];
            $this->streetLength = $streetOptions['streetLengthRand'];
            $this->streetCoords = $streetOptions['streetCoordsRand'];
            for($i = 0; $i < $streetOptions['houseCountRand']; $i++){
               $arr[$i] = new Building();
            }
            $this->houseCount = $arr;
        }
        public function yardManCount(){
            $yardMan = 0;
            foreach ($this->houseCount as $value) {
                $yardMan += $value->nearestArea;
            }
            $yardMan = ceil($yardMan / $this->yardManSquare);
            return $yardMan;
        }
        public function streetTax(){
            $streetTaxes = 0;
            foreach($this->houseCount as $value){
                $streetTaxes += $value->houseTax();
            }
            return $streetTaxes;
        }
        public function streetLandTax(){
            $streetLandTaxes = 0;
            foreach($this->houseCount as $value){
                $streetLandTaxes += $value->landTax();
            }
            return $streetLandTaxes;
        }
    }
?>