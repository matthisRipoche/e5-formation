document.addEventListener("DOMContentLoaded", () => {
    console.log("modals.js chargé");

    // Initialiser le canevas et Signature Pad
    const canvas = document.getElementById("signature-pad");

    if (canvas) {
        // Initialiser Signature Pad
        const signaturePad = new SignaturePad(canvas, {
            backgroundColor: "rgba(255, 255, 255, 1)",
            penColor: "rgb(0, 0, 0)",
        });

        // Bouton pour effacer la signature
        const clearButton = document.getElementById("clear-btn");
        console.log(clearButton);
        clearButton.addEventListener("click", () => {
            signaturePad.clear();
        });

        // Bouton pour sauvegarder la signature
        const saveButton = document.getElementById("save-btn");
        saveButton.addEventListener("click", (e) => {
            e.preventDefault();
            if (signaturePad.isEmpty()) {
                alert("Veuillez fournir une signature d'abord.");
            } else {
                const dataURL = signaturePad.toDataURL("image/png");
                console.log(dataURL);
                fetch("include/upload_signature.php", {
                    method: "POST",
                    body: JSON.stringify({ image: dataURL }),
                    headers: { "Content-Type": "application/json" },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.status === "success") {
                            document.getElementById("sign_file_name").value =
                                data.filename;

                            document.querySelector("#signregister").submit();
                        } else {
                            alert("Erreur: " + data.message);
                        }
                    })
                    .catch((error) => {
                        console.error("Erreur lors de l'envoi :", error);
                    });
            }
        });
    }
});
