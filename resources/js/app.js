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