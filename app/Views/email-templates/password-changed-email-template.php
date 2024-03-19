<p>Dear
    <?= $mail_data['admin']->name; ?>
</p>

<p>
    Password mu pada sistem upa-tik telah berhasil di rubah, ini adalah kredensial baru login mu:
    <br><br>
    <b>Login ID:
        <?= $mail_data['admin']->username; ?> or
        <?= $mail_data['admin']->email; ?>
    </b>
    <br>
    <b>Password:
        <?= $mail_data['new_password']; ?>
    </b>
</p>
<br><br>
Dimohon untuk menjaga akun anda, username dan password anda dan akun anda jangan pernah di beritahu orang lain.
<p>
    Upa-tik 2024
</p>