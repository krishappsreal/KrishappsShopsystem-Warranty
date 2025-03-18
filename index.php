<?php
// Átirányítás, ha nincs paraméter
if (!isset($_GET['q'])) {
    header("Location: https://shop.krishapps.com");
    exit();
}

// Paraméter feldolgozása
$query = $_GET['q'];
$parts = explode('-', $query);
$amount = isset($parts[0]) ? $parts[0] : '';
$paymentMethodCode = isset($parts[1]) ? $parts[1] : '';

// Fizetési mód meghatározása
$paymentMethods = [
    'bk' => 'Bankkártya',
    'kp' => 'Készpénz',
    'va' => 'Vásárlói/Ajándékkártya'
];

$paymentMethod = isset($paymentMethods[$paymentMethodCode]) ? $paymentMethods[$paymentMethodCode] : 'Ismeretlen fizetési mód';

// Véletlenszerű jótállási kód és bizonylatszám generálása
$warrantyCode = sprintf('%08d', mt_rand(0, 99999999)); // 8 jegyű szám
$invoiceNumber = '00-' . sprintf('%04d', mt_rand(0, 9999)); // 00- előtaggal és 4 jegyű szám
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fizetési információk</title>
    <style>
        /* Alapstílusok */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 28px;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 30px;
        }

        .info p {
            font-size: 18px;
            line-height: 1.6;
            margin: 10px 0;
        }

        .warranty-info {
            background-color: #f1f1f1;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .warranty-info p {
            font-size: 16px;
            line-height: 1.5;
            margin: 10px 0;
        }

        .button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #2980b9;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Fizetési információk</h1>
        <div class="info">
            <p><strong>Végösszeg:</strong> <?php echo number_format($amount, 0, ',', ' '); ?> Ft</p>
            <p><strong>Fizetési mód:</strong> <?php echo $paymentMethod; ?></p>
        </div>
        <div class="warranty-info">
            <p>Ez a weboldal egyben a jótállási jegy. Nincs szükség a blokkra, mivel ez a dokumentum alapján is megtaláljuk a rendszerben.</p>
            <p>Kérlek, ha megszeretnéd tartani a jótállást, jegyezd le vagy írd fel valahova ezt a linket.</p>
            <p><strong>Jótállási kód:</strong> <?php echo $warrantyCode; ?></p>
            <p><strong>Bizonylatszám:</strong> <?php echo $invoiceNumber; ?></p>
            <p>Ha a linket nem szeretnéd használni, a rendszerben megtudjuk keresni az Ön blokkját.</p>
        </div>
        <a href="https://krishapps.com/help1" class="button">További információ</a>
        <div class="footer">
            <p>&copy; <?php echo date('Y'); ?> KrishApps. Minden jog fenntartva.</p>
        </div>
    </div>
</body>
</html>
