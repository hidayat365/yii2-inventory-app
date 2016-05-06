jQuery(document).ready(function() {       
    /*
     * Class Item (Barang)
     **/
    var Item = function(id, code, name) {
        var self = this;
        self.id = ko.observable(id);
        self.code = ko.observable(code);
        self.name = ko.observable(name);
        self.display = ko.computed(function() {
            return self.code() + ": " + self.name();
        }, self);
    }
    /*
     * Items Collection 
     * Definisi barang yang ada, 
     * bisa diambil dari database
     **/
    var ItemsCollection = [];

    /*
     * Class Header
     **/
    var TrxHeader = function() {
        var self = this;        
        self.details = ko.observableArray();
        self.number = ko.observable();
        self.addDetail = function() {
            var t = new TrxDetail();
            self.details.push(t);
        };
    }

    /*
     * Class Detail
     **/
    var TrxDetail = function() {
        var self = this;
        self.items = ItemsCollection;
        self.selectedItem = ko.observable();
        self.quantity = ko.observable(0);
        self.remarks = ko.observable();
        self.remove = function() {
            header.details.remove(self);
        };
    }

    var header = new TrxHeader(); 
    $.get("http://localhost/basic/web/index.php?r=api-item", function (result) {
        var len = result.length;
        for (i = 0; i < len; i++) {
            var item = new Item();
            item.id(result[i].id);
            item.code(result[i].code);
            item.name(result[i].name);
            ItemsCollection.push(item);
        };
        // this makes Knockout get to work
        ko.applyBindings(header); 
    }, "json");

});
