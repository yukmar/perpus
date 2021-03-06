var modalLogin = document.querySelector(".loginform");
var modalDaftar = document.querySelector(".daftarform");
var list_judulbuku = null;
var $search = $('#search-box');
var $userbox = $('#user-message');
var $passbox = $('#pass-message');
var $tuser = $('#tuser');
var $tpass = $('#tpass');
var $blogin = $('#btn-login');
var $bdaftar = $('#btn-daftar');
var $flogin = $('#form-login');
var $fdaftar = $('#form-daftar');

function toggleModal(key) {
  switch(key){
    case 'login':
      $flogin.trigger("reset");
      $flogin.find('small').text('');
      $blogin.prop('disabled', true);
      modalLogin.classList.toggle("modal__login-show");
      break;
    case 'daftar':
      $fdaftar.trigger("reset");
      $fdaftar.find('small').text('');
      $bdaftar.prop('disabled', true);
      modalDaftar.classList.toggle("modal__daftar-show");
      break;
    default:
      break;
  }
}

function login() {
  event.preventDefault();
  $userbox.text('');
  $passbox.text('');
  $.post(window.location.origin + '/login', $('#form-login').serialize()).done(function(status) {
    if (status) {
      if (status.username) {
        $userbox.text(status.username);
      } else if (status.password) {
        $passbox.text(status.password);
      } else {
        window.location.replace(window.location.origin);
      }
      return false;
    } else {
      window.location.replace(window.location.origin);
    }
  });
}

function daftar() {
  event.preventDefault();
  $fdaftar.find('small').text('');
  var filled = false;
  $fdaftar.find('input').each(function() {
    if ($(this).val().length == 0) {
      filled = false;
      $(this).parent().next('small').text('Tidak boleh kosong');
      return false;
    } else {
      filled = true;
    }
  });
  if (filled) {
    $.post(window.location.origin + '/daftar', $fdaftar.serialize()).done(function(status) {
      if (status) {
        if (status == true) {
          window.location.href = window.location.origin;
        } else {
          $fdaftar.find('small:first').text(status);
          return false;
        }
      } else {
        window.location.href = window.location.origin;
      }
    });
  }
}

$(document).ready(function(){
  $('#carousel').owlCarousel({
    autoplay:true,
    autoplayTimeout:3000,
    loop:true,
    margin:10,
    items: 1
  })
  $('#book').owlCarousel({
    margin:10,
    items: 7
  })
  $('#databook').DataTable();
  $.get(window.location.origin + '/katalog/list_buku').done(function(list_judulbuku) {
    $('#search-box').autocomplete({
      source: list_judulbuku
    });
  });
  $('#click-search').click(function() {
     $('#form-search').submit();
  });
  $flogin.submit(function(e) {
    login();
  })
  $flogin.find('input').on("keyup change", function() {
    var btn = false;
    if (!$(this).val()) {
      $(this).parent().next('small').text($(this).data('role') + ' tidak boleh kosong');
      $blogin.prop('disabled', true);
    } else {
      $(this).parent().next('small').text('');
    }
    $flogin.find('input').each(function() {
      if ($(this).val().length == 0) {
        btn = false;
        return false;
      } else {
        btn = true;
      }
    });
    if (btn) {
      $blogin.prop('disabled', false);
    } else {
      $blogin.prop('disabled', true);
    }
  });
  $fdaftar.find("input").keyup(function() {
    var daftar = false;
    if (!$(this).val()) {
      $(this).parent().next('small').text($(this).data('role') + ' tidak boleh kosong');
      $bdaftar.prop('disabled', true);
    } else {
      $(this).parent().next('small').text('');
    }
    $fdaftar.find('input').each(function() {
      if ($(this).val().length == 0) {
        daftar = false;
        return false;
      } else {
        daftar = true;
      }
    });
    if (daftar && ($('#tduser').val().length == 12)) {
      $bdaftar.prop('disabled', false);
    } else {
      $bdaftar.prop('disabled', true);
    }
  });
  $('#tduser').keyup(function() {
    if ($('#tduser').val().length == 12) {
      $.get(window.location.origin + '/check/', {nis: $('#tduser').val()}).done(function(dt) {
        if (dt.ada) {
          $('#tduser').parent().next('small').text(dt.ada);
          $bdaftar.prop('disabled', true);
        } else {
          $('#tduser').parent().next('small').text('');
        }
      });
    } else {
      $('#tduser').parent().next('small').text('NIS harus 12 karakter');
      $bdaftar.prop('disabled', true);
    }
  })
});