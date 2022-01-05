<?php


//I ЗАДАНИЕ
class item
{
    public $title;
    public $id;
    public $price;
    public $img;
    public $rendered;

    /**
     * @param $title
     * @param $id
     * @param $price
     * @param $img
     * @param $rendered
     */
    public function __construct($title=null, $id=null, $price=null, $img=null, $rendered=false)
    {
        $this->title = $title;
        $this->id = $id;
        $this->price = $price;
        $this->img = $img;
        $this->rendered = $rendered;
    }


    public function render() {
        $this->rendered = true;
        echo "<div>
                <h2>$this->title</h2>
                <p>$this->img</p>
                <p>\$$this->price</p>
              </div>";

    }
}
class CatalogItem extends  item {
}

class CartItem extends  item {
    public $color;
    public $size;
    public $quantity;

    /**
     * @param $color
     * @param $size
     * @param $quantity
     */
    public function __construct($title = null,
                                $id = null,
                                $price = null,
                                $img = null,
                                $color=null,
                                $size=null,
                                $quantity=0,
                                $rendered = false)
    {
        parent:: __construct($title, $id, $price, $img, $rendered);
        $this->color = $color;
        $this->size = $size;
        $this->quantity = $quantity;
    }

    public function render() {
        $this->rendered = true;
        echo "<div>
                <h3>$this->title</h3>
                <p>$this->img</p>
                <p>\$$this->price</p>
                <p>$this->color</p>
                <p>$this->size
                <p>$this->quantity</p>
             </div>";

    }
}

$product = new CatalogItem("Dress", "1", 54, "img");
$product->render();

$productInCart = new CartItem("Dress", "1", 54, "img", "red", "M", 1);
$productInCart->render();


// ЗАДАНИЕ II, III, IV
//Два класса, второй наследуется из первого. Второй класс имеет расширенный набор параметров и
//переопределяет поведение родительского метода (другой рендер).
//На базе этих классов создаются два объекта: cущность для отображения на странице каталога
// и сущность для отображения в корзине. У каждого объекта свой набор характеристик,
// актуальный для каталога или корзины. Так же и с методом - каждый из них должен рендерится по разному.


// V ЗАДАНИЕ
// Из документации:
// Статическая переменная существует только в локальной области видимости функции,
// но не теряет своего значения, когда выполнение программы выходит из этой области видимости.
// Здесь используется префиксный инкремент - $x сначала увеличивается на единицу, затем выводится. Значение
//сохраняется при выходе из ф-ции, соответственно следующий вызов ф-ции вновь увеличивает $x и это значение также
//сохраняется.
//РЕЗУЛЬТАТ 1234
//
//
//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//$a1 = new A();
//$a2 = new A();
//$a1->foo();  //1
//$a2->foo();  //2
//$a1->foo();  //3
//$a2->foo();  //4
//
// VI ЗАДАНИЕ
//
// У второго класса В ф-ция foo уже является своей собственной с собственной
// статической переменной. Эта функция вообще в этом классе могла быть переопределена или дополнена.
// Поэтому, если ф-цию foo вызывает объект, созданный на базе класса В -
// то статический счетчик будет увеличиваться в ф-ции класса В.
// Аналогична для класса А.
//
// РЕЗУЛЬТАТ 1122
//
//class A {
//    public function foo() {
//        static $x = 0;
//        echo ++$x;
//    }
//}
//class B extends A {
//}
//$a1 = new A();
//$b1 = new B();
//$a1->foo();  //1 - первый вызов foo-A
//$b1->foo();  //1 - первый вызов foo-B
//$a1->foo();  //2 - второй вызов foo-A
//$b1->foo();  //2 - второй вызов foo-В

// VII ЗАДАНИЕ
// $a1 и $b1 не являются объектами, здесь сохраняется идентификатор класса,
// который позволяет найти этот класс и в данном случае вызвать ф-цию. Также -
//у каждого класса ф-ция своя, поэтому и статический счетчик будет свой.

// РЕЗУЛЬТАТ 1122

class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
class B extends A {
}
$a1 = new A;
$b1 = new B;
$a1->foo();
$b1->foo();
$a1->foo();
$b1->foo();