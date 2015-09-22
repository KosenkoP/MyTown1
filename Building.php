<?php
    class Building {
        public $houseNumber;
        public $floorCount;
        public $porchCount;
        public $apartmentCount;
        public $nearestArea;
        public $houseLights;
        
        public $landPrice = 14;
        
        public function __construct(){
            $buildingOptions = AssBuilder::getBuildingOptions();
            $this->houseNumber = $buildingOptions['houseNumberRand'];
            if($buildingOptions['floorCountRand'] == 0){
                $this->floorCount = 9;
            } elseif($buildingOptions['floorCountRand'] == 1){
                $this->floorCount = 12;
            } else {
                $this->floorCount = 16;
            }
            $this->porchCount = $buildingOptions['porchCountRand'];
            $this->nearestArea = $this->floorCount * $this->porchCount * 4 * 20;
            $this->houseLights =  $this->floorCount * $this->porchCount * 10.5;
            $apartmentCount = $this->floorCount * $this->porchCount * 4;
            $this->apartmentCount($apartmentCount);
        }
        public function apartmentCount($number){
            $arr = array();
            for($i = 0; $i < $number; $i++){
                $apartmentOptions = AssBuilder::getApartmentOptions();
                $apartmentOptions['floorCount'] = $this->floorCount; 
               $arr[$i] = new Apartment($apartmentOptions);
            }
            $this->apartmentCount = $arr;
        }
        public function landTax(){
            $land = ($this->porchCount * 40 + $this->nearestArea) * $this->landPrice;
            return $land;
        }
        public function houseTax(){
            $houseTaxes = 0;
            foreach($this->apartmentCount as $value){
                $houseTaxes += $value->allTaxes();
            }
            return $houseTaxes;
        }
        
    }
    
?>

