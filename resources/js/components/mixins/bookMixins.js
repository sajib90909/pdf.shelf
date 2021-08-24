import {urlGenerator} from "../../core/helpers/AxiosHelper";
export default {
    data() {
        return {
            tableId: 'app-book-table',
            options: {
                name: 'books',
                url: 'app/admin-panel/books',
                showHeader: true,
                columns: [
                    {
                        title: 'Name',
                        type: 'custom-html',
                        key: 'name',
                        modifier:(key, row) =>{
                            return `<div class="d-flex justify-conrtent-start align-content-center"><div class="mr-4 text-center rounded-pill overflow-hidden bg-brand-light" style="width: 50px; height: 50px">
                                ${ row.images.length ? `<img v-if="" src="${ urlGenerator(row.images[0].path)}" class="img-thumbnail w-100 h-100" alt="...">` : `<h4 v-else class="w-100 h-100 p-2 mt-1">${ this.makeSortName(row.name)}</h4>`}
                                </div><div class="align-self-center"> ${row.name}</div> </div>`
                        }
                    },
                    {
                        title: 'Writer',
                        type: 'text',
                        key: 'writer',
                    },
                    {
                        title: 'Uploaded by',
                        type: 'text',
                        key: 'upload_by',
                    },
                    {
                        title: 'Views',
                        type: 'text',
                        key: 'views_count',
                    },
                    {
                        title: 'Category',
                        type: 'custom-html',
                        key: 'category',
                        modifier: (key, row) => {
                            return key.name
                        }
                    },
                    {
                        title: 'Rating',
                        type: 'custom-html',
                        key: 'rating',
                        modifier: (key, row) => parseFloat(key).toFixed(2)
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
                        title: 'view',
                        icon: '<i class="fas fa-eye"></i>',
                        class: 'info',
                        key: 'view',
                    },
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
    methods: {
        makeSortName(name) {
            if (!name) return '';
            let matches = name.match(/\b(\w)/g);
            let acronym = matches.join('');
            return acronym.substring(0,2)
        }
    }
}
