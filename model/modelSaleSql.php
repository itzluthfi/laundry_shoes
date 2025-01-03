<?php

require_once "/laragon/www/laundry_shoes/model/dbConnect.php";
require_once "/laragon/www/laundry_shoes/domain_object/node_sale.php";
require_once "/laragon/www/laundry_shoes/domain_object/node_detailSale.php";

class ModelSaleSql {
    private $db;

    public function __construct() {
        // Inisialisasi koneksi database
        $this->db = new Database('localhost', 'root', '', 'laundrysepatu');
    }

    public function addSale($detailSale, int $salePay, int $saleChange, int $saleTotalPrice, $saleDate, int $user_id, int $member_id) {
        $salePay = (int)$salePay;
        $saleChange = (int)$saleChange;
        $saleTotalPrice = (int)$saleTotalPrice;
        $saleDate = addslashes($saleDate); // Escape string input
        $user_id = (int)$user_id;
        $member_id = (int)$member_id;
    
        
        $query = "INSERT INTO sales (user_id, member_id, pay, `change`, total_price, date) 
                  VALUES ($user_id, $member_id, $salePay, $saleChange, $saleTotalPrice, '$saleDate')";
    
        try {
            $this->db->execute($query);
            $saleId = $this->db->conn->insert_id;
    
            $detailsalesData = [];
            if (!empty($detailSale) ) {
                foreach ($detailSale as $index => $item) {
                    echo "<script>console.log('Processing item at index $index: " . json_encode($item) . "');</script>";
    
                    // Validate and process each item
                    $item_id = isset($item['item_id']) && $item['item_id'] !== '' ? (int)$item['item_id'] : null;
                    $quantity = isset($item['item_qty']) && $item['item_qty'] !== '' ? (int)$item['item_qty'] : null;
    
                    if ($item_id !== null && $quantity !== null) {
                        $detailQuery = "INSERT INTO detailsales (id, sale_id, item_id, quantity) 
                                        VALUES (NULL, $saleId, $item_id, $quantity)";
                        $this->db->execute($detailQuery);
    
                        $detailsalesData[] = [
                            'sale_id' => $saleId,
                            'item_id' => $item_id,
                            'quantity' => $quantity,
                        ];
                    } else {
                        echo "<script>console.log('Skipping invalid item data at index $index');</script>";
                    }
                }
            } else {
                echo "<script>console.log('detailSale is empty or not an array');</script>";
            }
    
            // Display sales data for debugging
            // $salesData = [
            //     'sale_id' => $saleId,
            //     'user_id' => $user_id,
            //     'member_id' => $member_id,
            //     'pay' => $salePay,
            //     'change' => $saleChange,
            //     'total_price' => $saleTotalPrice,
            //     'date' => $saleDate,
            // ];
    
            // echo "<h1>Penjualan Berhasil!</h1>";
            // echo "<h2>Data Sales:</h2>";
            // echo "<pre>" . print_r($salesData, true) . "</pre>";
            // echo "<h2>Data Detail Sales:</h2>";
            // echo "<pre>" . print_r($detailsalesData, true) . "</pre>";
    
            return true;
        } catch (Exception $e) {
            $errorMessage = addslashes($e->getMessage());
            echo "<script>console.log('Error adding sale: $errorMessage');</script>";
            return false;
        }
    }
    
     

    
    
    

    public function getAllSales() {
        $query = "SELECT * FROM sales";
        $result = $this->db->select($query);

        $sales = [];
        foreach ($result as $row) {
            $saleId = $row['id'];
            $details = $this->getDetailsBySaleId($saleId);
            $sales[] = new Sale($saleId, $row['pay'], $row['change'], $row['total_price'], $row['date'], $row['user_id'], $row['member_id'], $details);
        }
        return $sales;
    }

    private function getDetailsBySaleId($saleId) {
        $query = "SELECT * FROM detailsales WHERE sale_id = $saleId";
        $result = $this->db->select($query);

        $details = [];
        foreach ($result as $row) {
            $details[] = new DetailSale($row['sale_id'], $row['item_id'], '', 0, $row['quantity']); // Tidak ada nama item & harga
        }
        return $details;
    }

    public function getSaleById($saleId) {
        $saleId = (int)$saleId;
        $query = "SELECT * FROM sales WHERE id = $saleId";
        $result = $this->db->select($query);

        if (count($result) > 0) {
            $row = $result[0];
            $details = $this->getDetailsBySaleId($saleId);
            return new Sale($row['id'], $row['pay'], $row['change'], $row['total_price'], $row['date'], $row['user_id'], $row['member_id'], $details);
        }

        return null;
    }

    public function deleteSale($saleId) {
        $saleId = (int)$saleId;

        // Hapus detail sales terlebih dahulu
        $detailQuery = "DELETE FROM detailsales WHERE sale_id = $saleId";

        try {
            $this->db->execute($detailQuery);

            // Hapus data dari tabel sales
            $query = "DELETE FROM sales WHERE id = $saleId";
            $this->db->execute($query);

            return true;
        } catch (Exception $e) {
            echo "<script>console.log('Error deleting sale: " . addslashes($e->getMessage()) . "');</script>";
            return false;
        }
    }

    public function __destruct() {
        // Menutup koneksi database
        $this->db->close();
    }
}

?>