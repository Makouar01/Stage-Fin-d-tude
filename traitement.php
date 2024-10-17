
<?php
// Paramètres de connexion à la base de données
$host = 'localhost';
$dbName = 'esto';
$user = 'root';
$password = '';

// Connexion à la base de données
try {
    $dsn = "mysql:host=$host;dbname=$dbName";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}

// Vérifier si un fichier a été soumis via le formulaire
if(isset($_FILES['csvFile']) && $_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
    // Récupérer les informations sur le fichier
    $fileTmpPath = $_FILES['csvFile']['tmp_name'];
    $fileName = $_FILES['csvFile']['name'];
    $fileSize = $_FILES['csvFile']['size'];
    $fileType = $_FILES['csvFile']['type'];

    // Vérifier l'extension du fichier
    $allowedExtensions = array('csv');
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    if (!in_array($fileExtension, $allowedExtensions)) {
        die("Erreur : Seuls les fichiers CSV sont autorisés.");
    }

    // Lire csv
    $csvData = file_get_contents($fileTmpPath);

    // CSV VERS tableau
    $dataArray = array_map("str_getcsv", explode("\n", $csvData));

    // Supprimer la première ligne
    $headers = array_shift($dataArray);

    // requête SQL d'insertion
    $tableName = 'etudiant';
    $columns = implode(", ", $headers);
    $placeholders = rtrim(str_repeat("?,", count($headers)), ",");
    $insertQuery = "INSERT INTO $tableName ($columns) VALUES ($placeholders)";

    // Préparer la requête d'insertion
    $insertStatement = $pdo->prepare($insertQuery);

    // Insére chaque ligne dans la table 
    foreach ($dataArray as $row) {
        $insertStatement->execute($row);
        header("Location: etudiant2.php");

    }

} 

// Fermeture de la connexion à la base de données
$pdo = null;
?>
