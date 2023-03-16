import {auto} from "@popperjs/core";
const $ = require('jquery');
global.$ = global.jQuery = $;
// any CSS you import will output into a single css file (app.scss in this case)
import './styles/app.scss';

// start the Stimulus application
import 'bootstrap';
import 'datatables.net-bs5';
import {DataTable} from "simple-datatables"
import {Calendar} from '@fullcalendar/core';
import frLocale from '@fullcalendar/core/locales/fr';
import dayGridPlugin from '@fullcalendar/daygrid';
import timeGridPlugin from '@fullcalendar/timegrid';
import bootstrap5Plugin from '@fullcalendar/bootstrap5';

 document.addEventListener('DOMContentLoaded', () => {
    //ajout de fullcalendar
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
                .then(response => response.json())
                .then(json => dispatchModal(json))
                .catch(error => alert(error))
        }
    });
    calendar.render();
    function dispatchModal (data) {
        window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.js');
        const modalContent = document.getElementById('eventModalContent');
        const myModal = new bootstrap.Modal(document.getElementById('eventModalContent'));
        modalContent.querySelector('.modal-title').innerHTML = data.title;
        modalContent.querySelector('.modal-body').innerHTML = data.body;
        return myModal.show();
    }
    document.querySelectorAll('.btn-show-modal').forEach(button => {
        button.addEventListener('click', (event) => dispatchModal(JSON.parse(event.target.dataset.eventData)));
    });
 })
// Ajout de simple-datatable
const dataTable = new DataTable('#osso-repertory', {
    firstLast: true,
    footer: true,
    labels: {
        placeholder: "Rechercher",
        noRows: "Aucune entrées trouvées",
        perPage: "entrées par page",
        info: "Afficher {start} à {end} sur {rows} entrées",
    },
    hiddenHeader: true,
},
    (options, dom) => `<div class='${options.classes.top}'>
    ${
        options.paging && options.perPageSelect ?
            `<div class='${options.classes.dropdown}'>
            <label>
                <select class='${options.classes.selector}'></select> ${options.labels.perPage}
            </label>
        </div>` :
            ""
    }
    ${
        options.searchable ?
            `<div class='${options.classes.search}'>
            <input class='${options.classes.input}' placeholder='${options.labels.placeholder}' type='search' title='${options.labels.searchTitle}'${dom.id ? ` aria-controls="${dom.id}"` : ""}>
        </div>` :
            ""
    }
</div>
<div class='${options.classes.container}'${options.scrollY.length ? ` style='height: ${options.scrollY}; overflow-Y: auto;'` : ""}></div>
<div class='${options.classes.bottom}'>
    ${
        options.paging ?
            `<div class='${options.classes.info}'></div>` :
            ""
    }
    <nav class='${options.classes.pagination}'></nav>
</div>`
    );