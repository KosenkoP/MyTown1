<?php
 class Apartment {
            public $room;
            public $square;
            public $floor;
            public $tenant;
            public $balcony;
            public $heating;
            public $kvt;
            
            public $squarePrice1floor = 2.07;
            public $squarePrice2floor = 2.5;
            public $waterPriceCenter = 52.2;
            public $waterPriceAuto = 63;
            public $hotWaterPrice = 53.84;
            public $heatingPrice = 3.48;
            public $tboPrice = 10.91;
            public $kvtPrice150 = 30.84;
            public $kvtPriceOver150 = 41.94;
            public $kvtPriceOver800 = 134.04;
            public $gasPriceCenter = 12.73;
            public $gasPriceAuto = 30.66;
            
            public function __construct($apartmentOptions){ 
                $this->room = $apartmentOptions['roomRand'];
                $this->square = $apartmentOptions['roomRand'] * $apartmentOptions['squareRand'] + 15;
                $this->floor = rand (1, $apartmentOptions['floorCount']);
                $this->tenant = $apartmentOptions['tenantRand'];
                if ($this->room > 2){
                    $this->balcony = 2;
                } else {
                    $this->balcony = 1;
                }
                if($apartmentOptions['gasRand'] == 0){
                    $this->heating = 'централизованное';
                } else {
                     $this->heating = 'автономное';
                }
                $this->kvt = $apartmentOptions['kvtRand'];
            }
            public function setTenant($tent){
                $this->tenant = $tent;
            }
            public function getTenant(){
                return $this->tenant;
            }
            public function increaseTenant(){
                $this->tenant ++; 
            }
            public function decreaseTenant(){
                $this->tenant --; 
            }
            public function squarePay(){
                if($this->floor == 1){
                    $tax = $this->square * $this->squarePrice1floor;
                    return $tax;
                } else {
                    $tax = $this->square * $this->squarePrice2floor;
                    return $tax;
                }
            }
            public function waterPay(){
                if($this->heating == 'централизованное'){
                $tax = $this->tenant * $this->waterPriceCenter;
                return $tax;
                } else {
                    $tax = $this->tenant * $this->waterPriceAuto;
                return $tax;
                }
            }
            public function hotWaterPay(){
                if($this->heating == 'централизованное'){
                    $tax = $this->tenant * $this->hotWaterPrice + $this->tenant * $this->heatingPrice;
                    return $tax;
                } else {
                    $tax = 0;
                    return $tax;
                }
            }
            public function tbo(){
                $tax = $this->tenant * $this->tboPrice;
                return $tax;
            }
            public function electricity(){
                if($this->kvt <= 150){
                    $electr = round($this->kvt * $this->kvtPrice150 / 100, 2);
                } elseif($this->kvt > 150 && $this->kvt <= 800){
                    $electr = round($this->kvt * $this->kvtPriceOver150 / 100, 2);
                } else {
                    $electr = round($this->kvt * $this->kvtPriceOver800 / 100, 2);
                }
                return $electr;
              }
            public function gas(){
                if($this->heating == 'централизованное'){
                    $tax = $this->tenant * $this->gasPriceCenter;
                    return $tax;
                } else {
                    $tax = $this->tenant * $this->gasPriceAuto;
                    return $tax;
                }
            }
            public function allTaxes(){
                $all = $this->squarePay() + $this->waterPay() + $this->hotWaterPay() + $this->tbo() + 
                         $this->electricity() + $this->gas();
                return $all;
            }
            
        }
?>
