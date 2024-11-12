<!-- Modal -->
<?php if (isset($_POST["sign-cours"]) && !empty($_POST["sign-cours-id"])): ?>
    <div id="sign-modal">
        <div class="background"></div>
        <div class="content">
            <div class="modal-header">
                <h5 class="modal-title">Signer le cours</h5>
                <div class="close-btn">
                    <form action="" method="post">
                        <input type="submit" name="close" value="x">
                    </form>
                </div>
            </div>
            <div class="modal-body">
                <div class="canva_container">
                    <canvas id="signature-pad" width="700" height="300" style="border: 1px solid #000;"></canvas>
                </div>
                <div class="buttons">
                    <button id="clear-btn">Effacer</button>
                    <form id="signregister" action="" method="post">
                        <input type="hidden" id="sign_file_name" name="filepath" value="">
                        <input type="hidden" name="coursid" value="<?php echo $_POST["sign-cours-id"]; ?>">
                        <input type="hidden" name="valid_sign" value="1">
                        <input type="submit" id="save-btn" value="Envoyer">
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>