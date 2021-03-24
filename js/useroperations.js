let tiklanan = undefined;
let silinecek = undefined;
let userTable = document.querySelector('#user-table');
let addUserForm = document.querySelector('#adduserform');
let addUserButton = document.querySelector('#adduserbutton');

let kaydetGuncelleBtn = document.querySelector('#kaydetguncelle');
let kno = document.querySelector('#eklekno');
let ktur = document.querySelector('#eklektip');
let kad = document.querySelector('#eklekad');
let ksifre = document.querySelector('#ekleksifre');

let mesaj = '';

function alanlariTemizle() {
  kno.value = '';
  ktur.selectedIndex = "0";
  kad.value = '';
  ksifre.value = '';
};

function alanlariKontrolEt() {
  let sonuc = false;
  if (kno.value != '' && kad.value != '' && ksifre.value != '') {
    sonuc = true;
  } else {
    
  }
  return sonuc;
};

function userOperations(event) {
  tiklanan = event.target;
  if (tiklanan.classList.contains('btn-delete')) {
    let onay = confirm('Bu kullanıcı silinecek, onaylıyor musunuz ?');
    if (onay) {
      silinecek = tiklanan.parentElement.previousSibling.previousSibling.previousSibling.previousSibling.textContent;
      window.location.href = "phpactions/deleteuser.php?silinecek=" + silinecek;
    }
  } else if (tiklanan.classList.contains('btn-edit')) {
    updateUser();
  }
};

function addUser() {
  alanlariTemizle();
  kaydetGuncelleBtn.value = 'Kaydet';
  addUserForm.style.display = 'block';
  addUserButton.disabled = true;
  addUserButton.classList.remove('active');
  addUserButton.classList.add('passive');
};

function updateUser() {
  addUserButton.classList.remove('passive');
  addUserButton.classList.add('active');
  addUserButton.disabled = false;

  kaydetGuncelleBtn.value = 'Güncelle';
  addUserForm.style.display = 'block';
  kno.value = tiklanan.parentElement.previousSibling.previousSibling.previousSibling.previousSibling.textContent;

  if (tiklanan.parentElement.previousSibling.previousSibling.previousSibling.textContent == 'Admin') {
    ktur.selectedIndex = "0";
  } else {
    ktur.selectedIndex = "1";
  };

  kad.value = tiklanan.parentElement.previousSibling.previousSibling.textContent;
  ksifre.value = tiklanan.parentElement.previousSibling.textContent;

};

function kaydetVeyaGuncelle() {
  if (kaydetGuncelleBtn.value == 'Güncelle') {
    addUserForm.action = 'phpactions/updateuser.php';
  } else if (kaydetGuncelleBtn.value == 'Kaydet') {
    addUserForm.action = 'phpactions/adduser.php';
  }

};

function formuKontrolEt(e) {
  if (alanlariKontrolEt()) {
    kaydetVeyaGuncelle();
  } else {
    e.preventDefault();
    alert('Lütfen tüm alanları doldurun');
    alanlariTemizle();
    addUserForm.style.display = 'none';
    tiklanan = undefined;
    addUserButton.classList.remove('passive');
    addUserButton.classList.add('active');
    addUserButton.disabled = false;
  }
};

userTable.addEventListener('click', userOperations);

addUserButton.addEventListener('click', addUser);

addUserForm.addEventListener('submit', formuKontrolEt);




