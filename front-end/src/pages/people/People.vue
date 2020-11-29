<template>
  <div>
    <div class="row">
      <div class="col s4 m4" v-for="person in data.data" :key="person.id">
        <div class="card">
          <div>
            <span class="card-title center" style="margin-left: 25px">
              {{person.nome}}</span>
          </div>
          <div class="card-content">
            <p>{{ person.contact.phone }}<br /></p>
          </div>
          <a class="btn-floating halfway-fab waves-effect waves-light primary left" @click="editPerson(person)"
            ><i class="material-icons">edit</i></a
          >
          <a class="btn-floating halfway-fab waves-effect waves-light red" @click="deletePerson(person)"
            ><i class="material-icons">delete</i></a
          >
        </div>
      </div>
      <infinite-loading
      spinner="spiral"
      @distance="1"
        @infinite="infiniteScroll"
      ></infinite-loading>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import InfiniteLoading from "vue-infinite-loading";

export default {
  name: "People",
  components: {
    InfiniteLoading,
  },
  data() {
    return {
      data: [],
      list: [],
      page: 1,
    };
  },
  computed: {
    url() {
      return "http://bravi.local/api/person";
    }
  },
  created() {
    this.fetchData();
  },
  methods: {
    async fetchData() {
      const response = await axios.get(this.url + "?page=" + this.page);
      this.data = response.data;
    },
   infiniteScroll($state) {
        this.page++;
        axios
          .get(this.url + "?page=" + this.page)
          .then(response => {
            if (response.data.length > 1) {
              response.data.forEach(item => this.data.push(item));
              $state.loaded();
            } else {
              $state.complete();
            }
          })
          .catch(err => {
            console.log(err);
          });
    },
    editPerson (data) {
       this.$router.push('/edit/' + data.id)
    },
    deletePerson (data) {
       axios
        .delete(this.url + `/${data.id}`)
        .then(response=> {
          if(response.status == 200){
            this.$notify({
              group: 'foo',
              type: 'success',
              title: 'Sucesso!',
              text: 'Contato excluído com Sucesso!',
              speed: 1000,
              position: 'top center'
            });
           this.fetchData();
          } else {
            this.$notify({
              group: 'foo',
              type: 'error',
              title: 'Erro!',
              text: 'Erro ao excluir o Registro',
              speed: 1000,
              position: 'top center'
            });
          }
        })
    },
  }
};
</script>

<style scoped>
</style>