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

    echo "<div class='col-2'>
    <h4>Products categories:</h4>";
    foreach ($categories as $category) {
      echo "<a class='list-group-item list-group-item-action' href='?category=$category' class='link'>" . ucfirst($category) . "</a>";
    }
    echo "</div>";
  }
  /**
   * List all products from category
   */
  public static function viewData($array){
    $categoryDone = $_GET['category'] ?? null;

    if(isset($categoryDone)) {
      $div = "<div class='row'>";
        foreach ($array as $product) {
          if ($product['category'] === $categoryDone) {
            $url = $product['image'];
            $altText = "img of $product[title]";
            $div .="
              <div class='col-sm-3'>
                <div class='card' >
                  <img src='$url' class='card-img-top' alt='$altText'>
                  <div class='card-body'>
                    <h5 class='card-title' class='fw-bold'> $product[title] </h5>
                    <p class='card-text' id='descript'> $product[description] </p>
                  </div>
                  <div class='card-footer'> <span class='fw-bold'>$product[price]</span> SEK</div>
                </div>
              </div>";
          }
        }
      echo "<div class='col-9'>
              <h4>" . strtoupper($categoryDone) . "</h4>
              <h5>Products list:</h5>
              $div
            </div>";
    } else {
      echo "<div class='col-4'>
              <h4>Welcome to our store!</h4>
              <h6> ← Choose a category from the list</h6>
            </div>";
    }
  }
}