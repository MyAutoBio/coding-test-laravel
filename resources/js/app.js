import './bootstrap';
import $ from 'jquery';
import 'datatables.net-bs5';
const formatter = new Intl.NumberFormat('en-EN', {
    style: 'currency',
    currency: 'USD',
});

(() => {
    $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": "/customers/getData",
        "columnDefs": [
            {
                render: (data, type, row) => {
                  return row.id;
                },
                targets: 0
            },
            {
                render: (data, type, row) => {
                    return row.customer_name;
                },
                targets: 1
            },
            {
                render: (data, type, row) => {
                    return formatter.format(row.total_amount);
                },
                targets: 2
            },
            {
                render: (data, type, row) => {
                    let buttonContent = document.createElement('div');
                    let list = document.createElement('ol');
                    row.items.forEach(item => {
                        let listItem = document.createElement('li');
                        listItem.textContent = item;
                        list.append(listItem)
                    })
                    // let button =  document.createElement('button');
                    // button.classList.add('btn');
                    // button.classList.add('btn-primary');
                    // button.classList.add('btn-expand');
                    // button.textContent = "Expand";
                    // button.setAttribute('data-id', row.id)
                    buttonContent.append(list);
                    return buttonContent.outerHTML;
                },
                orderable: false,
                searchable: false,
                targets: 3
            }
        ]

    });
})();
