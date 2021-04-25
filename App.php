<?php
class App {
  public static $endpoint = "https://webacademy.se/fakestore/";
  /**
   * The Main method
   */
  public static function main(){
    try {
      $array =  self::getData();
      self::viewCategory($array);
      self::viewData($array);
    } catch (Exception $error) {
      echo $error->getMessage();
    }
  }
  /**
   * Gets data from endpoint
   */
  public static function getData(){
    $json = @file_get_contents(self::$endpoint);
    if(!$json) {
      throw new Exception("Could not access " . self::$endpoint);
    }
    return json_decode($json, true);
  }
  /**
   * List the categories
   */
  public static function viewCategory(){
    $categories = array('women clothing', 'men clothing', 'jewelery');

    echo "<div class='col-3'>
    <h4>Products categories:</h4><ul>";
    foreach ($categories as $category) {
      echo "<li><a href='?category=$category' class='nounderline'>" . ucfirst($category) . "</a></li>";
    }
    echo "</ul>";
    echo "</div>";
  }
  /**
   * List all products from category
   */
  public static function viewData($array){
    $categoryDone = $_GET['category'] ?? null;

    if(isset($categoryDone)) {
      $table = "<table class='table'>
        <tr>
          <th>Title</th>
          <th>Picture</th>
          <th>Description</th>
          <th>Price</th>
        </tr>";
        foreach ($array as $product) {
          if ($product['category'] === $categoryDone) {
            $url = $product['image'];
            $altText = "img of $product[title]";
            $img = "<img src='$url' alt='$altText' class='img-fluid m-2' style='width: 100%;'>";
            $table .= "<tr>
              <td class='fw-bold'> $product[title] </td>
              <td> $img </td>
              <td> $product[description] </td>
              <td> <span class='fw-bold'>$product[price]</span> SEK</td>
            </tr>";
          }
        }
      $table .= "</table>";
      echo "<div class='col-6'>
              <h4>Products list:</h4>
              $table
            </div>";
    } else {
      echo "<div class='col-4'>
              <h4>Welcome to our store!</h4>
              <h6> ← Choose a category from the list</h6>
            </div>";
    }
  }
}