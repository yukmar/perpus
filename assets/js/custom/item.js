(function() {

var item = {
  prop: {
    kode: null,
    kode_stat: false, //any changed val?
  },
  date: function() {
    var date = new Date;
    return (date.getFullYear() + "-" + date.getMonth() + "-" + date.getDate());
  },
  paths: {
    check: window.location.origin + '/item-buku/cekkode'
  },
  doms: function(){
    this.$table = $('#table-item');

    this.$addForm = $('#ftambah');
    this.$addBtn = $('#btn-tambah');
    this.$addClose = this.$addForm.find('span:first');
    this.$addKode = this.$addForm.find("input[name='tambahkodebuku']");
    this.$addDate = this.$addForm.find("input[name='tambahtglbeli']");
    this.$addHarga = this.$addForm.find("input[name='tambahharga']");
    this.$addSubmit = this.$addForm.find("button[type='submit']");

    this.$editForm = $('#fedit');
    this.$editBtn = $('.btn-edit');
    this.$editClose = this.$editForm.find('span:first');
    this.$editKode = this.$editForm.find("input[name='txtkodebuku']");
    this.$editDate = this.$editForm.find("input[name='txttglbeli']");
    this.$editHarga = this.$editForm.find("input[name='txtharga']");
    this.$editSubmit = this.$editForm.find("button[type='submit']");
    this.$editHid = this.$editForm.find("input[name='kodeold']");
  },
  init: function() {
    this.doms();
    this.$table.DataTable();
    this.events();
  },
  events: function() {
    this.$addBtn.click($.proxy(this.toggleModal.bind(this), null, this.$addBtn.data('role')));
    this.$addClose.click($.proxy(this.toggleModal.bind(this), null, this.$addClose.data('role')));
    this.$addKode.change($.proxy(this.check_data.bind(this), null, {kode: this.$addKode, submit: this.$addSubmit}));

    this.$editBtn.click($.proxy(this.toggleModal.bind(this), null, this.$editBtn.data('role')));
    this.$editClose.click($.proxy(this.toggleModal.bind(this), null, this.$editClose.data('role')));
    this.$editKode.change($.proxy(this.check_data.bind(this), null, {kode: this.$editKode, submit: this.$editSubmit}));
    this.$editDate.add(this.$editHarga).on("change keyup", this.check_changedvalue.bind(this));
  },
  toggleModal: function(key, current) {
    switch(key){
      case 'tambah':
        this.$addForm.toggleClass("modal__login-show");
        this.$addDate.val(this.date());

        this.prop.kode = null;
        this.$addSubmit.prop('disabled', true);
        break;
      case 'edit':
        this.$editForm.toggleClass('modal__login-show');
        this.$editKode.val($(current.target).closest('tr').find('td:eq(1)').text());
        this.$editDate.val($(current.target).closest('tr').find('td:eq(2)').text());
        this.$editHarga.val($(current.target).closest('tr').find('td:eq(3)').text());
        this.$editHid.val($(current.target).closest('tr').find('td:eq(1)').text());
        this.prop.kode = $(current.target).closest('tr').find('td:eq(1)').text();
        this.$editSubmit.prop('disabled', true);
      break;
    }
  },
  check_data: function(act, current) {
    var $kode = act.kode;
    var $submit = act.submit;
    var ini = this;

    if ($kode.val().length == 4) {
      $.get(this.paths.check, {kode: $kode.val()}).done(function(data) {
        var dt = JSON.parse(data);
        if (dt.ada) {
          if ((ini.prop.kode) && (ini.prop.kode == $kode.val())) {
            $submit.prop('disabled', false);
            $kode.parent().next('small').text('');
            ini.prop.kode_stat = false;
          } else {
            $submit.prop('disabled', true);
            $kode.parent().next('small').text(dt.ada);  
            ini.prop.kode_stat = true;
          }
        } else {
          $submit.prop('disabled', false);
          $kode.parent().next('small').text('');
          ini.prop.kode_stat = false;
        }
      });
    } else {
      $submit.prop('disabled', true);
      $kode.parent().next('small').text('');
      ini.prop.kode_stat = true;
    }
  },
  check_changedvalue: function() {
    if (this.prop.kode_stat == false) {
      this.$editSubmit.prop('disabled', false);
    } else {
      this.$editSubmit.prop('disabled', true);
    }
  }
}

item.init();

})();