// panggil elemen2 yang dibutuhkan
var keyword = document.getElementById('keyword');
var tabel = document.getElementById('tabel');

// tambahkan event ketika keyword ditulis
keyword.addEventListener('keyup', function(){
    
    // buat objek ajax
    var xhr = new XMLHttpRequest();

    // cek kesiapan ajax
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            tabel.innerHTML = xhr.responseText;
        }
    };

    // eksekusi ajax
    xhr.open('GET', 'ajax/perum.php?keyword=' + keyword.value, true);
    xhr.send();
});