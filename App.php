<?php
class App {
  static $endpoint = "https://webacademy.se/fakestore/";
  static $categories = array('women clothing', 'men clothing', 'jewelery');

  /**
   * The Main method
   */
  public static function main() {
    try {
      $array = self::getData();
      self::viewCategories();
      self::viewProducts($array);
    } catch (Exception $error) {
      echo $error->getMessage();
    }
  }

  /**
   * Gets data from endpoint
   */
  public static function getData() {
    $json = @file_get_contents(self::$endpoint);
    if(!$json) {
      throw new Exception("<p class='alert alert-danger'> Could not access " . self::$endpoint."</p>");
    }
    return json_decode($json, true);
  }

  /**
   * List the categories
   */
  public static function viewCategories() {
    echo "<div class='col-2'>
      <h4 id='title_categories'>Products categories:</h4>";
    foreach (self::$categories as $category) {
      echo "<a class='list-group-item list-group-item-action list-group-item-dark' href='?category=$category' id='link'>" . ucfirst($category) . "</a>";
    }
    echo "</div>";
  }

  /**
   * List all products from category
   */
  public static function viewProducts($array) {
    $categoryDone = $_GET['category'] ?? null;
    /**
    * View before choosing category
    */
    if ($categoryDone === null) {
      echo "
        <div class='col-4'>
          <h4 id='text_welcome'>Welcome to our store!</h4>
          <h5 id='text_choosing'> ← Choose a category from the list</h5>
        </div>";
      return;
    }
    /**
    * Check is this category are from list
    */
    if (!in_array($categoryDone, self::$categories)) {
      echo "
        <div class='col-4'>
          <h4 class='alert alert-danger' id='text_welcome'>Sorry, we don't have this category!</h4>
          <h5 id='text_choosing'> ← Choose a category from the list</h5>
        </div>";
      return;
    }
    /**
    * Get products for checking category
    */
    $div = "<div class='row'>";
      foreach ($array as $product) {
        if ($product['category'] === $categoryDone) {
          $url = $product['image'];
          $altText = "Image for {$product['title']}";
          $div .= "
            <div class='col-sm-3'>
              <div class='card' id='cardB'>
                <img src='{$url}' class='card-img-top' alt='{$altText}'>
                <div class='card-body'>
                  <h5 class='card-title' class='fw-bold'> {$product['title']} </h5>
                  <p class='card-text'> {$product['description']} </p>
                </div>
                <div class='card-footer'>
                  <span class='fw-bold'> {$product['price']} </span> SEK
                </div>
              </div>
            </div>";
        }
      }
    echo "
      <div class='col-9'>
        <h4>" . strtoupper($categoryDone) . "</h4>
        <h5>Products list:</h5>
        {$div}
      </div>";
  }
}