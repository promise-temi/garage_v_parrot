<?php
require_once "db.php";

$priceSort = $_POST['priceSort'] ?? 'price_asc';
$mileageSort = $_POST['mileageSort'] ?? 'mileage_asc';
$yearSort = $_POST['yearSort'] ?? 'year_asc';

$query = "SELECT id, make, model, year, mileage, price, description, image FROM vehicles";


$orderBy = [];
switch ($priceSort) {
    case 'price_asc': $orderBy[] = "price ASC"; break;
    case 'price_desc': $orderBy[] = "price DESC"; break;
}
switch ($mileageSort) {
    case 'mileage_asc': $orderBy[] = "mileage ASC"; break;
    case 'mileage_desc': $orderBy[] = "mileage DESC"; break;
}
switch ($yearSort) {
    case 'year_asc': $orderBy[] = "year ASC"; break;
    case 'year_desc': $orderBy[] = "year DESC"; break;
}

if (!empty($orderBy)) {
    $query .= " ORDER BY " . implode(', ', $orderBy);
}

$stmt = $pdo->prepare($query);
$stmt->execute();
$vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($vehicles);
?>