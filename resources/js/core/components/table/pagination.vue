<template>
    <div v-if="pages">
        <ul class="pagination pagination-sm m-0 float-right">
            <li
                class="page-item cursor-pointer"
                v-if="paginateCurrentPage > 1"
                @click="previousPage()"
            >
                <a class="page-link">«</a>
            </li>
            <template v-for="(page, index) in pages">
                <li
                    class="page-item cursor-pointer"
                    :class="page === paginateCurrentPage && 'active'"
                    @click="changePage(page === '...' ? parseInt(pages[index-1]) + 1 : parseInt(page))"
                >
                    <a class="page-link">{{ page }}</a>
                </li>
            </template>
            <li
                class="page-item cursor-pointer"
                v-if="paginateCurrentPage < paginateLastPage"
                @click="nextPage()"
            >
                <a class="page-link">»</a>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "AppPagination",
    props: {
        currentPage: {},
        lastPage: {}
    },
    data () {
        return {
            pages: []
        }
    },
    methods: {
        makePaginateAbleItem(currentPage, lastPage){
            this.pages = [];

            if (lastPage !== 1){
                if (lastPage <= 5) {
                    this.pages = Array.from({length: lastPage}, (_, i) => i + 1)
                } else {
                    let midIndex = currentPage === 1 ? currentPage + 1 :
                        currentPage === lastPage ? currentPage - 1 : currentPage

                    let previousIndex = midIndex - 1;
                    let nextIndex = midIndex + 1;

                    previousIndex !== 1 && this.pages.push(1);
                    (previousIndex - 1) > 1 && this.pages.push('...');
                    this.pages.push(previousIndex);
                    this.pages.push(midIndex);
                    this.pages.push(nextIndex);
                    (lastPage - nextIndex) > 1 && this.pages.push('...');
                    nextIndex !== lastPage && this.pages.push(lastPage);
                }
            }
        },
        previousPage(){
            this.changePage(parseInt(this.currentPage) - 1)
        },
        nextPage(){
            this.changePage(parseInt(this.currentPage) + 1)
        },
        changePage(page){
            this.$emit('setFilteredValue', {
                'page' : page
            })
        }
    },
    computed: {
        paginateCurrentPage() {
            return parseInt(this.currentPage)
        },
        paginateLastPage() {
            return parseInt(this.lastPage)
        }
    },
    watch: {
        paginateCurrentPage: {
            handler: function (page){
                this.makePaginateAbleItem(page, this.paginateLastPage)
            },
            immediate: true
        },
        paginateLastPage: {
            handler: function (page){
                this.makePaginateAbleItem(this.paginateCurrentPage, page)
            },
            immediate: true
        }
    }
}
</script>

<style scoped>

</style>
