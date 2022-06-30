import {auto} from "@popperjs/core";

const $ = require('jquery');
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
$('#osso-repertory th').each(function (index, th) {
    $(th).unbind('click');
    $(th).append('<button class="sort-btn btn-asc">&#9650;</button>');
    $(th).append('<button class="sort-btn btn-desc">&#9660;</button>');

    $(th).find('.btn-asc').click(function () {
        table.column(index).order('asc').draw();
    });
    $(th).find('.btn-desc').click(function () {
        table.column(index).order('desc').draw();
    });

});

import {Calendar} from '@fullcalendar/core';
import frLocale from '@fullcalendar/core/locales/fr';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import bootstrap5Plugin from '@fullcalendar/bootstrap5';

document.addEventListener('DOMContentLoaded', () => {
    let calendarEL = document.querySelector('#calendar');
    let calendar = new Calendar(calendarEL, {
        aspectRatio: 2,
        plugins: [dayGridPlugin, bootstrap5Plugin, timeGridPlugin],
        initialView: 'dayGridMonth',
        themeSystem: 'bootstrap5',
        locale: frLocale,
        headerToolbar: {
            left: 'dayGridMonth',
            center: 'title',
            right: 'timeGridWeek'
        },
        footerToolbar: {
            left: '',
            center: 'prev,today,next',
            right: '',
        },
        height: auto,
        titleFormat: {
            month: "long",
            year: 'numeric'
        },
        eventSources: [
            {
                url: '/event/show/', // use the `url` property
                failure: function () {
                    alert('there was an error while fetching events!');
                },
                backgroundColor: 'blue',
                color: 'black'
            }
        ],
        eventClick: function showModal(info) {
            const url = `/event/show/${info.event._def.publicId}`
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    console.log(html);
                })
                .catch(error => alert(error))
        }
    });
    calendar.render();
})

