(function() {
var depan = {
	doms: function() {
		this.$table = $('#tablepeminjaman');
		this.$tableitem = $('#table-item');
	},
	init: function() {
		this.doms();
		this.$table.DataTable();
		this.$tableitem.DataTable();
	}
}

depan.init();
})();