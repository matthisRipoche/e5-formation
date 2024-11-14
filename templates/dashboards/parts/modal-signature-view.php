<!-- Modal sign view-->
<?php
if (isset($_POST["showsign"])) {
    $coursId = $_POST['sign-cours-id'];
    $eleveID = $eleve->getId();
    $stmt = $pdo->prepare('SELECT * FROM signature WHERE eleve = :eleve AND cour = :cours');
    $stmt->bindParam(':eleve', $eleveID, PDO::PARAM_INT);
    $stmt->bindParam(':cours', $coursId, PDO::PARAM_INT);
    $stmt->execute();
    $sign = $stmt->fetch();

    if ($sign) {
        $filepath = $sign['filepath'];
    }
}
?>

<?php if (isset($_POST["showsign"])): ?>
    <div id="viewsign-modal">
        <div class="background"></div>
        <div class="content">
            <div class="modal-header bg-dark">
                <h5 class="modal-title text-white">Votre Signature</h5>
                <div class="close-btn">
                    <form action="" method="post">
                        <input type="submit" name="close" value="x">
                    </form>
                </div>
            </div>
            <div class="modal-body bg-light">
                <?php if ($filepath): ?>
                    <div class="canva_container">
                        <img src="<?php echo $baseUrl; ?>/signatures/<?php echo $filepath; ?>" alt="">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>