<template>
  <div>
    <h1 class="my-5 ml-3">Наши книги</h1>
    <v-data-table
      :headers="headers"
      :items="books"
      :items-per-page="5"
      class="elevation-1"
    >
      <template v-slot:[`item.availability`]="{ item }">
        <v-chip
          class="ma-2"
          :color="item.availability ? 'blue' : 'red'"
          label
          outlined
        >
          {{ item.availability ? "В наличии" : "Выдана" }}
        </v-chip>
      </template>
    </v-data-table>
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
      ],
      books: [],
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
