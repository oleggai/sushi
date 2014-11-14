<?php
/**
 * Created by PhpStorm.
 * User: олег
 * Date: 03.07.14
 * Time: 16:11
 */
class Model_cart extends Model {
    public function __construct() {
        $this->OpenDatabaseConnection();
    }

    /**
     * @param $value_cookie
     *
     * @return bool
     * @throws Exception
     */
    public function insertOrderHash($value_cookie) {
        try {
            $sql = "INSERT INTO order_hash (hash, datetime, isset_all_orders) VALUES (:value_cookie, NOW(), '0')";
            $sth=$this->db->prepare($sql);
            $sth->execute(array(
                                ":value_cookie"=>$value_cookie
                          ));
            $sth->setFetchMode(PDO::FETCH_ASSOC);

            $last_insert_id = $this->db->lastInsertId();
            return !empty($last_insert_id)? $last_insert_id : false;
        }
        catch (PDOException $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Not insert hash.");
        }
    }

    /**
     * @param $value_cookie
     *
     * @return mixed
     * @throws Exception
     */
    public function checkOrderHash($value_cookie) {
        try {
            $sql = "SELECT id_order_hash FROM order_hash WHERE hash = :value_cookie";
            $sth = $this->db->prepare($sql);
            $sth->execute(array(
                               ":value_cookie"=>$value_cookie
                            ));
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            return $sth->fetchAll();
        }
        catch (PDOException $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Did not select id_order_hash from table database");
        }
    }

    /**
     * @param $id_product
     * @param $id_type_product
     * @param $id_hash
     *
     * @return bool
     * @throws Exception
     */
    public function insertIntoCart($id_product, $id_type_product, $id_hash) {
        try {
            // Сдесь проверка на существование такого же товара в базе
            // Если есть то увеличиваем count_product на 1;
            $sql = "SELECT id_cart FROM cart
                    WHERE id_order_hash = :id_order_hash AND id_product = :id_product AND id_type = :id_type_product";
            $query = $this->db->prepare($sql);
            $query->execute(array(
                                  ":id_order_hash"   => $id_hash,
                                  ":id_product"      => $id_product,
                                  ":id_type_product" => $id_type_product
                             ));
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $result = $query->fetchAll();

            if(isset($result[0]["id_cart"])) {
                $sql = "UPDATE cart SET count_product = count_product + 1 WHERE id_cart = ".$result[0]['id_cart']."";
                $query = $this->db->query($sql);
                return $query->rowCount()? $result[0]["id_cart"] : false;
            }
            else {


                $sql = "INSERT INTO cart (id_order_hash, id_product, id_type, count_product, datetime)
                        VALUES (:id_hash, :id_product, :id_type, :count_product, NOW())";
                $sth = $this->db->prepare($sql);
                $sth->execute(array(
                                   ":id_hash"       => $id_hash,
                                   ":id_product"    => $id_product,
                                   ":id_type"       => $id_type_product,
                                   ":count_product" => 1,
                         ));
                return $this->db->lastInsertId()? $this->db->lastInsertId() : false;
            }
        }
        catch (PDOException $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Error database! Not insert into table cart!");
        }
    }

    /**
     * @param $id_hash
     *
     * @return mixed
     * @throws Exception
     */
    public function selectCart($id_hash) {
        try {
            $sql = "SELECT products.name_product, products.compound, products.image, products.image_large,
                           type.diameter, type.weight, type.price,
                           cart.id_cart, cart.count_product, cart.count_product*type.price AS all_price
                    FROM cart, products, type
                    WHERE id_order_hash = :id_hash AND cart.id_product = products.id_product AND cart.id_type = type.id_type";
            $query = $this->db->prepare($sql);
            $query->execute(array(
                                 ":id_hash" => $id_hash
                               ));

            $query->setFetchMode(PDO::FETCH_ASSOC);
            return $query->fetchAll();
        }
        catch (PDOException $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Did not select data cart from table database");
        }

    }

