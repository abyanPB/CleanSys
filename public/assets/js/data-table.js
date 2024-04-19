// import DataTable from 'datatables.net-dt';
// const DataTable = require('datatable.net-dt');

// $(function() {
//   'use strict';

//   $(function() {
//     $('#dataTableExample').DataTable({
//       "aLengthMenu": [
//         [10, 30, 50, -1],
//         [10, 30, 50, "All"]
//       ],
//       "iDisplayLength": 10,
//       "language": {
//         search: ""
//       }
//     });
//     $('#dataTableExample').each(function() {
//       var datatable = $(this);
//       // SEARCH - Add the placeholder for Search and Turn this into in-line form control
//       var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
//       search_input.attr('placeholder', 'Search');
//       search_input.removeClass('form-control-sm');
//       // LENGTH - Inline-Form control
//       var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
//       length_sel.removeClass('form-control-sm');
//     });
//   });

// });


document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    var dataTableExample = document.getElementById('dataTableExample');
    if (dataTableExample) {
      var options = {
        "aLengthMenu": [
          [10, 30, 50, -1],
          [10, 30, 50, "All"]
        ],
        "iDisplayLength": 10,
        "language": {
          search: ""
        }
      };

      var dataTable = new DataTable(dataTableExample, options);

      // SEARCH - Add the placeholder for Search and Turn this into in-line form control
      var searchInput = dataTableExample.closest('.dataTables_wrapper').querySelector('div[id$=_filter] input');
      if (searchInput) {
        searchInput.placeholder = 'Search';
        searchInput.classList.remove('form-control-sm');
      }

      // LENGTH - Inline-Form control
      var lengthSelect = dataTableExample.closest('.dataTables_wrapper').querySelector('div[id$=_length] select');
      if (lengthSelect) {
        lengthSelect.classList.remove('form-control-sm');
      }
    }
  });
