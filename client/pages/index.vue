<template>
  <div>
    <h1 class="my-5 ml-3">Наши книги</h1>
    <v-data-table
      :headers="headers"
      :items="books"
      :items-per-page="5"
      class="elevation-1"
    >
      <template v-slot:[`item.status`]="{ item }">
        <v-chip
          class="ma-2"
          :color="item.status ? 'blue' : 'red'"
          label
          outlined
        >
          {{ item.status ? "В наличии" : "Выдана" }}
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
      ],
      books: [],
    };
  },
  methods: {
    load_books_list() {
      this.$axios.get("https://127.0.0.1:8000/api/book/all").then((response) => {
        consloe.log("success");
        this.books = response.data;
      });
    },
  },
  mounted() {
    this.load_books_list();
  },
};
</script>
