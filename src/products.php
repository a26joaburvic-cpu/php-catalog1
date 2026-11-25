<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

$products = [
    [
        "id" => 1,
        "name" => "Monitor",
        "category" => "Hardware",
        "price" => 189,
        "stock" => 5
    ],
    [
        "id" => 2,
        "name" => "Teclat",
        "category" => "Perifèrics",
        "price" => 49,
        "stock" => 12
    ],
    [
        "id" => 3,
        "name" => "Ratolí",
        "category" => "Perifèrics",
        "price" => 29,
        "stock" => 0
    ],
    [
        "id" => 4,
        "name" => "Webcam",
        "category" => "Perifèrics",
        "price" => 89,
        "stock" => 8
    ],
    [
        "id" => 5,
        "name" => "Processador",
        "category" => "Hardware",
        "price" => 250,
        "stock" => 3
    ],
    [
        "id" => 6,
        "name" => "Auriculars",
        "category" => "Perifèrics",
        "price" => 65,
        "stock" => 0
    ],
    [
        "id" => 7,
        "name" => "Suport per a monitor",
        "category" => "Accessoris",
        "price" => 35,
        "stock" => 10
    ]
];


function priceLabel($price) {

    if ($price < 75) {
        return "Producte econòmic";
    }
    elseif ($price <= 200) {
        return "Preu mitjà";
    }
    else {
        return "Producte premium";
    }
}
$category = "";

if (isset($_GET["category"])) {
    $category = $_GET["category"];
}

$maxPrice = "";

if (isset($_GET["maxPrice"]) && is_numeric($_GET["maxPrice"])) {
    $maxPrice = $_GET["maxPrice"];
}


?>
<!DOCTYPE html>
<html lang="ca">

<head>
    <meta charset="UTF-8">
    <title>Catàleg PHP</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <h1>Catàleg de productes</h1>
    <nav>
    <a href="products.php">Tots els productes</a>

    <a href="products.php?category=Hardware">Hardware</a>

    <a href="products.php?category=Perif%C3%A8rics">Perifèrics</a>

    <a href="products.php?category=Accessoris">Accessoris</a>
    </nav>

    <form method="GET" action="products.php">

    <input type="hidden" name="category"
           value="<?= htmlspecialchars($category) ?>">

    <label>Preu màxim:</label>

    <input type="number" name="maxPrice" min="0"
           value="<?= htmlspecialchars($maxPrice) ?>">

    <button type="submit">Filtrar</button>

</form>

<hr>

    <?php foreach ($products as $actual): ?>

        <?php if (($category === "" || $actual["category"] === $category) &&
          ($maxPrice === "" || $actual["price"] <= $maxPrice)): ?>

            <article>

                <h2><?= htmlspecialchars($actual["name"]) ?></h2>

                <p>Categoria: <?= htmlspecialchars($actual["category"]) ?></p>

                <p>Preu: <?= $actual["price"] ?> €</p>

                <p class="etiqueta <?= $actual["price"] < 75 ? "economic" : ($actual["price"] <= 200 ? "mitja" : "premium") ?>">
    <?= priceLabel($actual["price"]) ?>
</p>
                <?php if ($actual["stock"] == 0): ?>

    <p class="esgotat">Producte esgotat</p>

<?php else: ?>

    <p class="disponible">Estoc: <?= $actual["stock"] ?> unitats</p>

<?php endif; ?>

            </article>

            <hr>

        <?php endif; ?>

    <?php endforeach; ?>

</body>
</html>