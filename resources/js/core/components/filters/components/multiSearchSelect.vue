<template>
    <div class="mr-2">
        <div class="btn-group" role="group" aria-label="Basic example">
            <button class="btn btn-dark" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ data.title }}</button>
            <div class="dropdown-menu">
                <select class="form-control form-control-sm">
                    <option>Small select</option>
                </select>
            </div>
            <button type="button" class="btn btn-primary"><i class="fas fa-times-circle"></i></button>
        </div>
<!--        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">-->
<!--            <div class="btn-group mr-2" role="group" aria-label="Second group">-->
<!--                <button class="btn btn-dark" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ data.title }}</button>-->
<!--                <button type="button" class="btn btn-primary"><i class="fas fa-times-circle"></i></button>-->
<!--                <div class="dropdown-menu">-->
<!--                    <select class="form-control form-control-sm">-->
<!--                        <option>Small select</option>-->
<!--                    </select>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
        <input

        />
    </div>
</template>

<script>
export default {
    name: "MultiSearchSelectFilter",
    props: {
        data: {}
    }
}
</script>

<style scoped>

</style>
