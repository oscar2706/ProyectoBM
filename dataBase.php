<?php
    class DataBase {
        function getTemas() {
            include ("connection.php");

            $statement = "SELECT * FROM tema";
            $query = $conn->prepare($statement);
            $query->execute();
                           
            $arreglo = array();
            $i = 0;

            while ($result = $query->fetch(PDO::FETCH_OBJ)) {
                $arreglo[$i] = $result->nombre;
                $i++;
            }

            return $arreglo;
        }
    }
?>