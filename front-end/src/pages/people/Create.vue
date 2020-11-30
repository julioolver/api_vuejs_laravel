<template>
  <div>
    <form class="col s12">
    <div class="row">
        <div class="row">
          <div class="input-field col s6">
            <input id="nome" type="text" class="validate" required maxlength="50" v-model="person.nome"/>
            <label for="nome">Nome</label>
          </div>
          <div class="input-field col s6">
            <input id="cpf" required type="text" class="validate" v-model="person.cpf"/>
            <label for="cpf">CPF</label>
          </div>
        </div>
        <div class="row">
        </div>
        <div class="row">
          <div class="input-field col s3">
            <input id="phone" type="text" class="validate" required v-model="person.phone"/>
            <label for="phone">Telefone</label>
            <div style="position: inline">
            <label>
              <input type="checkbox" v-on:change="cloneNumber" v-model="clone"/>
              <span>Whatsapp?</span>
            </label>
            </div>
          </div>
          <div class="input-field col s4">
            <input id="whatsapp" ref="whatsapp" type="text" required class="validate" v-model="person.whatsapp"/>
            <label for="whatsapp">whatsapp</label>
          </div>
          <div class="input-field col s4">
            <input id="email" type="email" class="validate" required v-model="person.email"/>
            <label for="email">Email</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s6">
              <input id="email" type="text" required class="validate" v-model="person.contacts"/>
              <label for="email">Endereço</label>
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
        <button class="btn" v-on:click="cadastrar()">Cadastrar</button>
    </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "People",
  data() {
    return {
      clone: false,
      person: {
        nome: '',
        cpf: '',
        email: '',
        phone: '',
        whatsapp: '',
        contacts: '',
        active: true
      }
    };
  },
  methods: {
    cloneNumber(e){
      console.log(this.$route.params.id);
      console.log(this.clone);
      if(this.clone){
        this.person.whatsapp = this.person.phone,
        this.$refs.whatsapp.focus()  
      } else {
        this.person.whatsapp = '',
      this.$refs.whatsapp.focus()
      }
      
    },
    cadastrar() {
      axios
        .post(`http://api-laravel-vuejstest-com.umbler.net/api/person`, this.person)
        .then(response => {
          console.log(response);
          if (response.status == 200) {
            this.$notify({
              group: 'foo',
              type: 'success',
              title: 'Sucesso!',
              text: 'Contato cadastrado com Sucesso!',
              color: 'green',
              speed: 1000,
              position: 'top center'
            });
            this.$router.push("/");
          } 
        })
        .catch(e => {
         this.$notify({
              group: 'foo',
              type: 'error',
              title: 'Erro!',
              text: 'Falha ao criar o Registro: ' + e,
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