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
import 'datatables.net-bs5';

$(document).ready(function () {
    $('#datatables-index').DataTable({
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
                "next": "&raquo;",
                "previous": "&laquo;"
            },
        },
    });
});
