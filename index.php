<?php
require "config.php";
require "database.php";
$connection = new Database();
function processXML($db)
{
    if (file_exists(XML_FILE)) {
        $xml = simplexml_load_file(XML_FILE);
        foreach ($xml as $row) { // iterate over the all the elements of the given file.
            $data = [
                "entity_id" => $row->entity_id,
                "category_name" => $row->CategoryName,
                "sku" => $row->sku,
                "name" => $row->name,
                "description" => $row->description,
                "short_description" => $row->shortdesc,
                "price" => $row->price,
                "link" => $row->link,
                "image" => $row->image,
                "brand" => $row->Brand,
                "caffeine_type" => $row->CaffeineType,
                "count" => $row->Count,
                "flavored" => $row->Flavored,
                "seasonal" => $row->Seasonal,
                "in_stock" => $row->Instock,
                "facebook" => $row->Facebook,
                "is_k_cup" => $row->IsKCup,
            ]; // array to store the data of specific row from the feeds file.
            $db->insert($data, "feeds"); // function call to insert current row into the database table.
        }
    } else {
        file_put_contents(ERROR_FILE, "Respective File Not Found" . "\n", FILE_APPEND);
    }
}
processXML($connection); // function call to process the xml file.