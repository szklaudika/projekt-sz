<?php
global $conn;
global $featured_products;
include("server\connection.php");
$stmt = $conn->prepare("SELECT * FROM products");
$stmt->execute();
$featured_products = $stmt->get_result();

