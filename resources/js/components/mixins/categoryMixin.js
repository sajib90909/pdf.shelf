export default {
    data() {
        return {
            tableId: 'app-category-table',
            options: {
                name: 'category',
                url: 'app/admin-panel/categories',
                showHeader: true,
                columns: [
                    {
                        title: 'name',
                        type: 'text',
                        key: 'name',
                    },
                    {
                        title: 'books',
                        type: 'text',
                        key: 'books_count',
                    },

                ],
                paginationType: "pagination",
                responsive: true,
                rowLimit: 10,
                showAction: true,
                orderBy: 'desc',
                actionType: "default",
                actions: [
                    {
                        title: 'edit',
                        icon: '<i class="fas fa-edit"></i>',
                        class: 'warning',
                        key: 'edit',
                    },
                    {
                        title: 'delete',
                        icon: '<i class="fas fa-trash-alt"></i>',
                        class: 'danger',
                        key: 'delete',
                        permission: (row) => !!row.books_count
                    }
                ],
                filters: [
                    {
                        title: 'writer',
                        type: "multi-search-select",
                        key: "writer",
                        option: [
                            {id: 1, name: 'sekspear'},
                            {id: 2, name: 'humayun'},
                            {id: 3, name: 'anisul'},
                            {id: 4, name: 'robindro'},
                            {id: 5, name: 'nojrul'},
                        ],
                    },
                    {
                        title: 'publisher',
                        type: "multi-search-select",
                        key: "publisher",
                        option: [
                            {id: 1, value: 'anondo'},
                            {id: 2, value: 'rokomari'},
                            {id: 3, value: 'onita'},
                            {id: 4, value: 'bangla academy'},
                            {id: 5, value: 'joyonti'},
                        ],
                        listValueField: 'value'
                    },
                ]
            },
        }
    },

}