    /**
     * @param $id_hash
     *
     * @return mixed
     * @throws Exception
     */
    public function selectSumPrice($id_hash) {
        try{
            $sql = "SELECT  SUM(cart.count_product*type.price) AS sum_price, SUM(cart.count_product) AS all_count_product
                    FROM cart, products, type
                    WHERE id_order_hash = :id_hash AND cart.id_product = products.id_product AND cart.id_type = type.id_type";
            $query = $this->db->prepare($sql);
            $query->execute(array(
                                 ":id_hash" => $id_hash
                              ));
            $query->setFetchMode(PDO::FETCH_ASSOC);
            return $query->fetchAll();
        }
        catch(Exception $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Did not select SUM from table database");
        }
    }
    public function changeCountProduct($id_cart, $flag) {
        try {
            if($flag == "1") {
                $sql ="UPDATE cart SET count_product = count_product - 1 WHERE id_cart = :id_cart";
            }
            if($flag == "2") {
                $sql ="UPDATE cart SET count_product = count_product + 1 WHERE id_cart = :id_cart";
            }
                $query = $this->db->prepare($sql);
                $query->execute(array(
                                    ":id_cart"=>$id_cart
                              ));
            $sql = "SELECT count_product FROM cart WHERE id_cart = :id_cart";
            $query = $this->db->prepare($sql);
            $query->execute(array(
                    ":id_cart"=>$id_cart
                ));
                $query->setFetchMode(PDO::FETCH_ASSOC);
                return $query->fetch();

        }
        catch (PDOException $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Did not update count product from table cart database");
        }
    }
    public function allPrice($id_cart) {
        try {
            $sql = "SELECT cart.count_product*type.price AS all_price FROM cart, type
                    WHERE cart.id_cart = :id_cart AND cart.id_type = type.id_type";

            $query = $this->db->prepare($sql);
            $query->execute(array(
                                  ":id_cart"=>$id_cart
                           ));
            $query->setFetchMode(PDO::FETCH_ASSOC);
            return $query->fetch();
        }
        catch(Exception $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Did not select all price from table database");
        }

    }
    public function allSumCount($id_cart) {
        try{
            $mass_id_hash = array();
            $sql = "SELECT id_order_hash FROM cart WHERE id_cart=:id_cart";

            $query = $this->db->prepare($sql);
            $query->execute(array(
                                ":id_cart"=>$id_cart
                             ));

            $query->setFetchMode(PDO::FETCH_ASSOC);
            $mass_id_hash = $query->fetch();
            return $this->selectSumPrice($mass_id_hash["id_order_hash"]);
        }
        catch(Exception $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Did not select all sum price from table cart database");
        }
    }
    public function delProductFromCart($id_cart, $id_order_hash) {
        try {
            $sql = "DELETE FROM cart
                    WHERE id_cart = :id_cart AND id_order_hash = :id_order_hash
                    LIMIT 1";

            $query = $this->db->prepare($sql);
            $query->execute(array(
                                 ":id_cart"       => $id_cart,
                                 ":id_order_hash" => $id_order_hash
                ));
            return $query->rowCount()? true : false;
        }
        catch(Exception $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Did not delete product from table cart database");
        }
    }

    public function insertIntoAllOrders($id_order_hash, $name_customer, $street, $house, $apartment, $phone, $email, $note) {

        try {
            $sql = "INSERT INTO all_orders (id_order_hash, name_customer, street, house, apartment, phone, email, note, datetime)
                    VALUES (:id_order_hash, :name_customer, :street, :house, :apartment, :phone, :email, :note, NOW())";
            $query = $this->db->prepare($sql);
            $query->execute(array(
                                  ":id_order_hash" => $id_order_hash,
                                  ":name_customer" => $name_customer,
                                  ":street"        => $street,
                                  ":house"         => $house,
                                  ":apartment"     => $apartment,
                                  ":phone"         =>$phone,
                                  ":email"         => $email,
                                  ":note"          => $note
                ));
            if($this->db->lastInsertId()) {
                $sql = "UPDATE order_hash SET isset_all_orders = '1' WHERE id_order_hash = :id_order_hash";
                $query = $this->db->prepare($sql);
                $query->execute(array(
                                     ":id_order_hash" => $id_order_hash
                                 ));
                return $query->rowCount()? true : false;
            }
            else {
                return false;
            }
        }
        catch(Exception $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Did not insert order from table all_orders database");
        }
    }

    public function insertIntoNewOrders($id_order_hash) {
        try {
            $sql = "INSERT INTO new_orders (id_order_hash)
                    VALUES (:id_order_hash)";
            $query = $this->db->prepare($sql);
            $query->execute(array(
                    ":id_order_hash" => $id_order_hash
                ));
            return $this->db->lastInsertId();
        }
        catch(Exception $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Not delete type record in table type.");
        }
    }

    public function updateDateTimeInOrderHash($id_order_hash) {
        try{
            $sql = "UPDATE order_hash SET datetime = NOW() WHERE id_order_hash = :id_order_hash";

            $query = $this->db->prepare($sql);
            $query->execute(array(
                                  ":id_order_hash" => $id_order_hash
                ));
            return $query->rowCount()? true : false;
        }
        catch(Exception $e) {
            $this->setError(new Error($e->getMessage(), TypeError::Error, $e->getCode()));
            throw new Exception("Database error! Did not update datetime from table order_hash database");
        }
    }
}