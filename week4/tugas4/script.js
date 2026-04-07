// ===== MODAL =====
let modalCallback = null;

function showModal(msg, callback) {
  document.getElementById('modal-msg').textContent = msg;
  document.getElementById('modal-overlay').classList.add('show');
  modalCallback = callback || null;
}

function closeModal() {
  document.getElementById('modal-overlay').classList.remove('show');
  if (modalCallback) {
    const cb = modalCallback;
    modalCallback = null;
    cb();
  }
}

// ===== NAVIGASI =====
function showPage(page) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));

  document.getElementById('page-' + page).classList.add('active');

  const idx = { home: 0, menu: 1, calc: 2 };
  document.querySelectorAll('.nav-item')[idx[page]].classList.add('active');
}

// ===== HOME =====
function handleShout() {
  showModal('Hai, Selamat datang di Sistem Sederhana');
}

// ===== MENU =====
function handleMenuClick() {
  showModal('Input Jumlah Pesanan agar di hitung otomatis oleh sistem', function () {
    showPage('menu');
    hitungTotal();
  });
}

function hitungTotal() {
  const harga = [12000, 10000, 15000];
  const qty = [
    parseInt(document.getElementById('qty1').value) || 0,
    parseInt(document.getElementById('qty2').value) || 0,
    parseInt(document.getElementById('qty3').value) || 0
  ];

  let total = 0;
  for (let i = 0; i < 3; i++) {
    total += harga[i] * qty[i];
  }

  let diskon = 0;
  if (total > 50000) {
    diskon = Math.round(total * 0.1);
  }

  const bayar = total - diskon;

  document.getElementById('jumlah-total').textContent = total;
  document.getElementById('diskon-val').textContent   = diskon;
  document.getElementById('jumlah-bayar').innerHTML   = '<strong>' + bayar + '</strong>';
}

function resetMenu() {
  document.getElementById('qty1').value = 0;
  document.getElementById('qty2').value = 0;
  document.getElementById('qty3').value = 0;
  hitungTotal();
}

// ===== CALCULATOR =====
function hitung() {
  const n1 = document.getElementById('num1').value.trim();
  const n2 = document.getElementById('num2').value.trim();

  if (n1 === '' || n2 === '') {
    showModal('inputan pertama dan kedua harus lebih dari 0');
    return;
  }

  const a  = parseFloat(n1);
  const b  = parseFloat(n2);
  const op = document.getElementById('operator').value;

  if (isNaN(a) || isNaN(b)) {
    showModal('inputan pertama dan kedua harus lebih dari 0');
    return;
  }

  let result;
  switch (op) {
    case '+': result = a + b; break;
    case '-': result = a - b; break;
    case '*': result = a * b; break;
    case '/':
      if (b === 0) { showModal('Tidak bisa membagi dengan 0'); return; }
      result = a / b;
      break;
  }

  document.getElementById('calc-result').value = parseFloat(result.toFixed(6));
}

function resetCalc() {
  document.getElementById('num1').value = '';
  document.getElementById('num2').value = '';
  document.getElementById('calc-result').value = '';
}