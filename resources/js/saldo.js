/**
 * saldo.js — Logika halaman Kelola Saldo
 * Isi otomatis nominal dari tombol preset
 */
function setAmount(val) {
    var input = document.getElementById('amount');
    if (input) {
        input.value = val;
        input.focus();
    }
}
