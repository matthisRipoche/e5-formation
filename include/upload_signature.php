<?php

new UploadSignatures();

class UploadSignatures
{
    public function __construct()
    {
        $this->upload_signature();
    }

    public function upload_signature()
    {
        header('Content-Type: application/json');

        $input = json_decode(file_get_contents("php://input"), true);

        if (isset($input['image'])) {
            $base64_image = $input['image'];

            if (preg_match('/^data:image\/(png|jpeg|jpg);base64,/', $base64_image)) {
                $data = explode(',', $base64_image);
                $decoded_image = base64_decode($data[1]);

                if ($decoded_image === false) {
                    echo json_encode([
                        "status" => "error",
                        "message" => "Le décodage de l'image a échoué."
                    ]);
                    return;
                }

                // Chemin absolu pour le dossier signatures
                $directory = '/var/www/public/e5-formation/signatures';

                // Vérifiez si le dossier `signatures` existe ou créez-le
                if (!file_exists($directory)) {
                    if (!mkdir($directory, 0777, true)) {
                        echo json_encode([
                            "status" => "error",
                            "message" => "Impossible de créer le dossier des signatures."
                        ]);
                        return;
                    }
                }

                $filename = 'signature_' . time() . '.png';
                $file_path = $directory . '/' . $filename;

                $result = file_put_contents($file_path, $decoded_image);

                if ($result !== false) {
                    echo json_encode([
                        "status" => "success",
                        "message" => "L'image a été enregistrée avec succès.",
                        "filename" => $filename
                    ]);
                } else {
                    echo json_encode([
                        "status" => "error",
                        "message" => "Erreur lors de l'écriture du fichier image.",
                        "filepath" => $file_path
                    ]);
                }
            } else {
                echo json_encode([
                    "status" => "error",
                    "message" => "L'image n'est pas au format Base64 valide."
                ]);
            }
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Aucune image reçue."
            ]);
        }
    }
}
