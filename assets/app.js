const $ = require( 'jquery' );
global.$ = global.jQuery = $;
// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';


// start the Stimulus application
import 'bootstrap';

import 'datatables.net-bs5';

$(document).ready(function () {
    $('#osso-repertory').DataTable({
        responsive: true,
        pagingType: 'full_numbers',
        search: {
            return: true,
        },
        language: {
            "search": "Rechercher:",
            "emptyTable": "Aucune donnée disponible dans le tableau",
            "info": "Affichage de _START_ à _END_ sur _TOTAL_ entrées",
            "infoEmpty": "Affichage de 0 à 0 sur 0 entrées",
            "infoFiltered": "(filtrées depuis un total de _MAX_ entrées)",
            "lengthMenu": "Afficher _MENU_ entrées",
            "paginate": {
                "first": "Première",
                "last": "Dernière",
                "next": "Suivante",
                "previous": "Précédente"
            },
        },
        autofill: true,

        }
    );
});
$('#osso-repertory th').each(function(index, th) {
    $(th).unbind('click');
    $(th).append('<button class="sort-btn btn-asc">&#9650;</button>');
    $(th).append('<button class="sort-btn btn-desc">&#9660;</button>');

    $(th).find('.btn-asc').click(function() {
        table.column(index).order('asc').draw();
    });
    $(th).find('.btn-desc').click(function() {
        table.column(index).order('desc').draw();
    });

});

import { Calendar } from '@fullcalendar/core';
import listPlugin from '@fullcalendar/list';
import bootstrap5Plugin from '@fullcalendar/bootstrap5';

let calendar = new Calendar(calendarEL, {
    plugins: [ listPlugin, bootstrap5Plugin ],
    initialView: 'listWeek',
    themeSystem: bootstrap5Plugin,
})