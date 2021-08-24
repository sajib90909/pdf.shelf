<template>
    <div>
        <menu-bar/>
        <iframe class="w-100 h-100" :src="urlGenerator('pdf/sample.pdf')" style="height: 700px">

        </iframe>
        <footer-menu/>
    </div>
</template>

<script>
import {urlGenerator} from "../../../core/helpers/AxiosHelper";
import MenuBar from "./HelperComponents/MenuBar";
import FooterMenu from "./HelperComponents/FooterMenu";

export default {
    name: "ViewBook",
    components: {FooterMenu, MenuBar},
    data() {
        return {
            urlGenerator
        }
    }
}
</script>

<style scoped>

</style>
