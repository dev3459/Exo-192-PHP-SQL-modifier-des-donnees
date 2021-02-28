<?php
/**
 * 1. Le dossier SQL contient l'export de ma table user.
 * 2. Trouvez comment importer cette table dans une des bases de données que vous avez créées, si vous le souhaitez vous pouvez en créer une nouvelle pour cet exercice.
 * 3. Assurez vous que les données soient bien présentes dans la table.
 * 4. Créez votre objet de connexion à la base de données comme nous l'avons vu
 * 5. Insérez un nouvel utilisateur dans la base de données user
 * 6. Modifiez cet utilisateur directement après avoir envoyé les données ( on imagine que vous vous êtes trompé )
 */

// TODO Votre code ici.
try {
    require './db/version-static.php';
    $db = DB::getInstance();

    $sql = $db->prepare("INSERT INTO bdd_cours.user (nom, prenom, rue, numero, code_postal, ville, pays, mail) VALUES (:nom, :prenom, :rue, :numero, :codePostal, :ville, :pays, :mail)");

    $sql->execute([
        ':nom' => 'TESTNOM',
        ':premnom' => 'TESTPRENOM',
        ':rue' => 'RUE BOULEVARD',
        ':numero' => 20,
        ':codePostal' => 34350,
        ':ville' => 'Valras',
        ':pays' => 'France',
        ':mail' => 'contact@contact.contact'
    ]);
    $lastId = $db->lastInsertID();
    $sql = $db->prepare("UPDATE bdd_cours.user SET nom = :nom WHERE id = $lastId");

    $sql->execute([
        ':nom' => 'TESTMODIFIER'
    ]);

} catch(PDOException $exception) {
    echo $exception->getMessage();
}

/**
 * Théorie
 * --------
 * Pour obtenir l'ID du dernier élément inséré en base de données, vous pouvez utiliser la méthode: $bdd->lastInsertId()
 *
 * $result = $bdd->execute();
 * if($result) {
 *     $id = $bdd->lastInsertId();
 * }
 */