/**
 * auth.js — Logika halaman Register
 * Toggle visibilitas password (show/hide)
 */
function togglePassword(id, btn) {
    var input   = document.getElementById(id);
    var isHidden = input.type === 'password';

    input.type = isHidden ? 'text' : 'password';

    btn.querySelector('.icon-eye').style.display     = isHidden ? 'none' : '';
    btn.querySelector('.icon-eye-off').style.display = isHidden ? ''     : 'none';

    btn.setAttribute(
        'aria-label',
        isHidden ? 'Sembunyikan password' : 'Tampilkan password'
    );
}
