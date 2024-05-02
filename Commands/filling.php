<?php

require dirname(__DIR__). '/vendor/autoload.php';

use Models\Model;
use Helpers\Unsplash;

$pdo = Model::getPDO();

$faker = Faker\Factory::create('fr_FR');

/* $pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE dishes');
$pdo->exec('TRUNCATE TABLE products');
$pdo->exec('TRUNCATE TABLE refreshments');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1'); */

$dishesWords = [
        'Salade', 'crêpes', 'Fries', 'Riz', 'Spaghetti-Bolognese', 
        'Hamburger', 'Pizza', 'Pizza-Margherita', 'Sushi', 'Paella', 
        'Pad-Thaï', 'Couscous', 'Tacos', 'Boeuf-Bourgignon', 'Curry', 
        'Fishs-and-Chips', 'Poutine', 'Churrasco', 'Kimchi', 'Biryani',
        'Kimbap', 'Ceviche', 'Miso-Ramen', 'Moules-Frites', 'Feijoada'
    ];
$productsWords = [
        'Rolls-Royce', 'Laptop', 'Desktop', 'Ferrari', 'Apple-Mac-Book-Pro',
        'Iphone-13-Pro', 'Samsung-Galaxy-S21-Ultra', 'Sony-Xperia 1 III',
        'Sony-Bravia-OLED-TV', 'Dell-XPS', 'HP-Spectre', 'Lenovo-ThinkPad',
        'Microsoft-Surface', 'Apple-Imac', 'Dell-XPS-Tower', 'HP-ENVY-Desktop',
        'Lenovo-ThinkCentre', 'Microsoft-Surface-Studio', 
    ];
$refreshmentsWords = [
         'champagne', 'Limonade', 'Mojito', 'Veuve-Clicquot',
        'Sangria', 'Lassie','Caïpirihna', 'Horchata', 'Bubble-Tea',
        'Piña-Colada', 'Agua-Fresca', 'Bissap', 'Michelada', 'Shrubs',
        'Chai-Latte', 'Tinto-de-Verano', 'Seltzer', 'Carbenet-Sauvignon',
        'Merlot', 'Chardonnay', 'Sauvignon-Blanc', 'Pinot-Noir','Bourbon',
        'Japanese-Whiskey', 'Vodka', 'Tequila', 'Rum', 'Gin', 'Scotch-Whisky',
        'Dom-Perignon', 'Krug', 'Bollinger', 'Laurient-Perrier', 'Ruinart'
    ];

$usernames = ['Euvince', 'Hugo', 'Roddy', 'Daril', 'Juste', 'Soglo',
             'Marcel', 'Jonel', 'Jean-Daniel', 'Robert', 'Jean-Savid',
             'Marcos', 'Mathias', 'Rubby', 'Josias', 'Firmin', 'Luc'
    ];

for($i = 0; $i < 40; $i++)
{
    $unsplash = Unsplash::getUrlPictures($faker->randomElement($dishesWords));
    $pdo->exec("INSERT INTO dishes SET title='{$faker->randomElement($dishesWords)}', created_at='{$faker->date} {$faker->time}', content='{$faker->paragraphs(rand(3, 12), true)}', picture='$unsplash', price='{$faker->numberBetween(100, 9999)}'");
}
for($i = 0; $i < 40; $i++)
{
    $unsplash = Unsplash::getUrlPictures($faker->randomElement($productsWords));
    $pdo->exec("INSERT INTO products SET title='{$faker->randomElement($productsWords)}', created_at='{$faker->date} {$faker->time}', content='{$faker->paragraphs(rand(3, 15), true)}', picture='$unsplash', price='{$faker->numberBetween(100, 9999)}'");
}
for($i = 0; $i < 40; $i++)
{
    $unsplash = Unsplash::getUrlPictures($faker->randomElement($refreshmentsWords));
    $pdo->exec("INSERT INTO refreshments SET title='{$faker->randomElement($refreshmentsWords)}', created_at='{$faker->date} {$faker->time}', content='{$faker->paragraphs(rand(3, 15), true)}', picture='$unsplash', price='{$faker->numberBetween(100, 9999)}'");
}

for($i = 0; $i < 40; $i++)
{
    $bytes = random_bytes(10);
    $password = bin2hex($bytes);
    $unsplash = Unsplash::getUrlPictures('person');
    $pdo->exec("INSERT INTO users SET user_name='{$faker->randomElement($usernames)}', mail='{$faker->email()}', password='{$password}', picture='$unsplash'");
}