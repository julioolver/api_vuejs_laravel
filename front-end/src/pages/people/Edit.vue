<template>
  <div>
    <div class="row">
        <div class="row">
          <div class="input-field col s6">
            <input id="last_name" type="text" class="validate" v-model="person.nome"/>
            <label for="last_name">Nome</label>
          </div>
          <div class="input-field col s6">
            <input id="last_name" type="text" class="validate" v-model="person.cpf"/>
            <label for="last_name">CPF</label>
          </div>
        </div>
        <div class="row">
        </div>
        <div class="row"  v-if="person.contact">
          <div class="input-field col s3">
            <input id="password" type="text" class="validate" v-model="person.contact.phone"/>
            <label for="password">Telefone</label>
            <div style="position: inline">
            <label>
              <input type="checkbox" v-on:change="cloneNumber" v-model="clone" value="true"/>
              <span>Whatsapp?</span>
            </label>
            </div>
          </div>
          <div class="input-field col s4">
            <input id="whatsapp" ref="whatsapp" type="text" class="validate" v-model="person.contact.whatsapp"/>
            <label for="whatsapp">whatsapp</label>
          </div>
          <div class="input-field col s4">
            <input id="email" type="email" class="validate" v-model="person.contact.email"/>
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
              <input id="contacts" type="text" class="validate" v-model="person.contacts"/>
              <label for="contacts">Contact</label>
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
  </div>
</template>

<script>
import axios from "axios";

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
      `http://bravi.local/api/person/${this.$route.params.id}/edit`,
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
        .put(`http://bravi.local/api/person/${this.$route.params.id}`, this.person)
        .then(response => {
          console.log(response);
          console.log(response.success)
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
          } else {
            this.$notify({
              group: 'foo',
              type: 'error',
              title: 'Erro!',
              text: 'Falha ao atualizar o Registro',
              speed: 1000,
              position: 'top center'
            });
          }
        })
        .catch(e => {
          alert(this.errors.push(e));
        });
    }
  },
};
</script>

<style scoped>
</style>