var utils = {

  speciesTypeahead: function (el, onSelect) {
    $(el).typeahead({
      onSelect: onSelect,
      ajax: {
        url: "../../ajax.php?action=searchSpecies",
        timeout: 500,
        triggerLength: 1,
        method: "get",
        loadingClass: "loading-circle",

        preDispatch: function (query) {
          return { str: query };
        },

        preProcess: function (data) {
          if (data.success === false) {
            return false;
          }
          var searchData = _.map(data.content, function (row) {
            return { id: row.id, name: row.commonName + ' (' + row.sciName + ')' };
          });
          return searchData;
        }
      }
    });
  }
};
