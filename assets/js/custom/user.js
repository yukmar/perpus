(function() {	
var siswa = {
	prop: {
		nis: null,
		nama: null,
		kelas: null
	},
	path: {
		origin: window.location.origin + '/manage-user/',
		new: window.location.origin + '/manage-user/add/?t=2',
		edit: window.location.origin +'/manage-user/edit/?t=2',
		check: window.location.origin + '/manage-user/check-siswa/'
	},
	doms: function() {
		this.$table = $('#table-siswa');
		this.$form = $('#form-siswa');
		this.$caption = this.$form.find('p:first');
		this.$nis = this.$form.find("input[name='txtnis']");
		this.$nama = this.$form.find("input[name='txtnama']");
		this.$kelas = this.$form.find("select[name='kelas']");
		this.$pass = this.$form.find("input[name='txtpass']");
		this.$rowpass = this.$form.find("input[type='password']").parents(":eq(1)");
		this.$btnsubmit = this.$form.find("button[type='submit']");
		this.$btnedit = $('.btn-siswa');
		this.$btnreset = this.$form.find("button[type='reset']");
		this.$old = this.$form.find("input[type='hidden']");
		this.$allinput = this.$form.find("input[type='text']");
		this.$warningbox = this.$nis.next();
	},
	init: function() {
		this.doms();
		this.$table.DataTable();
		this.$rowpass.hide();
		this.$btnsubmit.prop('disabled', true);
		this.events();
	},
	events: function() {
		var ini = this;
		this.$btnedit.click(this.edit.bind(this));
		this.$btnreset.click(this.reset.bind(this));
		this.$nis.keyup(this.check.bind(this));
		this.$form.submit(function(e) {
			if (ini.$form.data('role') == 'edit') {
				e.preventDefault();
				ini.prepdata();
			}
		});
	},
	edit: function(current) {
		this.$caption.text('FORM EDIT USER SISWA');
		this.$form.prop('action', this.path.edit);
		this.$form.data('role', 'edit');
		this.$warningbox.text('');
		this.prop.nis = ($(current.target).closest('tr').find('td:eq(1)').text());
		this.prop.nama = ($(current.target).closest('tr').find('td:eq(2)').text());
		this.prop.kelas = $(current.target).data('kelas');
		this.$nis.val(this.prop.nis);
		this.$nama.val(this.prop.nama);
		this.$kelas.val(this.prop.kelas);
		this.$btnsubmit.text('EDIT');
		this.$rowpass.show();
		this.$btnsubmit.prop('disabled', false);
	},
	reset: function() {
		this.$form.prop('action', this.path.new);
		this.$form.data('role', 'tambah');
		this.$caption.text('FORM TAMBAH USER SISWA');
		this.$warningbox.text('');
		this.$rowpass.hide();
		this.$btnsubmit.text('TAMBAH');
	},
	check: function(current) {
		var ini = this;
		var newdata = 0;
		
		if (this.$nis.val() !== this.prop.nis) {
			if (this.$nis.val().length == 12) {
				$.get(this.path.check, {nis: this.$nis.val()})
				.done(function(data) {
					var dt = JSON.parse(data);
					if (ini.prop.nis !== ini.$nis.val()) {
						if (dt.ada) {
							ini.$warningbox.text(dt.ada);
							ini.$btnsubmit.prop('disabled', true);
						} else {
							ini.$warningbox.text('');
							ini.$btnsubmit.prop('disabled', false);
						}
					} else {
						ini.$warningbox.text('');
						ini.$btnsubmit.prop('disabled', false);
					}
				});
			} else {
				ini.$btnsubmit.prop('disabled', true);
			}
		} else {
			this.$btnsubmit.prop('disabled', false);
		}
	},
	prepdata: function() {
		var data = this.$form.serializeArray();
		var ini = this;
		data.push({
			name: "oldnis",
			value: this.prop.nis
		});
		$.post(this.path.edit, data)
		.done(function() {
			window.location.replace(ini.path.origin);
		})
	}
}

var petugas = {
	prop: {
		nip: null,
		nama: null
	},
	path: {
		origin: window.location.origin + '/manage-user/',
		new: window.location.origin + '/manage-user/add/?t=1',
		edit: window.location.origin + '/manage-user/edit/?t=1',
		check: window.location.origin + '/manage-user/check-petugas/'
	},
	doms: function() {
		this.$table = $('#table-petugas');
		this.$form = $('#form-petugas');
		this.$caption = this.$form.find("p:first");
		this.$nip = this.$form.find("input[name='txtnip']");
		this.$nama = this.$form.find("input[name='txtnama']");
		this.$rowpass = this.$form.find("input[type='password']").parents(":eq(1)");
		this.$btnedit = $('.btn-petugas');
		this.$btnsubmit = this.$form.find("button[type='submit']");
		this.$btnreset = this.$form.find("button[type='reset']");
		this.$warningbox = this.$nip.next();
	},
	init: function() {
		this.doms();
		this.$table.DataTable();
		this.$rowpass.hide();
		this.$btnsubmit.prop('disabled', true);
		this.events();
	},
	events: function() {
		var ini = this;
		this.$btnedit.click(this.edit.bind(this));
		this.$btnreset.click(this.reset.bind(this));
		this.$nip.keyup(this.check.bind(this));
		this.$form.submit(function(e) {
			if (ini.$form.data('role') == 'edit') {
				e.preventDefault();
				ini.prepdata();
			}
		})
	},
	edit: function(current) {
		this.$form.prop('action', this.path.edit);
		this.$form.data('role', 'edit');
		this.$caption.text('FORM EDIT USER PETUGAS');
		this.prop.nip = $(current.target).closest('tr').find('td:eq(1)').text();
		this.prop.nama = $(current.target).closest('tr').find('td:eq(2)').text();
		this.$nip.val(this.prop.nip);
		this.$nama.val(this.prop.nama);
		this.$rowpass.show();
		this.$btnsubmit.text('EDIT');
		this.$btnsubmit.prop('disabled', false);
	},
	reset: function() {
		this.$form.prop('action', this.path.new);
		this.$form.data('role', 'tambah');
		this.$caption.text('FORM TAMBAH USER PETUGAS');
		this.$rowpass.hide();
		this.$btnsubmit.text('TAMBAH');
	},
	check: function() {
		var ini = this;
		if (this.$nip.val().length == 18) {
			if (this.$nip.val()!== this.prop.nip) {
				$.get(this.path.check, {nip: this.$nip.val()})
				.done(function(data) {
					var dt = JSON.parse(data);
					if (dt.ada) {
						ini.$warningbox.text(dt.ada);
						ini.$btnsubmit.prop('disabled', true);
					} else {
						ini.$btnsubmit.prop('disabled', false);
					}
				});
			} else {
				this.$btnsubmit.prop('disabled', false);
			}
		} else {
			this.$warningbox.text('');
			this.$btnsubmit.prop('disabled', true);
		}
	},
	prepdata: function() {
		var data = this.$form.serializeArray();
		var ini = this;
		data.push({
			name: "oldnip",
			value: this.prop.nip
		});
		$.post(this.path.edit, data)
		.done(function(dt) {
			window.location.replace(ini.path.origin);
		})
	}
}

var kelas = {
	doms: function() {
		this.$table = $('#table-kelas');
		this.$addForm = $('.loginform');
		this.$addBtn = $('#btn-addkelas');
		this.$addClose = this.$addForm.find('span:first');
		this.$editForm = $('.daftarform');
		this.$editBtn = $('.btn-kelas');
		this.$editBox = this.$editForm.find("input[name='editkelas']");
		this.$editHid = this.$editForm.find("input[type='hidden']");
		this.$editClose = this.$editForm.find('span:first');
	},
	init: function() {
		this.doms();
		this.$table.DataTable();
		this.events();
	},
	events: function() {
		this.$addBtn.click($.proxy(this.toggleModal.bind(this), null, this.$addBtn.data('role')));
		this.$addClose.click($.proxy(this.toggleModal.bind(this), null, this.$addClose.data('role')));
		this.$editBtn.click($.proxy(this.toggleModal.bind(this), null, this.$editBtn.data('role')));
		this.$editClose.click($.proxy(this.toggleModal.bind(this), null, this.$editClose.data('role')));
	},
	toggleModal: function(key, current) {
		switch(key){
			case 'tambah':
				this.$addForm.toggleClass('modal__login-show');
				break;
			case 'edit':
				this.$editForm.toggleClass('modal__daftar-show');
				this.$editBox.val($(current.target).closest('tr').find('td:eq(1)').text());
				this.$editHid.val($(current.target).data('kelas'));
				break;
		}
	}
}

siswa.init();
petugas.init();
kelas.init();

})();