/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/admin/admin.scss';

// start the Stimulus application
import './bootstrap';
import {DataTable} from "simple-datatables"

document.addEventListener('DOMContentLoaded', () => {
    const dataTable = new DataTable('#datatables-index', {
        firstLast: true,
        footer: true,
        labels: {
            placeholder: "Rechercher",
            noRows: "Aucune entrées trouvées",
            perPage: "entrées par page",
            info: "Afficher {start} à {end} sur {rows} entrées",
        },
        hiddenHeader: false,
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
})

// add-collection-widget.js

jQuery(document).ready(function () {
    jQuery('.add-another-collection').click(function () {
        var list = $("#posters-fields-list");
        var counter = list.data('widget-counter') | list.children().length;
        var newWidget = list.attr('data-prototype');
        newWidget = newWidget.replace(/__name__/g, counter);
        counter++;
        list.data('widget-counter', counter);
        var newElem = jQuery(list.attr('data-widget-tags')).html(newWidget);
        newElem.appendTo(list);
        newElem.append('<a href="#" class="remove-tag btn btn-outline-danger">Supprimer le formulaire d\'ajout d\'une image</a>');
        $('.remove-tag').click(function (e) {
            e.preventDefault();

            $(this).parent().remove();

        });
    });
});
