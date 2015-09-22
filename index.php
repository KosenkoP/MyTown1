<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        spl_autoload_register(function ($class) {
            include_once $class . '.php';
        });

        
         class AssBuilder {
            static public function getTownOptions() {
                return array(
                    'townNameRand' => rand(0, 3), //определяет выбор названия города, год основания, и координаты
                    'streetCountRand' => rand(5, 25)
                );
            }
			static public function getApartmentOptions() {
                return array(
                    'roomRand' => rand(1, 3),
                    'squareRand' => rand(25, 35),
                    'tenantRand' => rand(1, 5),
                    'gasRand' => rand(0, 1), //централ, автоном
                    'kvtRand' => rand(0, 999)
                );
            }
			static public function getStreetOptions() {
                return array(
                    'streetNameRand' => rand(0, 4), //выбор улицы
                    'streetLengthRand' => rand(200, 4999),
                    'streetCoordsRand' => (rand(48, 50) . "&deg" . rand(00, 59) . "&acute" . " с. ш. " . rand(30, 37) . "&deg" . rand(00, 59) . "&acute" . " в.д."),
                    'houseCountRand' => rand(9, 19)
                );
            }
			public static function getBuildingOptions() {
                return array(
                    'houseNumberRand' => rand(1, 9),
                    'floorCountRand' => rand(0, 2), //9, 12, 16 этажей
                    'porchCountRand' => rand(2, 4)
                );
            }
        }
         
        $town = new Town();
        echo "<h4>" . 'Информация о населенном пункте :' . "</h4>";
        echo 'Название населенного пункта: ' . $town->townName . "<br>";
        echo 'Год основания: ' . $town->foundYear." г.<br>" ;
        echo 'Географические координаты: ' . $town->townCoords. "<br>";
        echo 'Количество улиц: ' . count($town->streetCount) . "<br>" ;
        echo "Бюджет населенного пункта полученный от налога на землю: " . $town->townLandTax() . " грн.<br>";
        echo "Размер коммунальных платежей составляет " . $town->townTax() . " грн.<br>";
        echo "Население " . $town->peopleCount() . " человек(а)<br><br>";
        
        
        $street = $town->streetCount[0];
        echo "<h4>" . 'Информация об улице:' . "</h4>";
        echo "Название улицы: " . $street->streetName . "<br>";
        echo "Протяженность: " . $street->streetLength . " м<br>";
        echo "Координаты улицы: " . $street->streetCoords . "<br>";
        echo "Кол-во домов на улице: " . count($street->houseCount) . "<br>";
        echo "Кол-во дворников, обслуживающих улицу: " . $street->yardManCount() . " чел.<br>";
        echo "Объем коммунальных платежей, полученный со всех домов: " . $street->streetTax() . " грн.<br>";
        echo "Налог на землю: " . $street->streetLandTax() . " грн.<br><br>";
        
        $house = $street->houseCount[0];
        echo "<h4>" . 'Дом №' . $house->houseNumber . "</h4>";
        echo "Кол-во этажей: " . $house->floorCount . "<br>Кол-во подъездов: " . $house->porchCount .
        "<br>Кол-во квартир: " . count($house->apartmentCount) . 
        "<br>Размер прилегающей территории: " . $house->nearestArea . " м<sup>2</sup><br>";
        echo "Размер коммунальных платежей со всех квартир в этом доме составляет " . $house->houseTax() . " грн.<br>";
        echo "Объем потребляемого электричества для освещения подъездов составляет " . $house->houseLights . " кВт/мес.<br>";
        echo "Налог на землю, отведенную для дома составляет: " . $house->landTax() . " грн.<br><br>";
        
        $flat1 = $house->apartmentCount[0];
        echo "<h4>" . 'Информация о квартире:' . "</h4>";
        echo 'Количество комнат в квартире: ' . $flat1->room . " комнат(ы)<br>";
        echo 'Площадь: ' . $flat1->square . " м<sup>2</sup><br>";
        echo 'Этаж: ' . $flat1->floor . "<br>";
        echo 'Kоличество жильцов: ' . $flat1->getTenant() . " человек(а)<br>";
        echo 'Количество балконов: ' . $flat1->balcony . "<br>";
        echo 'У вас ' . $flat1->heating . ' отопление';

        echo "<h4>" . 'Коммунальные платежи' . "</h4>";
        echo "Оплата за жил площадь составляет " . $flat1->squarePay() . " грн.<br>";
        echo "Оплата за электроэнергию составляет " . $flat1->electricity() . " грн<br>";
        echo "Оплата за водоснабжение и водоотвод составляет " . $flat1->waterPay() . " грн.<br>";
        echo "Оплата за отопление и горячее водоснабжение составляет " . $flat1->hotWaterPay() . " грн.<br>";
        echo "Оплата за вывоз ТБО составляет " . $flat1->tbo() . " грн.<br>";
        echo "Оплата за газ составляет " . $flat1->gas() . " грн.<br>";
        echo "Общая сумма к оплате: " . $flat1->allTaxes() . " грн.<br><br>";
        ?>
    </body>
</html>
