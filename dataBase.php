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

        function getTemasId() {
            include ("connection.php");

            $statement = "SELECT * FROM tema";
            $query = $conn->prepare($statement);
            $query->execute();
                           
            $arreglo = array();
            $i = 0;

            while ($result = $query->fetch(PDO::FETCH_OBJ)) {
                $arreglo[$i] = $result->idTema;
                $i++;
            }

            return $arreglo;
        }

        function addUser($nombre, $contraseña, $edad, $idGenero, $idEstadoCivil, $tema1 =  false, $tema2 = false, $tema3 = false) {
            include ("connection.php");

            $statement = "INSERT INTO usuario (nombre, contraseña, edad, idGenero, idEstadoCivil) VALUES (:nombre, :contrasena, :edad, :idGenero, :idEstadoCivil)";
            $query = $conn->prepare($statement);
            $query->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $query->bindParam(':contrasena', $contraseña, PDO::PARAM_STR);
            $query->bindParam(':edad', $edad, PDO::PARAM_INT);
            $query->bindParam(':idGenero', $idGenero, PDO::PARAM_INT);
            $query->bindParam(':idEstadoCivil', $idEstadoCivil, PDO::PARAM_INT);
            $query->execute();

            $statement2 = "SELECT * FROM usuario ORDER BY idUsuario desc";
            $query2 = $conn->prepare($statement2);
            $query2->execute();
            $usuario = $query2->fetch(PDO::FETCH_OBJ);

            $valorInicial = 0;
            $statement3 = "INSERT INTO megustatema (idUsuario, idTema, meGusta) VALUES (:idUsuario1, :idTema1, :meGusta1), 
            (:idUsuario2, :idTema2, :meGusta2), (:idUsuario3, :idTema3, :meGusta3)";
            $query3 = $conn->prepare($statement3);
            $query3->bindParam(':idUsuario1', $usuario->idUsuario, PDO::PARAM_INT);
            $query3->bindParam(':idTema1', $tema1, PDO::PARAM_INT);
            $query3->bindParam(':meGusta1', $valorInicial, PDO::PARAM_INT);
            $query3->bindParam(':idUsuario2', $usuario->idUsuario, PDO::PARAM_INT);
            $query3->bindParam(':idTema2', $tema2, PDO::PARAM_INT);
            $query3->bindParam(':meGusta2', $valorInicial, PDO::PARAM_INT);
            $query3->bindParam(':idUsuario3', $usuario->idUsuario, PDO::PARAM_INT);
            $query3->bindParam(':idTema3', $tema3, PDO::PARAM_INT);
            $query3->bindParam(':meGusta3', $valorInicial, PDO::PARAM_INT);
            $query3->execute();
        }
    }
?>