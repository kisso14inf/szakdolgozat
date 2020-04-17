<div class="egybe">

<?php
echo '<script type="text/javascript">
setTimeout(myFunction, 500);
function myFunction() {
  alert("Sikeresen válaszoltál a kérdésre. Köszönjük!");
  window.location = "/kerdes/";
}
</script>';
/*class Mindenki {
  public $name;
  public $color;

  function __construct($name, $color) {
    $this->name = $name;
    $this->color = $color;
  }
  function get_name() {
    return $this->name = array();
    
  }
  function get_color() {
    return $this->color = arra();
  }
}
  public function Osszerak(){
    
  }
$apple = new Mindenki("Alma", "red");

echo $apple->get_name();
echo "<br>";
echo $apple->get_color();*/

//https://stackoverflow.com/questions/3983687/object-oriented-php-arrays
//https://softwareengineering.stackexchange.com/questions/296752/php-when-to-use-arrays-and-when-to-use-objects-for-mostly-data-storing-code-co
/*
 class Order {
    private $my_total;
    private $my_lineitems;

    public function getItems() { return $this->my_lineitems; }
    public function addItem(Product $p) { $this->my_lineitems[] = $p; }
    public function getTotal() { return $this->my_total; }

    public function forJSON() {
        $items_json = array();
        foreach($this->my_lineitems as $item) $items_json[] = $item->forJSON();
        return array(
            'total' => $this->getTotal(),
            'items' => $items_json
        );
    }
}
$o = new Order();
// do some stuff with it
$json = json_encode($o->forJSON());
 class House {
	public $name;
	public $color;
	public function setData($name, $color) {
		$this -> name = $name;
		$this -> color = $color;
	}
	public function echoData() {
		echo "The color of the {$this -> name} is {$this -> color}";
	}
}
$blackHouse = new House();
$whiteHouse = new House();
$blackHouse -> setData("John's House", "black");
$whiteHouse -> setData("Pearl's House", "white");
$blackHouse -> echoData();
echo '<br>';
$whiteHouse -> echoData();*/
?>