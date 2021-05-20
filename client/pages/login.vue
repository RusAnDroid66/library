<template>
  <div>
    <v-card class="mt-7 pa-3 elevation-1">
        <v-card-text>
            <h3 class="mb-3">Войти</h3>
            <v-form>
                <v-row>
                    <v-text-field 
                        label="Мыло" 
                        v-model="user.email"
                        :rules="[rules.required, rules.email]"
                    ></v-text-field>
                </v-row>
                <v-row>
                    <v-text-field 
                        label="Пароль" 
                        v-model="user.password"
                        :rules="[rules.required]"
                        type="password"
                    ></v-text-field>
                </v-row>
                <v-row>
                    <v-btn color="purple" outlined @click="auth()">Впрёд!</v-btn>
                </v-row>
            </v-form>
        </v-card-text>
        <v-card-footer class="red--text">
            {{ error_message }}
        </v-card-footer>
    </v-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      user: {
          email: "",
          password: "",
          device_name: "web"
      },
      error_message: "",
      rules: {
          required: value => !!value || 'Required.',
          email: value => {
            const pattern = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return pattern.test(value) || 'Invalid e-mail.'
          },
        },
    };
  },
  methods: {
    auth(){
        this.error_message = "";
        this.$axios.post('http://localhost:8000/api/token/get', this.user)
            .catch((error) => {
                if (error.response && error.response.status == 422) {
                    this.error_message = "Неккоректно введены данные"
                }
            })
            .then((response) => {
                this.$store.commit('setToken', response.data);
                this.$router.push('/');
            })
    },
  },
};
</script>
