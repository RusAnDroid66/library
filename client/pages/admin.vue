<template>
  <div>
    <h1 class="my-5 ml-3">Админ-панель</h1>
    <v-data-table
      :headers="headers"
      :items="books"
      :items-per-page="5"
      class="elevation-1"
    >
      <template v-slot:[`item.status`]="{ item }">
        <v-btn
          class="ma-2"
          :color="item.status ? 'blue' : 'red'"
          label
          outlined
          :click="change_book_availabilty(item.id)"
        >
          {{ item.status ? "В наличии" : "Выдана" }}
        </v-btn>
      </template>
      <template v-slot:[`item.deletion`]="{ item }">
        <v-btn
          class="ma-2"
          :color="red"
          label
          :click="delete_book(item.id)"
        >
          Удалить
        </v-btn>
      </template>
    </v-data-table>

    <v-card class="mt-7 pa-3 elevation-1">
      <v-card-text>
        <h3 class="mb-3">Добавить книгу</h3>
        <v-text-field
          label="Название книги"
          v-model="new_book.title"
        ></v-text-field>
        <v-text-field label="Автор" v-model="new_book.author"></v-text-field>
        <v-btn color="purple" outlined :click="add_book()">Добавить</v-btn>
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
          value: "name",
        },
        {
          text: "Автор",
          value: "author",
        },
        {
          text: "Наличие",
          value: "status",
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
      this.$axios.get("https://127.0.0.1:8000/book/all").then((response) => {
        consloe.log("success");
        this.books = response.data;
      });
    },
    add_book() {
      this.$axios
        .post("https://127.0.0.1:8000/book/add", this.new_book)
        .then((response) => {
          this.load_books_list();
        });
    },
    delete_book(id) {
      this.$axios
        .get("https://127.0.0.1:8000/book/delete/" + id)
        .then((response) => {
          this.load_books_list();
        });
    },
    change_book_availability(id) {
      this.$axios
        .get("https://127.0.0.1:8000/book/change_availabilty/" + id)
        .then((response) => {
          this.load_books_list();
        });
    },
  },
  mounted() {
    this.load_books_list();
  },
};
</script>
