<template>
    <div>
        <menu-bar/>
        <slider/>
        <div class="mt-5">
            <book-cards
                title="Top"
                url="app/books?by=top&per_page=8"
                @btnAction="btnAction"
            />
        </div>
        <div class="mt-5">
            <book-cards
                title="Featured"
                url="app/books?by=featured&per_page=8"
                @btnAction="btnAction"
            />
        </div>
        <div class="mt-5">
            <book-cards
                title="New"
                url="app/books?by=new&per_page=8"
                @btnAction="btnAction"
            />
        </div>
        <footer-banner/>
        <footer-menu/>
    </div>
</template>

<script>
import MenuBar from "./HelperComponents/MenuBar";
import Slider from "./HelperComponents/Slider";
import BookCards from "./HelperComponents/BookCards";
import FooterBanner from "./HelperComponents/FooterBanner";
import FooterMenu from "./HelperComponents/FooterMenu";

export default {
    name: "Home",
    components: {MenuBar,Slider,BookCards,FooterBanner,FooterMenu},
    computed: {
        loginUser() {
            return this.$store.state.Authenticate.user
        }
    },
    methods: {
        btnAction(title){
            let titleArray = {'Featured' : 'featured', 'Top': 'top', 'New':'new'}[title]
            this.$router.push({ name: 'books', query: { by: titleArray} })
        }
    }
}
</script>
