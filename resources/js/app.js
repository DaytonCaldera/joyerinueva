import jQuery from 'jquery';
window.$ = window.jQuery = jQuery;

window.$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
require('./custom/utils')
// require('bootstrap');
require('datatables.net-dt');
require('jsgrid');
require('select2');
import PerfectScrollbar from 'perfect-scrollbar';
window.PerfectScrollbar = PerfectScrollbar;
require('./bootstrap');
require('./custom');

$.fn.select2.amd.define('select2/i18n/custom', [], function () {
    return {
        errorLoading: function () {
            return 'Fallo la busqueda, intentelo de nuevo.';
        },
        inputTooShort: function (args) {
            var remainingChars = args.minimum - args.input.length;
      
            var message = 'Ingrese ' + remainingChars + ' o mas caracteres';
      
            return message;
          },
        inputTooLong: function (args) {
            var overChars = args.input.length - args.maximum;
            var message = 'Custom error message when input is too long. You have ' + overChars + ' character';
            if (overChars != 1) {
                message += 's';
            }
            return message;
        },
        noResults: function () {
            return 'No se encontraron resultados.';
        },
        searching: function () {
            return 'Buscando...';
        }
    };
});
