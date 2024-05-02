<?php  

namespace Controllers;

use Models\Model;

class StatisticsController extends Model
{
    public function showStatistics()
    {
        require "Views/statistiques.view.php";
    }

    public static function loadAllElements(): array
    {
        return [
            "label" => "products", "y" => intval(self::getPDO()->query('SELECT COUNT(id) FROM products')->fetch()),
            "label" => "dishes", "y" => intval(self::getPDO()->query('SELECT COUNT(id) FROM dishes')->fetch()),
            "label" => "refreshments", "y" => intval(self::getPDO()->query('SELECT COUNT(id) FROM refreshments')->fetch()) 
        ];
    }
}