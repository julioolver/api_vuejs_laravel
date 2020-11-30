<template>
  <span>
    <notifications group="foo" />
    <header>
      <nav-bar cor="red lighten-1" logo="API-REST" url="#" />
    </header>

    <main>
      <div class="container">
        <router-view />
      </div>
    </main>

    <!-- Footer -->
    <footer-vue cor="red lighten-1" logo="API-REST" descricao="Teste de Descrição" ano="2020">
      <li><a class="grey-text text-lighten-3" href="https://www.linkedin.com/in/julio-cesar-oliveira-da-silva-957593169/">LinkedIn</a></li>
      <li><a class="grey-text text-lighten-3" href="https://www.facebook.com/julio.cesar.731135">Facebook</a></li>
      <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
    </footer-vue>
  </span>
</template>

<script>
import NavBar from "@/components/layouts/NavBar"
import FooterVue from "@/components/layouts/FooterVue"
import M from 'materialize-css'


export default {
  name: "App",
  components: {
    NavBar,
    FooterVue
  },
  mounted () {
    M.AutoInit();
    M.updateTextFields();
},
};
</script>

<style>
</style>
