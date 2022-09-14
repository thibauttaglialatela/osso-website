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
            perPage: "{select} entrées par page",
            noRows: "Aucune entrées trouvées",
            info: "Afficher {start} à {end} sur {rows} entrées",
        },
        layout: {
            top: "{select}{search}",
            bottom: "{info}{pager}"
        },
        hiddenHeader: true,
    });
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
        newElem.append('<a href="#" class="remove-tag" style="color: hsl(36deg, 92%, 46%)">Enlever</a>');
        $('.remove-tag').click(function(e) {
            e.preventDefault();

            $(this).parent().remove();

        });
    });
});
