<template>
  <div>
    <h1 class="my-5 ml-3">Админ-панель</h1>
    <v-data-table
      :headers="headers"
      :items="books"
      :items-per-page="5"
      class="elevation-1"
    >
      <template v-slot:[`item.availability`]="{ item }">
        <v-btn
          class="ma-2"
          :color="item.availability ? 'blue' : 'red'"
          label
          outlined
          @click="change_book_availability(item.id)"
        >
          {{ item.availability ? "В наличии" : "Выдана" }}
        </v-btn>
      </template>
      <template v-slot:[`item.deletion`]="{ item }">
        <v-btn
          class="ma-2 white--text"
          color="red"
          te
          label
          @click="delete_book(item.id)"
        >
          Удалить
        </v-btn>
      </template>
    </v-data-table>

    <v-card class="mt-7 pa-3 elevation-1">
      <v-card-text>
        <h3 class="mb-3">Добавить книгу</h3>
        <v-row>
          <v-col>
            <v-text-field
              label="Название книги"
              v-model="new_book.title"
            ></v-text-field>
          </v-col>
          <v-col>
            <v-text-field label="Автор" v-model="new_book.author"></v-text-field>
          </v-col>
          <v-col>
            <v-btn color="purple" outlined @click="add_book()">Добавить</v-btn>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
export default {
  data() {
    return {
      headers: [
        {
          text: "№ п/п",
          value: "id",
        },
        {
          text: "Название",
          value: "title",
        },
        {
          text: "Автор",
          value: "author",
        },
        {
          text: "Наличие",
          value: "availability",
        },
        {
          text: "Удаление",
          value: "deletion"
        }
      ],
      books: [],
      new_book: {
        title: "",
        author: "",
      },
    };
  },
  methods: {
    load_books_list() {
      this.$axios.get("http://127.0.0.1:8000/api/book/all", { 
        headers: { "Authorization" : 'Bearer ' + this.$store.state.apiToken } 
      }).then((response) => {
        this.books = response.data;
      });
    },
    add_book() {
      this.$axios
        .post("http://127.0.0.1:8000/api/book/add", this.new_book, { 
          headers: { "Authorization" : 'Bearer ' + this.$store.state.apiToken } 
        })
        .then((response) => {
          this.load_books_list();
        });
    },
    delete_book(id) {
      this.$axios
        .get("http://127.0.0.1:8000/api/book/delete/" + id, { 
          headers: { "Authorization" : 'Bearer ' + this.$store.state.apiToken } 
        })
        .then((response) => {
          this.load_books_list();
        });
    },
    change_book_availability(id) {
      this.$axios
        .get("http://127.0.0.1:8000/api/book/change_availability/" + id, { 
          headers: { "Authorization" : 'Bearer ' + this.$store.state.apiToken } 
        })
        .then((response) => {
          this.load_books_list();
        });
    },
    check_login() {
      if (!this.$store.state.apiToken) {
        this.$router.push('/login')
      }
    }
  },
  mounted() {
    this.check_login();
    this.load_books_list();
  }
};
</script>
