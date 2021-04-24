<?php

class App {
  public static $endpoint = "https://webacademy.se/fakestore/";

  /*** The Main method ***/
  public static function main(){
    try {
      $array =  self::getData();
      self::viewCategory($array);
      self::viewData($array);
    } catch (Exception $error) {
      echo $error->getMessage();
    }
  }
  /*** Gets data from endpoint ***/
  public static function getData(){
    $json = @file_get_contents(self::$endpoint);
    if(!$json) {
      throw new Exception("Could not access " . self::$endpoint);
    }
    return json_decode($json, true);
  }
  /*** List categories ***/
  public static function viewCategory(){
    $categories = array("women clothing", "men clothing", "jewelery");

    echo "<div class='col-3'>
    <h4>Products categories:</h4><ol>";

    foreach ($categories as $category) {
      echo "<p><a href=`?category='$category'`>$category</a></p>";
    }
    echo "</ol>";
    echo "</div>";
  }

  /*** List all products from category ***/
  public static function viewData($array){

    $table = "<table class='table'>
    <tr>
      <th>Title</th>
      <th>Picture</th>
      <th>Description</th>
    </tr>";
    //$categoryDone = $_GET['category'] ?? "Choose a category";
    $categoryDone = "women clothing";
    foreach ($array as $product) {
      if ($product['category'] === $categoryDone) {
        $url = $product['image'];
        $img = "<img src='$url' class='img-fluid m-2' style='width: 70%;'>";
        $table .= "<tr>
          <td> $product[title] </td>
          <td> $img </td>
          <td> $product[description] </td>
        </tr>";
      }
    }
    $table .= "</table>";
    echo "<div class='col-4'>
            <h4>Products list:</h4>
            $table
          </div>";

  }
}