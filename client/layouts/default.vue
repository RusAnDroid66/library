<template>
  <v-app>
    
    <v-navigation-drawer
      v-if="is_authenticated"
      v-model="drawer"
      :mini-variant="miniVariant"
      :clipped="clipped"
      fixed
      app
    >
      <v-list>
        <v-list-item-title class="ml-5 mb-3 title">
          Меню
        </v-list-item-title>
        <v-list-item
          v-for="(item, i) in items"
          :key="i"
          :to="item.to"
          v-if="check_admin_rights(item)"
          router
          exact
        >
          <v-list-item-action>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-action>
          <v-list-item-content>
            <v-list-item-title v-text="item.title" />
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      :clipped-left="clipped"
      fixed
      app
    >
      <v-app-bar-nav-icon v-if="is_authenticated" @click.stop="drawer = !drawer" />
      <v-btn
        v-if="is_authenticated"
        icon
        @click.stop="miniVariant = !miniVariant"
      >
        <v-icon>mdi-{{ `chevron-${miniVariant ? 'right' : 'left'}` }}</v-icon>
      </v-btn>
      <v-toolbar-title v-text="title" />
    </v-app-bar>

    <v-main>
      <v-container>
        <nuxt />
      </v-container>
    </v-main>
    
    <v-footer
      :absolute="!fixed"
      app
    >
      <span>&copy; Arkhangelsky, {{ new Date().getFullYear() }}</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  data () {
    return {
      clipped: false,
      drawer: false,
      fixed: false,
      items: [
        {
          icon: 'mdi-book',
          title: 'Наши книги',
          to: '/'
        },
        {
          icon: 'mdi-database-edit',
          title: 'Админ-панель',
          to: '/admin'
        },
        {
          icon: 'mdi-logout',
          title: 'Сменить пользователя',
          to: '/login'
        }
      ],
      miniVariant: false,
      title: 'Библиотека имени Кого-То Там'
    };
  },
  computed: {
    is_authenticated() {
      return this.$store.state.apiToken;
    }
  },
  methods: {
    check_admin_rights(item) {
      if (item.to != '/admin') {
        return true;
      }
      return (this.$store.state.user && this.$store.state.user == 'admin');
    }
  }
}
</script>
