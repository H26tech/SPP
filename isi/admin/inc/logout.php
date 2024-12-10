<style>
    /* CSS untuk pop-up */
    .popup {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
    }

    .popup-inner {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }
</style>
<div class="item">
    <a href="#" id="logout-button">
        <div class="icon-wrapper bg-danger">
            <ion-icon name="log-out" role="img" class="md hydrated" aria-label="swap vertical"></ion-icon>
        </div>
        <strong>Log Out</strong>
    </a>
</div>

<!-- Pop-up konfirmasi log out -->
<div id="logout-popup" class="popup">
    <div class="popup-inner">
        <p>Apakah Anda yakin ingin log out?</p>
        <button type="button" class="btn btn-danger" id="logout-yes">Ya</button>
        <button type="button" class="btn btn-secondary" id="logout-no">Tidak</button>
    </div>
</div>

<script>
    // JavaScript untuk menampilkan dan menyembunyikan pop-up
    const logoutButton = document.getElementById('logout-button');
    const logoutPopup = document.getElementById('logout-popup');
    const logoutYesButton = document.getElementById('logout-yes');
    const logoutNoButton = document.getElementById('logout-no');

    logoutButton.addEventListener('click', () => {
        logoutPopup.style.display = 'block';
    });

    logoutNoButton.addEventListener('click', () => {
        logoutPopup.style.display = 'none';
    });

    logoutYesButton.addEventListener('click', () => {
        // Mengarahkan pengguna ke halaman log out PHP
        window.location.href = 'logout.php';
    });
</script>