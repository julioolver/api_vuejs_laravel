<template>
  <nav :class="cor + ' nav-extended'">
    <div class="nav-wrapper container">
      <a href="/" class="brand-logo">{{ logo || 'API REST' }}</a>
      <!-- <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
      </ul> -->
    </div>
    <div class="nav-content">
      <router-link to="/create">
        <a class="btn-floating btn-large halfway-fab waves-effect waves-light teal left">
          <i class="material-icons">add</i>
        </a>
      </router-link>
    </div>
  </nav>
</template>

<script>
export default {
  name: "Navbar",
  props: ['logo', 'url','cor'],
  data() {
    return {};
  },
};
</script>

<style scoped>
</style>
