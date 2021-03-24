let tiklananTr = undefined;
let tiklananTrIndex = undefined;
let ticketTable = document.querySelector('table');
let url = window.location.href;
let prms = url.split("=");

// Get the modal
let modal = document.getElementById("myModal");

//Eğer url'de parametre varsa modeli açıyoruz
if (prms[1]) {
  modal.style.display = "block";
  prm = prms[1];
  prmslast = prm.split("/");
  secilenTakipNo = prmslast[0];
  secilenTr = prmslast[1];
  //Sayfayı kullanan kullanıcıysa detay durumunu javascript ile değiştirdik, admin ise php ile ekliyoruz
  if (localStorage.getItem('Kullanici') === 'user') {
    document.querySelector('#ddurum').textContent =   ticketTable.rows[secilenTr].cells[2].textContent;
    document.querySelector('#dtakip').textContent =   ticketTable.rows[secilenTr].cells[0].textContent;
    document.querySelector('#durun').textContent =   ticketTable.rows[secilenTr].cells[1].textContent;
  }
};

// Get the button that opens the modal
let btn = document.querySelectorAll(".myBtn");

// Get the <span> element that closes the modal
let span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
function detayGoster(e) {
  tiklananTr = e.target.parentElement.parentElement;
  tiklananTrIndex = tiklananTr.rowIndex;
  let tno = tiklananTr.cells[0].textContent;
  let params = tno + "/" + tiklananTrIndex;
  if(e.target.classList.contains('showModal')) {
    window.location.href = "tickets.php?params=" + params;
    //Sayfayı yenilediğimizde detayları ekrana yazdırırken hata almamak için admin mi girmiş kullanıcı mı tespit ettik
    if (e.target.classList.contains('user')) {
      localStorage.setItem('Kullanici', 'user');
    } else {
      localStorage.removeItem('Kullanici');
    };
  }
};

ticketTable.addEventListener('click', detayGoster);

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
};

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};