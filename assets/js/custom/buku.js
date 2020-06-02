(function() {
var buku = {
	temp: {
		isbn: null,
		filled: 0
	},
	paths: {
		search: window.location.origin + '/manage-buku/search',
		create: window.location.origin + '/manage-buku/add',
		edit: window.location.origin + '/manage-buku/edit/?isbn='
	},
	init: function(){
		this.events.table_buku = this.events.table_buku.bind(this);
		this.events.form = this.events.form.bind(this);
		this.events.edit = this.events.edit.bind(this);
		this.events.reset = this.events.reset.bind(this);
		this.check.is_empty = this.check.is_empty.bind(this);

		this.doms();
		this.events.table_buku();
		this.events.form();
		this.events.edit();
		this.events.reset();
	},
	doms: function(){
		this.$form = $('#forms-infobuku');
		this.$form.input = $('#forms-infobuku').find('input, textarea');
		this.$submit = $('#btninfosubmit');
		this.$table_buku = $('#table-info');
		this.$edit = $('.btn-edit');
		this.$reset = $("button[type='reset']");
	},
	events: {
		table_buku: function() {
			this.$table_buku.DataTable();
		},
		reset: function() {
			var ini = this;
			this.$reset.click(function() {
				ini.events.form();
			});
		},
		form: async function(){
			var ini = this;
			this.$form.prop('action', this.paths.create);
			this.$submit.prop('disabled', true);
			this.$submit.text('tambah');
			this.$form.input.each(function(index, element){
				if (index == 0){
					$(element).keyup(async function() {
						if ($(element).val().length == 13) {
							await $.get(ini.paths.search, {isbn: $(element).val()})
							.done(function(result) {
								if (!result) {
									ini.temp.isbn = $(element).val();
								}
								ini.check.is_empty(index, element);
							});
						}
						else {
							ini.temp.isbn = null;
							ini.check.is_empty(index, element);
						}
					});
				} else if (index == 4) {
					$(element).prop('disabled', true);
					$(element).keyup(function() {
						if ($(this).val().length <= 4 && Number.isInteger(Number($(this).val().trim())) ) {
							ini.check.is_empty(index, element);
						} else {
							$(ini.$form.input[index + 1]).prop('disabled', true);
						}
					})
				} else {
					$(element).prop('disabled', true);
					$(element).keyup(function() {
						if ($(ini.$form.input[0]).val()) {
							ini.temp.isbn = $(ini.$form.input[0]).val();
						}
						ini.check.is_empty(index, element);
					});
				}
			});
		},
		edit: function() {
			var ini = this;
			this.$edit.click(function(current) {
				ini.$form.input.each(function(index, element) {
					var value = $(current.target).closest('tr').find('td:eq('+ (index + 1) +')').text();
					$(element).val(value);
					if (index == 0) {
						ini.temp.isbn = value;
						ini.$form.prop('action', ini.paths.edit + value);
					}
					if (!value) {
						ini.temp.isbn = null;
					}
					ini.check.is_empty(index, element);
				});
				$(ini.$submit).text('edit');
			});
		}
	},
	check: {
		is_empty: async function(index, element) {
			var ini = this;
			if (typeof this.$form.input[index + 1] !== 'undefined') {
				if ($(element).val() && this.temp.isbn) {
					for (var i = index + 1; i < this.$form.input.length; i++) {
						$(this.$form.input[i]).prop('disabled', false);
						if (!$(this.$form.input[i]).val()) {
							break;
						}
					}
				} else {
					for (var i = index+1; i < this.$form.input.length; i++) {
						$(this.$form.input[i]).prop('disabled', true);
					}
				}
			}
			this.temp.filled = 0;
			this.$form.input.each(function(idx, el) {
				if ($(el).val()) {
					ini.temp.filled++;
				}
			});
			if (this.temp.filled == this.$form.input.length) {
				this.$submit.prop('disabled', false);
			} else {
				this.$submit.prop('disabled', true);
			}

		}
	}
};

buku.init();
})();