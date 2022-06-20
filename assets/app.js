const $ = require( 'jquery' );
global.$ = global.jQuery = $;
// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus application
import 'bootstrap';

import 'datatables.net-bs5';

$(document).ready(function () {
    $('#osso-repertory').DataTable();
});




