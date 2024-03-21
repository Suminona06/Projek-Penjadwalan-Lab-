<p>Dear
    <?= $email_data['user']->username; ?>
</p>

<p>
    Kami telah menerima permintaan untuk mereset password untuk admin upa-tik dengan akun yang terhubung <i>
        <?= $email_data['user']->email; ?>
    </i>
    kamu bisa mereset password dengan menekan tombol di bawah:
    <br><br>
    <a href="<?= $email_data['actionLink']; ?>">Reset Password</a>
    <br><br>
    NB: Ini akan tetap valid dalam 15 menit
    <br><br>
    jika kamu tidak meminta untuk meriset password, tolong di abaikan email ini.
</p>