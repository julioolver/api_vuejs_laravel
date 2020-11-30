<template>
  <div>
    <form class="col s12">
      <div class="row">
          <div class="row">
            <div class="input-field col s6">
              <input id="nome" type="text" class="validate" required v-model="person.nome"/>
              <label for="nome" class="active">Nome</label>
            </div>
            <div class="input-field col s6">
              <input id="cpf" type="text" class="validate" required v-model="person.cpf"/>
              <label for="cpf" class="active">CPF</label>
            </div>
          </div>
          <div class="row">
          </div>
          <div class="row"  v-if="person.contact">
            <div class="input-field col s3">
              <input id="phone" type="text" class="validate" required v-model="person.contact.phone"/>
              <label for="phone" class="active">Telefone</label>
              <div style="position: inline">
              <label>
                <input type="checkbox" v-on:change="cloneNumber" v-model="clone" value="true"/>
                <span>Whatsapp?</span>
              </label>
              </div>
            </div>
            <div class="input-field col s4">
              <input id="whatsapp" ref="whatsapp" type="text" required class="validate" v-model="person.contact.whatsapp"/>
              <label for="whatsapp" class="active">whatsapp</label>
            </div>
            <div class="input-field col s4">
              <input id="email" type="email" class="validate" required v-model="person.contact.email"/>
              <label for="email" class="active">Email</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s6">
                <input id="contacts" type="text" class="validate" required v-model="person.contacts"/>
                <label for="contacts" class="active">Endereço</label>
            </div>
          </div>
          <div class="row">
          <div class="switch">
            <label>
              Ativo
              <input type="checkbox" v-model="person.active">
              <span class="lever"></span>
              Inativo
            </label>
          </div>
          </div>
          <button class="btn success" v-on:click="update()">Atualizar</button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios"

export default {
  name: "People",
  data() {
    return {
      clone: false,
      person: {}
    };
  },
  mounted() {
    axios.get(
      `http://api-laravel-vuejstest-com.umbler.net/api/person/${this.$route.params.id}/edit`,
    ).then((response) => (
      this.person = response.data));
  },
  methods: {
    cloneNumber(e){
      if(this.clone){
        this.person.contact.whatsapp = this.person.contact.phone
      } else {
        this.person.contact.whatsapp = ''
      }
      this.$refs.whatsapp.focus();  
    },
    update() {
      axios
        .put(`http://api-laravel-vuejstest-com.umbler.net/api/person/${this.$route.params.id}`, this.person)
        .then(response => {
          if (response.status == 200) {
             this.$notify({
              group: 'foo',
              type: 'success',
              title: 'Sucesso!',
              text: 'Contato atualizado com Sucesso!',
              speed: 1000,
              position: 'top center'
            });
            this.$router.push("/");
          }
        }).catch(e => {
         this.$notify({
              group: 'foo',
              type: 'error',
              title: 'Erro!',
              text: 'Falha ao atualizar o Registro',
              speed: 1000,
              position: 'top center'
            });
        });
    }
  },
};
</script>

<style scoped>
</style>