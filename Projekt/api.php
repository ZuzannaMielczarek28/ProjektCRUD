<?php
header("Content-Type: application/json"); 
include 'db.php';

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case "GET":
        $result = $conn->query("SELECT * FROM Rybny");
        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
        break;

    case "POST":
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $conn->prepare("INSERT INTO Rybny (nazwa, stan_magazynowy, cena, wystepowanie) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sids", $data["nazwa"], $data["stan_magazynowy"], $data["cena"], $data["wystepowanie"]);
        $stmt->execute();
        echo json_encode(["message" => "Dodano rybę"]);
        break;

    case "PUT":
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $conn->prepare("UPDATE Rybny SET nazwa=?, stan_magazynowy=?, cena=?, wystepowanie=? WHERE id=?");
        $stmt->bind_param("sidsi", $data["nazwa"], $data["stan_magazynowy"], $data["cena"], $data["wystepowanie"], $data["id"]);
        $stmt->execute();
        echo json_encode(["message" => "Zaktualizowano rybę"]);
        break;

    case "DELETE":
        parse_str(file_get_contents("php://input"), $data);
        $stmt = $conn->prepare("DELETE FROM Rybny WHERE id=?");
        $stmt->bind_param("i", $data["id"]);
        $stmt->execute();
        echo json_encode(["message" => "Usunięto rybę"]);
        break;

    default:
        http_response_code(405);
        echo json_encode(["error" => "Niedozwolona metoda"]);
}

$conn->close();
?>